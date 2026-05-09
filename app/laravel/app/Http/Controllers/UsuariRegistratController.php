<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Reserva;
use App\Models\Subscripcio;
use App\Models\TargetaUsuari;
use App\Models\User;
use App\Models\Valoracio;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class UsuariRegistratController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::query();

        if ($request->filled('rol')) {
            $query->where('rol', $request->rol);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nom', 'like', "%{$request->search}%")
                ->orWhere('cognom', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        $usuaris = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('usuaris.index', compact('usuaris'));
    }

    public function create()
    {
        return view('usuaris.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom'               => 'required|string|max:255',
            'cognom'            => 'required|string|max:255',
            'email'             => 'required|email:rfc,dns|max:255',
            'password'          => 'required|string|min:8|max:255|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',
            'telefon'           => 'required|string|max:20',
            'rol'               => 'required|in:CLIENT,MONITOR,ADMIN',
        ]);

        User::create($validated);
        return redirect()->route('usuaris.index')->with('status', 'Usuario creatdo correctamente');
    }

    public function edit(User $usuari): View
    {
        return view('usuaris.edit', compact('usuari'));
    }

    public function update(Request $request, User $usuari): RedirectResponse
    {
        $validated = $request->validate([
            'nom'               => 'required|string|max:255',
            'cognom'            => 'required|string|max:255',
            'email'             => 'required|email:rfc,dns|max:255',
            'password'          => 'nullable|string|min:8|max:255|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',
            'telefon'           => 'required|string|max:20',
            'rol'               => 'required|in:CLIENT,MONITOR,ADMIN',
        ]);

        $usuari->update($validated);
        return redirect()->route('usuaris.index')->with('status', 'Usuario actualizado correctamente');
    }

    public function destroy(User $usuari): RedirectResponse
    {
        $usuari->delete();
        return redirect()->route('usuaris.index')->with('status', 'Usuario eliminado correctamente');
    }

    public function show(User $usuari)
    {
        $user = Auth::user();

        if ($usuari->rol === 'CLIENT') {
            $reserves = Reserva::where('client_id', $usuari->id)->get();
            $targetes = TargetaUsuari::where('client_id', $usuari->id)->get();
            $subscripcions = Subscripcio::where('client_id', $usuari->id)->get();
            $valoracions = Valoracio::where('client_id', $usuari->id)->get();

            return view('usuaris.show', [
                'reserves' => $reserves,
                'targetes' => $targetes,
                'subscripcions' => $subscripcions,
                'valoracions' => $valoracions,
                'usuari' => $usuari,
                'user' => $user
            ]);
        } else if ($usuari->rol === 'MONITOR') {
            $classes = Classe::where('monitor_id', $usuari->id)->get();

            return view('usuaris.show', [
                'classes' => $classes,
                'usuari' => $usuari,
                'user' => $user
            ]);
        } else {
            return view('usuaris.show', [
                'usuari' => $usuari,
                'user' => $user
            ]);
        }
    }
}
