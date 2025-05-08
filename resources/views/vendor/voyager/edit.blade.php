@extends('voyager::master')

@section('page_title', 'Editar Evento')

@section('content')
<div class="page-content container-fluid">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="alert alert-info">
        <strong>Editando:</strong> {{ $evento->titulo }}
    </div>

    <form id="editarEventoForm" enctype="multipart/form-data">
        @csrf
        <!-- Importante: No uses @method('PUT') aquí, lo añadiremos en FormData -->

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

        <div style="position: absolute; right: 10px;">
            <button type="button" id="guardarCambiosBtn" class="btn btn-warning">
                <i class="voyager-edit"></i> Guardar Cambios
            </button>
        </div>
    </form>
</div>

@section('javascript')
<script>
    $(document).ready(function () {
        $('#guardarCambiosBtn').click(function (e) {
            e.preventDefault();

            let formData = new FormData($('#editarEventoForm')[0]);
            formData.append('_method', 'PUT'); // Asegura que Laravel lo interprete como PUT

            $.ajax({
                url: "{{ route('eventos.update', $evento->id) }}",
                type: 'POST', // AJAX siempre usa POST con method override
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    toastr.success('Evento actualizado correctamente');
                    setTimeout(() => {
                        window.location.href = "{{ route('user.dashboard') }}"; // redirige al dashboard
                    }, 1500);
                },
                error: function (xhr) {
                    let errorMessage = xhr.responseJSON && xhr.responseJSON.message
                        ? xhr.responseJSON.message
                        : 'Error al actualizar el evento';
                    toastr.error(errorMessage);
                    console.error(xhr);
                }
            });
        });
    });
</script>
@endsection
@endsection
