@extends('voyager::master')

@section('page_title', 'Eventos en Pasto')

@section('content')
    <div class="page-content container-fluid">
        {{-- Mensaje de éxito --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

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
                    </div>
                </div>
            @empty
                <p>No hay eventos disponibles por ahora.</p>
            @endforelse
        </div>
    </div>
@endsection
