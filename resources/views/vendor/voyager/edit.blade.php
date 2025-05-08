@extends('voyager::master')

@section('page_title', 'Editar Evento')

@section('content')
    <div class="page-content container-fluid">
        <div class="alert alert-info">
            <strong>Editando:</strong> {{ $evento->titulo }}
        </div>

        {{-- Enviar a tu EventoController y no a Voyager --}}
        <form action="{{ url('admin/eventos/' . $evento->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" name="titulo" value="{{ $evento->titulo }}" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date" class="form-control" name="fecha" 
                               value="{{ \Carbon\Carbon::parse($evento->fecha)->format('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="hora">Hora</label>
                        <input type="time" class="form-control" name="hora" value="{{ $evento->hora }}" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="ubicacion">Ubicación</label>
                <input type="text" class="form-control" name="ubicacion" value="{{ $evento->ubicacion }}" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" name="descripcion" rows="5" required>{{ $evento->descripcion }}</textarea>
            </div>

            <div class="form-group">
                <label for="imagen">Imagen</label>
                @if($evento->imagen)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$evento->imagen) }}" width="200" class="img-thumbnail">
                        <p class="text-muted">Imagen actual</p>
                    </div>
                @endif
                <input type="file" class="form-control" name="imagen">
            </div>

            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('eventos.update', $evento->id) }}" class="btn btn-default">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
