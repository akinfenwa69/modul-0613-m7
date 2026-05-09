<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Classe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $reserves = Reserva::with(['classe.sala', 'client'])
            ->when($user->rol === 'CLIENT', function ($q) use ($user) {
                $q->where('client_id', $user->id);
            })
            ->when($user->rol === 'MONITOR', function ($q) use ($user) {
                $q->whereHas('classe', function ($query) use ($user) {
                    $query->where('monitor_id', $user->id);
                });
            })
            ->get();

        return view('reserves.index', compact('reserves', 'user'));
    }

    public function create(): View
    {
        $classes = Classe::all();
        $usuaris_registrats = User::where('rol', 'CLIENT')->get();
        return view('reserves.create', [
            'classes'=> $classes,
            'usuaris_registrats' => $usuaris_registrats,
            'user' => Auth::user()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();

        if ($user->rol === 'CLIENT') {
            $request->merge(['client_id' => $user->id]);
        }

        $validated = $request->validate ([
            'data_de_reserva'   => 'now()',
            'classe_id'         => 'required|exists:classes,id',
            'client_id'         => 'required|exists:users,id'
        ]);

        Reserva::create(array_merge(
            $validated,
            ['data_de_reserva' => now()] // <- fecha y hora actual
        ));

        return redirect()->route('reserves.index')->with('status', 'Reserva creada correctamente');
    }

    public function edit(Reserva $reserva): View
    {
        $classes = Classe::all();
        $usuaris_registrats = User::where('rol', 'CLIENT')->get();
        $usuaris_registrats = User::where('rol', 'CLIENT')->get();

        return view('reserves.edit', compact('reserva', 'classes', 'usuaris_registrats'));
    }

    public function update(Request $request, Reserva $reserva): RedirectResponse
    {
        $validated = $request->validate([
            'classe_id'         => 'required|exists:classes,id',
            'client_id'         => 'required|exists:users,id'
        ]);

        $reserva->update($validated);
        return redirect()->route('reserves.index')->with('status', 'Reserva actualizada correctamente');
    }

    public function destroy(Reserva $reserva): RedirectResponse
    {
        $reserva->delete();
        return redirect()->route('reserves.index')->with('status', 'Reserva eliminada correctamente');
    }


    // Crea una reserva automaticament
    public function quickReserve(Classe $classe)
    {
        $user = Auth::user();

        if ($user->rol !== 'CLIENT') {
            abort(403, 'No tienes permiso para realizar esta acción');
        }

        // Revisa si ja existeix una reserva d'aquest usuari per a aquesta classe
        $reservaExistente = \App\Models\Reserva::where('classe_id', $classe->id)
                        ->where('client_id', $user->id)
                        ->first();

        if ($reservaExistente) {
            return redirect()->back()->with('status', 'Ya tienes una reserva para esta clase.');
        }

        // Crea la reserva
        $reserva = Reserva::create([
            'classe_id'       => $classe->id,
            'client_id'       => $user->id,
            'data_de_reserva' => now(),
        ]);

        return redirect()->back()->with('status', 'Reserva realizada correctamente!');
    }

    public function show(Reserva $reserva)
    {
        $user = Auth::user();

        return view('reserves.show', [
            'reserva' => $reserva,
            'user' => $user
        ]);
    }
}
