<?php

use Illuminate\Support\Facades\Route;
use App\Models\Evento;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;

// 🛠️ Panel de administración Voyager
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// 🏠 Página principal con lista de eventos aprobados
Route::get('/', function () {
    $eventos = Evento::where('aprobado', 1)->orderBy('fecha')->get();

    return view('eventos.index', [
        'eventos' => $eventos
    ]);
})->name('eventos.index');

// ➕ Formulario para proponer evento
Route::get('/eventos/crear', function () {
    return view('eventos.crear');
})->name('eventos.create');

// 💾 Guardar evento propuesto desde el formulario
Route::post('/eventos', function (Request $request) {
    $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'fecha' => 'required|date',
        'hora' => 'required',
        'ubicacion' => 'required|string|max:255',
        'imagen' => 'nullable|image|max:2048',
    ]);

    // 🖼 Procesar la imagen si existe
    $rutaImagen = null;

    if ($request->hasFile('imagen')) {
        $rutaImagen = $request->file('imagen')->store('eventos', 'public');
    }

    // 📥 Crear el evento
    Evento::create([
        'titulo' => $request->input('titulo'),
        'descripcion' => $request->input('descripcion'),
        'fecha' => $request->input('fecha'),
        'hora' => $request->input('hora'),
        'ubicacion' => $request->input('ubicacion'),
        'imagen' => $rutaImagen, // ← esta es la ruta relativa correcta
        'aprobado' => false,
    ]);

    return redirect('/')->with('success', '🎉 Tu evento fue enviado para revisión');
})->name('eventos.store');
