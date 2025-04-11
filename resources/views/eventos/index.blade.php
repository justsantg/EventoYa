@extends('eventos.layout')

@section('title', 'Eventos en Pasto')

@section('content')

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="mensaje-exito">{{ session('success') }}</div>
    @endif

    {{-- Lista de eventos --}}
    <h2>📋 Lista de Eventos</h2>
    @forelse($eventos as $evento)
        <div class="evento" id="evento-{{ $evento->id }}" style="background: white; padding: 20px; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 0 5px rgba(0,0,0,0.1);">

            {{-- Imagen del evento (si existe) --}}
            @if($evento->imagen)
                <img src="{{ asset('storage/' . $evento->imagen) }}" alt="Imagen del evento" style="width:100%; max-height:250px; object-fit:cover; border-radius:8px; margin-bottom:15px;">
            @endif

            <h2>🎭 {{ $evento->titulo }}</h2>
            <p><strong>📅 Fecha:</strong> {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</p>
            <p><strong>⏰ Hora:</strong> {{ \Carbon\Carbon::parse($evento->hora)->format('h:i A') }}</p>
            <p><strong>📍 Ubicación:</strong> {{ $evento->ubicacion }}</p>
            <p><strong>📝 Descripción:</strong> {{ $evento->descripcion }}</p>
        </div>
    @empty
        <p>No hay eventos disponibles por ahora.</p>
    @endforelse
@endsection
