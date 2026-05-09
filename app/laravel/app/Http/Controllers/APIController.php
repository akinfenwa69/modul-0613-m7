<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class APIController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get API's data
        if (env('API_EXERCISES')) {
            $exercises = Cache::remember('api_exercises', 3600,
                fn () => Http::get(env('API_EXERCISES'))->json()['data'] ?? []);
            $bodyparts = Cache::remember('api_bodyparts', 3600,
                fn () => Http::get(env('API_BODYPARTS'))->json()['data'] ?? []);
            $equipments = Cache::remember('api_equipments', 3600,
                fn () => Http::get(env('API_EQUIPMENTS'))->json()['data'] ?? []);
            $muscles = Cache::remember('api_muscles', 3600,
                fn () => Http::get(env('API_MUSCLES'))->json()['data'] ?? []);
        } else {
            $exercises = [];
            $bodyparts = [];
            $equipments = [];
            $muscles = [];
        }

        // API secondaria
        if (env('API_YUHONAS')) {
            $yuhonas_full = Cache::remember('api_yuhonas_full', 3600,
                fn () => Http::get(env('API_YUHONAS'))->json() ?? []);
            $yuhonas = array_slice($yuhonas_full, 0, 20);
        } else {
            $yuhonas = [];
        }

        return view('api.index', [
            'user' => $user,
            'exercises' => $exercises,
            'bodyparts' => $bodyparts,
            'equipments' => $equipments,
            'muscles' => $muscles,
            'yuhonas' => $yuhonas
        ]);
    }

    /**
     * DADES API $exercises:
     *
     * ID de l'exercici
     * @var exerciseId<string>
     *
     * Nom de l'exercici
     * @var name<string>
     *
     * GIF que mostra l'exercici
     * @var gifUrl<string>
     *
     * Llista de músculs treballats
     * @var targetMuscles<string[]>
     *
     * Llista de parts del cos treballats
     * @var bodyParts<string[]>
     *
     * Pes amb el que es treballa ("weighted" o "body weight")
     * @var equipments<string[]>
     *
     * Llista de músculs treballats secondaris
     * @var secondaryMuscles<string[]>
     *
     * Llista de passos per fer l'exercici
     * @var instructions<string[]>
     *
     */

     /**
     * DADES API $bodyparts, $equipments i $muscles:
     *
     * Nom
     * @var name<string>
     *
     */
}
