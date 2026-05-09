<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Sala;
use App\Models\Subscripcio;
use App\Models\User;
use App\Models\Valoracio;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GeneralController extends Controller
{
    public function index(Request $request)
    {
        $classes = Classe::orderBy('id', 'desc')->limit(3)->get();
        $monitors = User::where('rol', 'MONITOR')->get();
        $subscripcions = Subscripcio::all();
        $sales = Sala::all();

        $mes = (int) $request->get('mes', now()->month);
        $anio = (int) $request->get('anio', now()->year);

        if ($mes < 1) {
            $mes = 12;
            $anio--;
        } elseif ($mes > 12) {
            $mes = 1;
            $anio++;
        }

        $diasEnMes = \Carbon\Carbon::create($anio, $mes)->daysInMonth;

        $diaSeleccionado = $request->dia ?? now()->toDateString();

        $clasesDia = Classe::whereDate('dia', $diaSeleccionado)->get();

        return view('welcome', compact(
            'classes',
            'monitors',
            'subscripcions',
            'sales',
            'diasEnMes',
            'mes',
            'anio',
            'diaSeleccionado',
            'clasesDia'
        ));
    }
    
    public function about(Request $request)
    {
        return view('footer.about');
    }

    public function security(Request $request)
    {
        return view('footer.security');
    }

    public function reviews(Request $request)
    {
        $valoracions = Valoracio::all();
        $classes = Classe::all();
        return view('footer.reviews', compact('valoracions', 'classes'));
    }
}