<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\SubscripcioController;
use App\Http\Controllers\TargetaUsuariController;
use App\Http\Controllers\UsuariRegistratController;
use App\Http\Controllers\ValoracioController;
use App\Http\Controllers\ReservaController;
use App\Models\TargetaUsuari;

// Custom middleware
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsOwner;

//
// PUBLIC PAGES
//
Route::get('/', [GeneralController::class, 'index']); // Landing page
Route::get('/about', [GeneralController::class, 'about']); // About Us
Route::get('/security', [GeneralController::class, 'security']); // Política, privacitat, etc...
Route::get('/reviews', [GeneralController::class, 'reviews']); // Reviews

//Modals
Route::get('/sala/modal/{id}', [SalaController::class, 'modal'])->name('sala.modal');
Route::get('/classes/modal/{classe}', [ClasseController::class, 'modal'])->name('classes.modal');


//
// PROTECTED PAGES
//

// Perfil (solo usuarios autenticados)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



//
// PANEL DASHBOARD (accedeix qualsevol autenticat)
//

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard.panel');



//
// Rutas de recursos protegidas por roles
//



// ADMIN (custo middleware 'IsAdmin')
Route::middleware(['auth', 'isadmin'])->group(function() {

    // Sales
    Route::get('/sales/create', [SalaController::class, 'create'])->name('sales.create');
    Route::post('/sales', [SalaController::class, 'store'])->name('sales.store');
    Route::get('/sales/{sala}/edit', [SalaController::class, 'edit'])->name('sales.edit');
    Route::put('/sales/{sala}', [SalaController::class, 'update'])->name('sales.update');
    Route::delete('/sales/{sala}', [SalaController::class, 'destroy'])->name('sales.destroy');

    // Classes
    Route::get('/classes/create', [ClasseController::class, 'create'])->name('classes.create');
    Route::post('/classes', [ClasseController::class, 'store'])->name('classes.store');
    Route::get('/classes/{classe}/edit', [ClasseController::class, 'edit'])->name('classes.edit');
    Route::put('/classes/{classe}', [ClasseController::class, 'update'])->name('classes.update');
    Route::delete('/classes/{classe}', [ClasseController::class, 'destroy'])->name('classes.destroy');

    // Reserves
    Route::get('/reserves/create', [ReservaController::class, 'create'])->name('reserves.create');
    Route::post('/reserves', [ReservaController::class, 'store'])->name('reserves.store');
    Route::get('/reserves/{reserva}/edit', [ReservaController::class, 'edit'])->name('reserves.edit');
    Route::put('/reserves/{reserva}', [ReservaController::class, 'update'])->name('reserves.update');

    // Subscripcions
    Route::get('/subscripcions/{subscripcio}/edit', [SubscripcioController::class, 'edit'])->name('subscripcions.edit');
    Route::put('/subscripcions/{subscripcio}', [SubscripcioController::class, 'update'])->name('subscripcions.update');
    Route::delete('/subscripcions/{subscripcio}', [SubscripcioController::class, 'destroy'])->name('subscripcions.destroy');

    // Targetes
    Route::delete('/targetas/{targeta}', [TargetaUsuariController::class, 'destroy'])->name('targetas.destroy');

    // Valoracions
    Route::get('/valoracions/create', [ValoracioController::class, 'create'])->name('valoracions.create');
    Route::get('/valoracions/{valoracio}/edit', [ValoracioController::class, 'edit'])->name('valoracions.edit');
    Route::put('/valoracions/{valoracio}', [ValoracioController::class, 'update'])->name('valoracions.update');

    // Usuaris
    Route::resource('usuaris', UsuariRegistratController::class);
    Route::get('/usuari/{usuari}', [UsuariRegistratController::class, 'show'])->name('usuaris.show');
});




// CLIENT, MONITOR y ADMIN
Route::middleware('auth')->group(function() {

    // Sales
    Route::get('/sales', [SalaController::class, 'index'])->name('sales.index');
    Route::get('/sales/{sala}', [SalaController::class, 'show'])->name('sales.show');

    // Classes
    Route::get('/classe', [ClasseController::class, 'index'])->name('classes.index');
    Route::get('/classe/{classe}', [ClasseController::class, 'show'])->name('classes.show');

    // Reserves
    Route::get('/reserves', [ReservaController::class, 'index'])->name('reserves.index');
    Route::get('/reserves/{reserva}', [ReservaController::class, 'show'])->name('reserves.show');

    // Valoracions
    Route::get('/valoracions/{valoracio}', [ValoracioController::class, 'show'])->name('valoracions.show');
    Route::get('valoracions', [ValoracioController::class, 'index'])->name('valoracions.index');
    
    // Exercicis (API)
    Route::get('exercicis', [APIController::class, 'index'])->name('api.index');
});





// CLIENT y ADMIN
Route::middleware(['auth', 'rol:CLIENT,ADMIN'])->group(function() {

    // Reserva
    Route::delete('/reserves/{reserva}', [ReservaController::class, 'destroy'])->name('reserves.destroy');

    // Subscripcions
    Route::get('/subscripcions', [SubscripcioController::class, 'index'])->name('subscripcions.index');
    Route::get('/subscripcions/create', [SubscripcioController::class, 'create'])->name('subscripcions.create');
    Route::post('/subscripcions', [SubscripcioController::class, 'store'])->name('subscripcions.store');
    Route::get('/subscripcions/{subscripcio}', [SubscripcioController::class, 'show'])->name('subscripcions.show');
    Route::post('/subscripcions', [SubscripcioController::class, 'store'])->name('subscripcions.store');

    // Targetes
    Route::get('/targetas', [TargetaUsuariController::class, 'index'])->name('targetas.index');
    Route::get('/targetas/create', [TargetaUsuariController::class, 'create'])->name('targetas.create');
    Route::post('/targetas', [TargetaUsuariController::class, 'store'])->name('targetas.store');
    Route::get('/targetas/{targeta}', [TargetaUsuariController::class, 'show'])->name('targetas.show');
    Route::post('/targetas', [TargetaUsuariController::class, 'store'])->name('targetas.store');
    Route::get('/targetas/{targeta}/edit', [TargetaUsuariController::class, 'edit'])->name('targetas.edit');
    Route::put('/targetas/{targeta}', [TargetaUsuariController::class, 'update'])->name('targetas.update');

    // Valoracions
    Route::get('/valoracions/create', [ValoracioController::class, 'create'])->name('valoracions.create');
    Route::post('/valoracions', [ValoracioController::class, 'store'])->name('valoracions.store');
    Route::delete('/valoracions/{valoracio}', [ValoracioController::class, 'destroy'])->name('valoracions.destroy');
    
});



// CLIENT
Route::middleware(['auth', 'rol:CLIENT'])->group(function() {
    
    // Reserva ràpida
    Route::post('/classes/{classe}/reservar', [ReservaController::class, 'quickReserve'])->name('classes.quickReserve');

});





//
// Other
//

// Targetas d'un client
Route::get('/client/{id}/targetas', function ($id) {
    return TargetaUsuari::where('client_id', $id)->get();
});

Route::middleware(['auth'])->group(function() {
    Route::get('/usuari/{user}', [UsuariRegistratController::class, 'show'])->name('users.show');
});

require __DIR__.'/auth.php';
