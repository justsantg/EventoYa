<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    // WEB METHODS
    
    public function index()
    {
        $eventos = Evento::where('aprobado', 1)
                        ->orderBy('fecha', 'desc')
                        ->get();
        return view('vendor.voyager.eventos.index', compact('eventos'));
    }

    public function create()
    {
        return view('vendor.voyager.crear');
    }

    public function store(Request $request)
    {
        $validated = $this->validateEvento($request);
        
        $evento = new Evento();
        $this->saveEvento($evento, $request);
        
        return redirect()->route('user.dashboard', $evento->id)
            ->with('success', 'Evento creado correctamente. Pendiente de aprobación.');
    }

    public function show($id)
    {
        $evento = Evento::findOrFail($id);
        return view('vendor.voyager.eventos.show', compact('evento'));
    }

    public function edit($id)
    {
        $evento = Evento::findOrFail($id);
        return view('vendor.voyager.edit', compact('evento'));
    }

    public function update(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);
        $validated = $this->validateEvento($request);
        $this->saveEvento($evento, $request);

        // Redirige al dashboard del usuario con un mensaje de éxito
        return redirect()->route('user.dashboard')
            ->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);

        if ($evento->imagen) {
            Storage::delete('public/' . $evento->imagen);
        }

        $evento->delete();

        // Corrige la redirección al dashboard del usuario
        return redirect()->route('user.dashboard')
            ->with('success', 'Evento eliminado correctamente.');
    }


    // API METHODS
    
    public function indexApi()
    {
        return Evento::where('aprobado', 1)
                   ->orderBy('fecha', 'desc')
                   ->get();
    }

    public function showApi($id)
    {
        return Evento::findOrFail($id);
    }

    public function storeApi(Request $request)
    {
        $validated = $this->validateEvento($request);
        
        $evento = new Evento();
        $this->saveEvento($evento, $request);
        
        return response()->json($evento, 201);
    }

    public function updateApi(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);
        $validated = $this->validateEvento($request);
        $this->saveEvento($evento, $request);
        
        return response()->json($evento);
    }

    public function destroyApi($id)
    {
        $evento = Evento::findOrFail($id);
        
        if ($evento->imagen) {
            Storage::delete('public/' . $evento->imagen);
        }
        
        $evento->delete();
        
        return response()->json(null, 204);
    }

    // HELPER METHODS
    
    private function validateEvento(Request $request)
    {
        return $request->validate([
            'titulo' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora' => 'required|string|max:50',
            'ubicacion' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|max:2048',
        ]);
    }

    private function saveEvento(Evento $evento, Request $request)
    {
        $evento->titulo = $request->titulo;
        $evento->fecha = $request->fecha;
        $evento->hora = $request->hora;
        $evento->ubicacion = $request->ubicacion;
        $evento->descripcion = $request->descripcion;
        
        if (auth()->check()) {
            $evento->user_id = auth()->id();
        }
        
        if ($request->hasFile('imagen')) {
            if ($evento->imagen) {
                Storage::delete('public/' . $evento->imagen);
            }
            $imagePath = $request->file('imagen')->store('eventos', 'public');
            $evento->imagen = $imagePath;
        }
        
        $evento->save();
    }
}