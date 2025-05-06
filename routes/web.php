<?php

use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
use App\Models\Evento;
use App\Http\Controllers\EventoController;

// Define a login route that redirects to Voyager's login
Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');

// 🏠 Ruta del dashboard de usuario
Route::get('/admin/user-dashboard', function () {
    $eventos = Evento::where('aprobado', 1)->orderBy('fecha')->get();
    return view('vendor.voyager.user-dashboard', compact('eventos'));
})->middleware('auth')->name('user.dashboard');

// 🏗️ Ruta para mostrar el formulario de creación de eventos
Route::get('/admin/crear', function () {
    return view('vendor.voyager.crear');
})->middleware('auth')->name('eventos.crear');

// ➕ Ruta para almacenar eventos: POST a /admin/eventos
Route::post('/admin/eventos', [EventoController::class, 'store'])->name('voyager.eventos.store')->middleware('auth');

// 🌟 Ruta para mostrar un evento específico
Route::get('/admin/eventos/{id}', [EventoController::class, 'show'])->name('voyager.eventos.show')->middleware('auth');

// 🚪 Rutas Voyager (incluye login, dashboard, CRUD, etc.)
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});