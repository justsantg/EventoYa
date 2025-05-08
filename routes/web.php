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

// ➕ Ruta para almacenar eventos
Route::post('/admin/eventos', [EventoController::class, 'store'])->name('eventos.store')->middleware('auth');

// 🌟 Ruta para mostrar un evento específico
Route::get('/admin/eventos/{id}', [EventoController::class, 'show'])->name('eventos.show')->middleware('auth');

// ✏️ Ruta para editar
Route::get('/eventos/{id}/edit', [EventoController::class, 'edit'])
    ->middleware('auth')
    ->name('eventos.edit');

// 🔄 Ruta para actualizar
Route::put('admin/eventos/{id}', [EventoController::class, 'update'])
    ->middleware('auth')
    ->name('eventos.update');

// 🗑️ Ruta para eliminar
Route::delete('admin/eventos/{id}', [EventoController::class, 'destroy'])
    ->middleware('auth')
    ->name('eventos.destroy');
    
// 🚪 Rutas Voyager (debe ir al final)
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
