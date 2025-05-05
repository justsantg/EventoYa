<?php

use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
use App\Models\Evento;
use App\Http\Controllers\EventoController;

// 🚪 Rutas Voyager (incluye login, dashboard, CRUD, etc.)
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// 🏠 Redirigir raíz al panel de administración o a cualquier otra vista deseada
Route::get('/admin/user-dashboard', function () {
    $eventos = Evento::where('aprobado', 1)->orderBy('fecha')->get();
    return view('vendor.voyager.user-dashboard', compact('eventos'));
})->middleware('auth');

// ➕ Formulario para crear eventos desde el panel de admin
Route::get('/admin/crear', function () {
    return view('vendor.voyager.crear');
})->middleware('auth');

Route::post('/eventos', [EventoController::class, 'store'])->name('eventos.store')->middleware('auth');
