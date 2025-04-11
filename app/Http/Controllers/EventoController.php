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
}
