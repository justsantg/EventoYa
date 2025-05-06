<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;

class EventoController extends Controller
{
    public function index()
{
    $eventos = Evento::all();

    $eventosParaCalendario = $eventos->map(function ($evento) {
        return [
            'title' => $evento->titulo,
            'start' => $evento->fecha,
            'url' => route('eventos.show', $evento->id),  // This line is correct as long as 'eventos.show' points to the right route
        ];
    });

    return view('eventos.index', compact('eventos', 'eventosParaCalendario'));
}

    public function show($id)
    {
        $evento = Evento::findOrFail($id);
        return view('eventos.show', compact('evento'));
    }
    
    /**
     * Store a newly created evento in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'titulo' => 'required',
            'fecha' => 'required|date',
            'hora' => 'required',
            'descripcion' => 'required',
            'ubicacion' => 'required',
            'Imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Añade aquí otras validaciones según los campos de tu formulario
        ]);

        // Crear el nuevo evento
        $evento = new Evento();
        $evento->titulo = $request->titulo;
        $evento->fecha = $request->fecha;
        $evento->hora = $request->hora;
        $evento->descripcion = $request->descripcion; // Asegúrate de asignar la descripción
        $evento->ubicacion = $request->ubicacion; // Asegúrate de asignar la ubicación
        if ($request -> hasFile('Imagen')){
            $imagen = $request->file('Imagen');
            $rutaImagen = $imagen->store('eventos', 'public');
            $evento->imagen = $rutaImagen;
        
        }
        
        // Por defecto podría estar pendiente de aprobación
        $evento->aprobado = 0;
        
        $evento->save();

        // Redireccionar - puedes cambiar esta redirección según tus necesidades
        return redirect()->route('user.dashboard') 
            ->with('success', 'Evento creado exitosamente. Está pendiente de aprobación.');
    }
}