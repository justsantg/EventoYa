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
                'url' => route('eventos.show', $evento->id),
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
            // Añade aquí otras validaciones según los campos de tu formulario
        ]);

        // Crear el nuevo evento
        $evento = new Evento();
        $evento->titulo = $request->titulo;
        $evento->fecha = $request->fecha;
        $evento->hora = $request->hora;
        // Completa con otros campos según tu formulario y modelo
        
        // Por defecto podría estar pendiente de aprobación
        $evento->aprobado = 0;
        
        $evento->save();

        // Redireccionar - puedes cambiar esta redirección según tus necesidades
        return redirect()->route('eventos.index')
            ->with('success', 'Evento creado exitosamente. Está pendiente de aprobación.');
    }
}