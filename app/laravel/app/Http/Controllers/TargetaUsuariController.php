<?php

namespace App\Http\Controllers;

use App\Models\TargetaUsuari;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class TargetaUsuariController extends Controller
{
    
    public function index(): View
    {
        $user = Auth::user();

        $query = TargetaUsuari::with('client');

        if ($user->rol === 'CLIENT') {
            $query->where('client_id', $user->id);
        }

        $targetas = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('targetas.index', compact('targetas'));
    }

    public function create(): View
    {
        $usuaris_registrats = User::where('rol', 'CLIENT')->get();
        return view('targetas.create', compact('usuaris_registrats'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom_titular'   => 'required|string|max:150',
            'numero_compte' => 'required|string|digits_between:13,19|unique:targetas,numero_compte',
            'data_validesa' => 'required|date|after:today',
            'cvv'           => 'required|string|digits_between:3,4',
            'tipus_targeta' => 'required|in:VISA,MASTERCARD,AMEX',
            'activa'        => 'boolean',
            'client_id'     => 'required|exists:users,id',
        ]);

        TargetaUsuari::create($validated);
        return redirect()->route('targetas.index')->with('status', 'Tarjeta creada correctamente');
    }

    public function edit(TargetaUsuari $targeta): View
    {
        $usuaris_registrats = User::where('rol', 'CLIENT')->get();
        return view('targetas.edit', compact('targeta', 'usuaris_registrats'));
    }

    public function update(Request $request, TargetaUsuari $targeta): RedirectResponse
    {
        $validated = $request->validate([
            'nom_titular'   => 'required|string|max:150',
            'numero_compte' => 'required|string|digits_between:13,19|unique:targetas,numero_compte,' . $targeta->id,
            'data_validesa' => 'required|date|after:today',
            'cvv'           => 'required|string|digits_between:3,4',
            'tipus_targeta' => 'required|in:VISA,MASTERCARD,AMEX',
            'activa'        => 'boolean',
            'client_id'     => 'required|exists:users,id',
        ]);

        $targeta->update($validated);
        return redirect()->route('targetas.index')->with('status', 'Tarjeta actualizada correctamente');
    }

    public function destroy(TargetaUsuari $targeta): RedirectResponse
    {
        $targeta->delete();
        return redirect()->route('targetas.index')->with('status', 'Tarjeta eliminada correctamente');
    }

    public function show(TargetaUsuari $targeta)
    {
        $user = Auth::user();

        return view('targetas.show', [
            'targeta' => $targeta,
            'user' => $user
        ]);
    }
}
