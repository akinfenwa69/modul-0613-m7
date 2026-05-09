<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Models\Classe;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class SalaController extends Controller
{
    public function index(): View
    {
        $sales = Sala::with('classes')->paginate(20);
        $reserves = Reserva::with(['classe', 'classe.sala'])->where('client_id', Auth::user()->id)->get();
        return view('sales.index', [
            'sales'=> $sales,
            'user' => Auth::user(),
            'reserves' => $reserves,
            ]);
    }

    public function create(): View
    {
        return view('sales.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate ([
            'tipus'        => 'required|in:Fuerza,Cardio,Yoga,Pilates,CrossFit,Spinning,Zumba,HIIT,Boxeo,Estiramientos,Natación,Stretching,Meditación,BodyPump,Ciclismo Indoor',
            'descripcio'   => 'required|string|max:300'
        ]);

        Sala::create($validated);
        return redirect()->route('sales.index')->with('status', 'Sala creada correctamente');
    }

    public function edit(Sala $sala): View
    {
        return view('sales.edit', compact('sala'));
    }

    public function update(Request $request, Sala $sala): RedirectResponse
    {
        $validated = $request->validate([
            'tipus'      => 'required|in:Fuerza,Cardio,Yoga,Pilates,CrossFit,Spinning,Zumba,HIIT,Boxeo,Estiramientos,Natación,Stretching,Meditación,BodyPump,Ciclismo Indoor',
            'descripcio' => 'required|string|max:300'
        ]);

        $sala->update($validated);
        return redirect()->route('sales.index')->with('status', 'Sala actualizada correctamente');
    }

    public function destroy(Sala $sala): RedirectResponse
    {
        // canviar a classe 'sala_id' => null
        $sala->classes()->update(['sala_id' => null]);

        $sala->delete();
        return redirect()->route('sales.index')->with('status', 'Sala eliminada correctamente');
    }

    public function show(Sala $sala)
    {
        $user = Auth::user();

        $reserves = Reserva::all();
        $classes = Classe::where('sala_id', $sala->id)->get();

        return view('sales.show', [
            'sala' => $sala,
            'user' => $user,
            'reserves' => $reserves,
            'classes' => $classes
        ]);
    }

    public function modal($id)
    {
        $sala = Sala::with('classes', 'classes.monitor')->findOrFail($id);
        return view('sales.modal', compact('sala'));
    }
}
