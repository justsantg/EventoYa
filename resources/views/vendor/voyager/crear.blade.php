@extends('voyager::master')

@section('title', 'Proponer un Evento')

@section('content')
    <div class="page-content container-fluid">
        {{-- Mostrar el menú definido en Voyager --}}
        <div class="menu-container">
            {!! menu('user', 'bootstrap') !!}
        </div>

        <h1>➕ Proponer un Evento</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('voyager.eventos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="titulo">🎭 Título:</label>
                <input type="text" name="titulo" id="titulo" required class="form-control">
            </div>

            <div class="form-group">
                <label for="descripcion">📝 Descripción:</label>
                <textarea name="descripcion" id="descripcion" rows="4" required class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="fecha">📅 Fecha:</label>
                <input type="date" name="fecha" id="fecha" required class="form-control">
            </div>

            <div class="form-group">
                <label for="hora">⏰ Hora:</label>
                <input type="time" name="hora" id="hora" required class="form-control">
            </div>

            <div class="form-group">
                <label for="ubicacion">📍 Ubicación:</label>
                <input type="text" name="ubicacion" id="ubicacion" required class="form-control">
            </div>

            <div class="form-group">
                <label for="imagen">🖼 Imagen del evento:</label>
                <input type="file" name="imagen" id="imagen" accept="image/*" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Enviar Evento</button>
        </form>
    </div>
@endsection