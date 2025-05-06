@extends('voyager::master')

@section('page_title', 'Lista de Eventos')

@section('content')
    <div class="page-content container-fluid">
        {{-- Mostrar el menú definido en Voyager --}}
        <div class="menu-container">
            {!! menu('user', 'bootstrap') !!}
        </div>

        {{-- Mensaje de éxito --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Botón para crear un nuevo evento --}}
        <a href="{{ route('eventos.crear') }}" class="btn btn-primary mb-3">Crear Nuevo Evento</a>

        {{-- Lista de eventos --}}
        <h2>📋 Lista de Eventos</h2>
        <div class="row">
            @forelse($eventos as $evento)
                <div class="col-md-6">
                    <div class="panel" style="padding: 20px; border-radius: 12px; margin-bottom: 20px;">
                        {{-- Imagen del evento (si existe) --}}
                        @if($evento->imagen)
                            <img src="{{ asset('storage/' . $evento->imagen) }}" alt="Imagen del evento" style="width:100%; max-height:200px; object-fit:cover; border-radius:8px; margin-bottom:10px;">
                        @endif

                        <h4>🎭 {{ $evento->titulo }}</h4>
                        <p><strong>📅 Fecha:</strong> {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</p>
                        <p><strong>⏰ Hora:</strong> {{ \Carbon\Carbon::parse($evento->hora)->format('h:i A') }}</p>
                        <p><strong>📍 Ubicación:</strong> {{ $evento->ubicacion }}</p>
                        <p><strong>📝 Descripción:</strong> {{ $evento->descripcion }}</p>
                        <a href="{{ route('eventos.show', $evento->id) }}" class="btn btn-info">Ver detalles</a>
                    </div>
                </div>
            @empty
                <p>No hay eventos disponibles por ahora.</p>
            @endforelse
        </div>
    </div>
@endsection