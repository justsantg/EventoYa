@extends('eventos.layout')

@section('title', 'Proponer un Evento')

@section('content')
    <h1>➕ Proponer un Evento</h1>

    @if($errors->any())
        <div class="mensaje-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="titulo">🎭 Título:</label>
        <input type="text" name="titulo" id="titulo" required>

        <label for="descripcion">📝 Descripción:</label>
        <textarea name="descripcion" id="descripcion" rows="4" required style="width: 100%; padding: 10px; border-radius: 8px; margin-bottom: 15px; border: 1px solid #ccc;"></textarea>

        <label for="fecha">📅 Fecha:</label>
        <input type="date" name="fecha" id="fecha" required>

        <label for="hora">⏰ Hora:</label>
        <input type="time" name="hora" id="hora" required>

        <label for="ubicacion">📍 Ubicación:</label>
        <input type="text" name="ubicacion" id="ubicacion" required>

        <label for="imagen">🖼 Imagen del evento:</label>
        <input type="file" name="imagen" id="imagen" accept="image/*">


        <button type="submit">Enviar Evento</button>
    </form>
@endsection
