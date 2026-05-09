<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Reserva;
use App\Models\Sala;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ClasseController extends Controller
{
    public function index(Request $request): View
    {
        $user = Auth::user();

        $query = Classe::with(['sala', 'monitor', 'reserves']);

        if ($request->filled('tipus') && $request->tipus !== 'all') {
            $query->where('tipus', $request->tipus);
        }

        if ($request->filled('sala') && $request->sala !== 'all') {
            $query->where('sala_id', $request->sala);
        }

        if ($request->filled('monitor') && $request->monitor !== 'all') {
            $query->where('monitor_id', $request->monitor);
        }

        if ($user->rol === 'MONITOR') {
            $query->where('monitor_id', $user->id);
        }

        $classes = $query->paginate(35);

        $sales = Sala::all();
        $monitors = User::where('rol', 'MONITOR')->get();

        $reserves = Reserva::all();

        return view('classes.index', [
            'user' => $user,
            'classes' => $classes,
            'sales' => $sales,
            'monitors' => $monitors,
            'reserves' => $reserves,
            'tipus_selected' => $request->tipus ?? 'all',
            'sala_selected' => $request->sala ?? 'all',
            'monitor_selected' => $request->monitor ?? 'all',
        ]);
    }

    public function create(): View
    {
        $sales = Sala::all();
        $usuaris_registrats = User::where('rol', 'MONITOR')->get();

        return view('classes.create', compact('sales', 'usuaris_registrats'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tipus' => 'required|in:Yoga,Pilates,Spinning,Zumba,Crossfit,Boxeo,Aerobics,HIIT,Estiramientos,Natación,Stretching,Meditación,BodyPump,Ciclismo Indoor',
            'descripcio' => 'required|string|max:300',
            'horari_inici' => 'required|date_format:H:i',
            'horari_final' => 'required|date_format:H:i|after:horari_inici',
            'dia' => 'required|date',
            'places' => 'required|integer|min:1',
            'sala_id'  => 'nullable|exists:sales,id',
            'monitor_id' => 'required|exists:users,id'
        ]);

        Classe::create($validated);

        return redirect()
            ->route('classes.index')
            ->with('status', 'Clase creada correctamente');
    }

    public function edit(Classe $classe): View
    {
        $sales = Sala::all();
        $usuaris_registrats = User::where('rol', 'MONITOR')->get();

        return view('classes.edit', compact('classe', 'sales', 'usuaris_registrats'));
    }

    public function update(Request $request, Classe $classe): RedirectResponse
    {
        $validated = $request->validate([
            'tipus' => 'required|in:Yoga,Pilates,Spinning,Zumba,Crossfit,Boxeo,Aerobics,HIIT,Estiramientos,Natación,Stretching,Meditación,BodyPump,Ciclismo Indoor',
            'descripcio' => 'required|string|max:300',
            'horari_inici' => 'required|date_format:H:i',
            'horari_final' => 'required|date_format:H:i|after:horari_inici',
            'dia' => 'required|date',
            'places' => 'required|integer|min:1',
            'sala_id' => 'required|exists:sales,id',
            'monitor_id' => 'required|exists:users,id'
        ]);

        $classe->update($validated);

        return redirect()
            ->route('classes.index')
            ->with('status', 'Clase actualizada correctamente');
    }

    public function destroy(Classe $classe): RedirectResponse
    {
        $classe->delete();

        return redirect()
            ->route('classes.index')
            ->with('status', 'Clase eliminada correctamente');
    }

    public function show(Classe $classe): View
    {
        $user = Auth::user();

        $reserves = Reserva::with('client')
            ->where('classe_id', $classe->id)
            ->get();

        return view('classes.show', [
            'classe' => $classe,
            'user' => $user,
            'reserves' => $reserves,
        ]);
    }

    public function modal(Classe $classe): View
    {
        return view('classes.modal', compact('classe'));
    }
    
}