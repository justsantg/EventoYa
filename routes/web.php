<?php

use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
use App\Models\Evento;
use App\Http\Controllers\EventoController;

// ✅ Ruta raíz redirige al dashboard del usuario
Route::get('/', function () {
    return redirect('/admin/user-dashboard');
});

// 🔐 Ruta de login redirige a Voyager
Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');

// 🏠 Ruta del dashboard de usuario
Route::get('/admin/user-dashboard', function () {
    $eventos = Evento::where('aprobado', 1)->orderBy('fecha')->get();
    return view('vendor.voyager.user-dashboard', compact('eventos'));
})->middleware('auth')->name('user.dashboard');

// 🏗️ Formulario para crear eventos
Route::get('/admin/crear', function () {
    return view('vendor.voyager.crear');
})->middleware('auth')->name('eventos.crear');

// ➕ Guardar un nuevo evento
Route::post('/admin/eventos', [EventoController::class, 'store'])
    ->middleware('auth')->name('eventos.store');

// 🌟 Mostrar un evento específico
Route::get('/admin/eventos/{id}', [EventoController::class, 'show'])
    ->middleware('auth')->name('eventos.show');

// ✏️ Formulario para editar un evento
Route::get('/eventos/{id}/edit', [EventoController::class, 'edit'])
    ->middleware('auth')->name('eventos.edit');

// 🔄 Actualizar un evento existente
Route::put('/admin/eventos/{id}', [EventoController::class, 'update'])
    ->middleware('auth')->name('eventos.update');

// 🗑️ Eliminar un evento
Route::delete('/admin/eventos/{id}', [EventoController::class, 'destroy'])
    ->middleware('auth')->name('eventos.destroy');

// 🚪 Rutas Voyager (deben ir al final)
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
