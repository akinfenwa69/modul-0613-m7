<?php

namespace App\Http\Controllers;

use App\Models\Valoracio;
use App\Models\Classe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ValoracioController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $valoracionsQuery = Valoracio::with([
            'classe.sala',
            'client'
        ])->orderByDesc('created_at');

        if ($user->rol === 'CLIENT') {
            $valoracionsQuery->where('client_id', $user->id);
        }

        if ($user->rol === 'MONITOR') {
            $valoracionsQuery->whereHas('classe', function ($q) use ($user) {
                $q->where('monitor_id', $user->id);
            });
        }

        $valoracions = $valoracionsQuery->paginate(10);

        return view('valoracions.index', compact('valoracions', 'user'));
    }

    public function create(): View
    {
        $user = Auth::user();

        $usuaris_registrats = User::where('rol', 'CLIENT')->get();

        $classes = Classe::with(['sala'])->get();

        if ($user->rol === 'CLIENT') {
            $classes = Classe::whereHas('reserves', function ($q) use ($user) {
                $q->where('client_id', $user->id);
            })->with('sala')->get();
        }

        return view('valoracions.create', compact('classes', 'usuaris_registrats'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'descripcio' => 'required|string|max:1000',
            'estrelles'  => 'required|integer|min:0|max:5',
            'classe_id'  => 'required|exists:classes,id',
            'client_id'  => 'required|exists:users,id'
        ]);

        Valoracio::create($validated);

        return redirect()
            ->route('valoracions.index')
            ->with('status', 'Valoración creada correctamente');
    }

    public function edit(Valoracio $valoracio): View
    {
        $user = Auth::user();

        if ($user->rol === 'CLIENT') {
            $classes = Classe::whereHas('reserves', function ($q) use ($user) {
                $q->where('client_id', $user->id);
            })->get();
        } else {
            $classes = Classe::all();
        }

        $usuaris_registrats = User::where('rol', 'CLIENT')->get();

        return view('valoracions.edit', compact('valoracio', 'classes', 'usuaris_registrats'));
    }

    public function update(Request $request, Valoracio $valoracio): RedirectResponse
    {
        $validated = $request->validate([
            'descripcio' => 'required|string|max:1000',
            'estrelles'  => 'required|integer|min:0|max:5',
            'classe_id'  => 'required|exists:classes,id',
            'client_id'  => 'required|exists:users,id'
        ]);

        $valoracio->update($validated);

        return redirect()
            ->route('valoracions.index')
            ->with('status', 'Valoración actualizada correctamente');
    }

    public function destroy(Valoracio $valoracio): RedirectResponse
    {
        $valoracio->delete();

        return redirect()
            ->route('valoracions.index')
            ->with('status', 'Valoración eliminada correctamente');
    }

    public function show(Valoracio $valoracio): View
    {
        $user = Auth::user();

        return view('valoracions.show', [
            'valoracio' => $valoracio,
            'user' => $user,
        ]);
    }
}