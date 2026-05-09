<?php

namespace App\Http\Controllers;

use App\Models\Subscripcio;
use App\Models\TargetaUsuari;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class SubscripcioController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $subscripcions = Subscripcio::with('client')
            ->when($user->rol === 'CLIENT', function ($q) use ($user) {
                $q->where('client_id', $user->id);
            })
            ->latest()
            ->get();

        $targetas = TargetaUsuari::where('client_id', $user->id)->get();

        return view('subscripcions.index', compact('subscripcions', 'targetas'));
    }

    public function create(Request $request): View
    {
        $usuaris_registrats = User::where('rol', 'CLIENT')->get();

        return view('subscripcions.create', [
            'usuaris_registrats' => $usuaris_registrats,
            'tipusSeleccionat' => $request->tipus ?? null
        ]);
    }

    

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tipus'        => 'required|in:Bàsica,Premium,VIP',
            'data_inici'   => 'required|date',
            'data_fi'      => 'required|date|after_or_equal:data_inici',
            'targeta_id'   => 'required|exists:targetas,id',
            'client_id'    => 'required|exists:users,id'
        ]);

        // preus automatics
        $preus = [
            'Bàsica' => 20.00,
            'Premium' => 30.00,
            'VIP' => 50.00
        ];

        $validated['preu'] = $preus[$validated['tipus']];

        Subscripcio::create($validated);
        return redirect()->route('subscripcions.index')->with('status', 'Suscripción creada correctamente');
    }

    public function edit(Subscripcio $subscripcio): View
    {
        $usuaris_registrats = User::where('rol', 'CLIENT')->get();
        return view('subscripcions.edit', compact('subscripcio', 'usuaris_registrats'));
    }

    public function update(Request $request, Subscripcio $subscripcio): RedirectResponse
    {
        $validated = $request->validate([
            'tipus'        => 'required|in:Bàsica,Premium,VIP',
            'data_inici'   => 'required|date',
            'data_fi'      => 'required|date|after_or_equal:data_inici',
            'targeta_id'   => 'required|exists:targetas,id',
            'client_id'    => 'required|exists:users,id'
        ]);

        $preus = [
            'Bàsica' => 20.00,
            'Premium' => 30.00,
            'VIP' => 50.00
        ];

        $validated['preu'] = $preus[$validated['tipus']];

        $subscripcio->update($validated);
        return redirect()->route('subscripcions.index')->with('status', 'Suscripción actualizada correctamente');
    }

    public function destroy(Subscripcio $subscripcio): RedirectResponse
    {
        $subscripcio->delete();
        return redirect()->route('subscripcions.index')->with('status', 'Suscripción eliminada correctamente');
    }

    public function show(Subscripcio $subscripcio)
    {
        $user = Auth::user();

        return view('subscripcions.show', [
            'subscripcio' => $subscripcio,
            'user' => $user
        ]);
    }

    
}
