@extends('layouts.app')

@section('content')
<style>
/* Botones */
.btn {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    cursor: pointer;
    user-select: none;
    border: 1px solid transparent;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
    text-decoration: none;
}

.btn-primario {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primario:hover {
    background-color: #0069d9;
}

.btn-outline-secundario {
    color: #6c757d;
    border: 1px solid #6c757d;
    background-color: transparent;
}

.btn-outline-secundario:hover {
    background-color: #6c757d;
    color: white;
}

/* Input y formularios */
.formulario-control {
    display: block;
    width: 100%;
    padding: 0.5rem;
    font-size: 1rem;
    color: #212529;
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    margin-top: 0.25rem;
    margin-bottom: 0.5rem;
}

.formulario-label {
    font-weight: bold;
}

.form-check-input {
    margin-right: 0.5rem;
}

/* Layout */
.fila {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

.col-md-6 {
    flex: 1 1 48%;
}

@media (max-width: 768px) {
    .col-md-6 {
        flex: 1 1 100%;
    }
}

.tarjeta {
    background-color: #fff;
    padding: 1.5rem;
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
    box-shadow: 0 0.25rem 0.5rem rgba(0,0,0,0.1);
}

.tarjeta-cuerpo {
    padding: 1rem 0;
}

.contenedor {
    max-width: 900px;
    margin: 2rem auto;
    padding: 0 1rem;
}

/* Progreso */
#upload-bar {
    height: 10px;
    background-color: #007bff;
    width: 0%;
    transition: width 0.2s ease;
}
</style>

<div class="contenedor">
    <div class="fila" style="justify-content: space-between; align-items: center;">
        <h1>Añadir Nuevo Vinilo</h1>
        <a href="{{ route('vinilos.index') }}" class="btn btn-outline-secundario">Volver al Catálogo</a>
    </div>

    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 1rem; margin-top: 1rem;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background-color: #f8d7da; color: #721c24; padding: 1rem; margin-top: 1rem;">
            {{ session('error') }}
        </div>
    @endif

    <div class="tarjeta">
        <div class="tarjeta-cuerpo">
            <form action="{{ route('vinilos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="fila">
                    <div class="col-md-6">
                        <label class="formulario-label" for="titulo">Título</label>
                        <input class="formulario-control" id="titulo" name="titulo" value="{{ old('titulo') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="formulario-label" for="artista">Artista</label>
                        <input class="formulario-control" id="artista" name="artista" value="{{ old('artista') }}" required>
                    </div>
                </div>

                <div class="fila">
                    <div class="col-md-6">
                        <label class="formulario-label" for="genero">Género</label>
                        <input class="formulario-control" id="genero" name="genero" value="{{ old('genero') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="formulario-label" for="anio">Año</label>
                        <input type="number" class="formulario-control" id="anio" name="anio" value="{{ old('anio', date('Y')) }}" min="1900" max="{{ date('Y') + 1 }}" required>
                    </div>
                </div>

                <div class="fila">
                    <div class="col-md-6">
                        <label class="formulario-label" for="precio_unitario">Precio (€)</label>
                        <input type="number" class="formulario-control" id="precio_unitario" name="precio_unitario" value="{{ old('precio_unitario') }}" step="0.01" min="0" required>
                    </div>
                    <div class="col-md-6">
                        <label class="formulario-label" for="imagen">Portada del Vinilo</label>
                        <input type="file" class="formulario-control" id="imagen" name="imagen" accept="image/*" required>
                    </div>
                </div>

                <div class="fila">
                    <div class="col-md-6">
                        <label class="formulario-label">Audio de Preview</label>
                        <div id="resumable-drop" class="btn btn-outline-secundario">Subir audio (MP3/WAV)</div>
                        <div id="upload-progress" class="mt-2 d-none">
                            <div>Subiendo archivo...</div>
                            <div id="upload-bar"></div>
                        </div>
                        <div id="audio-preview-container" class="d-none mt-2">
                            <p>Previsualización del audio:</p>
                            <audio id="audio-preview" controls class="w-100"></audio>
                        </div>
                        <input type="hidden" name="preview_audio_path" id="preview_audio_path">
                    </div>
                </div>

                <div class="fila" style="margin-top: 1rem;">
                    <label>
                        <input type="checkbox" name="visible" value="1" {{ old('visible', true) ? 'checked' : '' }}> Visible en la tienda
                    </label>
                </div>

                <div class="fila" style="justify-content: space-between; margin-top: 2rem;">
                    <a href="{{ route('vinilos.index') }}" class="btn btn-outline-secundario">Cancelar</a>
                    <button type="submit" class="btn btn-primario">Guardar Vinilo</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1/resumable.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const resumable = new Resumable({
        target: '{{ route("audio.upload") }}',
        query: {_token: '{{ csrf_token() }}'},
        fileType: ['mp3', 'wav'],
        chunkSize: 1 * 1024 * 1024,
        headers: {'Accept': 'application/json'},
        testChunks: false,
        throttleProgressCallbacks: 1
    });

    resumable.assignBrowse(document.getElementById('resumable-drop'));

    resumable.on('fileAdded', function (file) {
        resumable.upload();
        document.getElementById('upload-progress').classList.remove('d-none');
        document.getElementById('upload-bar').style.width = '0%';
    });

    resumable.on('fileProgress', function (file) {
        const progress = Math.floor(file.progress() * 100);
        document.getElementById('upload-bar').style.width = progress + '%';
    });

    resumable.on('fileSuccess', function (file, response) {
        document.getElementById('upload-progress').classList.add('d-none');

        const res = JSON.parse(response);
        if (res.success && res.url) {
            document.getElementById('audio-preview').src = res.url;
            document.getElementById('audio-preview-container').classList.remove('d-none');
            document.getElementById('preview_audio_path').value = res.path;
        } else {
            alert('Error subiendo archivo');
        }
    });

    resumable.on('fileError', function (file, message) {
        document.getElementById('upload-progress').classList.add('d-none');
        alert('Error subiendo archivo: ' + message);
    });
});
</script>
@endpush
