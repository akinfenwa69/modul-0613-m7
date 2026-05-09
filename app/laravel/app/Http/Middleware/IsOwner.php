<?php

namespace App\Http\Middleware;

use App\Models\Reserva;
use App\Models\Subscripcio;
use App\Models\TargetaUsuari;
use App\Models\Valoracio;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Response;

class IsOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isowner = false;
        $url = url()->current();

        if (str_contains($url, 'reserva') && Reserva::find($request->route()->parameters()['reserva']->id)->client_id == $request->user()->id) {
            $isowner = true;
        }

        if (str_contains($url, 'subscripcio') && Subscripcio::find($request->route()->parameters()['subscripcio']->id)->client_id == $request->user()->id) {
            $isowner = true;
        }

        if (str_contains($url, 'targeta') && TargetaUsuari::find($request->route()->parameters()['targeta']->id)->client_id == $request->user()->id) {
            $isowner = true;
        }

        if (str_contains($url, 'valoracio') && Valoracio::find($request->route()->parameters()['valoracio']->id)->client_id == $request->user()->id) {
            $isowner = true;
        }

        if ($isowner) {
            return $next($request);
        }

        abort(403, 'No ets el propietari');
    }
}
