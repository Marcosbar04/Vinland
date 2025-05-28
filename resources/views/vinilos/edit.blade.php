@extends('layouts.app')

@section('title', 'Editar ' . $vinilo->titulo)

@section('content')
<style>
/* Estilos generales del contenedor */
.contenedor {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
    max-width: 1140px;
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
}

/* Contenedor Flex */
.contenedor-flex {
    display: flex;
}

.justify-between {
    justify-content: space-between;
}

.alinear-centro {
    align-items: center;
}

/* Márgenes y espaciados */
.mb-0 {
    margin-bottom: 0 !important;
}

.mb-1 {
    margin-bottom: 0.25rem !important;
}

.mb-2 {
    margin-bottom: 0.5rem !important;
}

.mb-3 {
    margin-bottom: 1rem !important;
}

.mb-4 {
    margin-bottom: 1.5rem !important;
}

.mt-1 {
    margin-top: 0.25rem !important;
}

.mt-2 {
    margin-top: 0.5rem !important;
}

.mt-3 {
    margin-top: 1rem !important;
}

/* Filas y columnas */
.fila {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.col-md-6 {
    position: relative;
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
}

/* Alertas */
.alerta {
    position: relative;
    padding: 0.75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: 0.25rem;
}

.alerta-exito {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.alerta-error {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}

.alerta-alerta {
    color: #856404;
    background-color: #fff3cd;
    border-color: #ffeeba;
}

/* Tarjetas */
.tarjeta {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: 0.25rem;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15);
}

.tarjeta-cuerpo {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
}

/* Formulario */
.formulario-label {
    margin-bottom: 0.5rem;
    display: inline-block;
}

.formulario-control {
    display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.formulario-control:focus {
    border-color: #86b7fe;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.formulario-control.es-invalido {
    border-color: #dc3545;
    padding-right: calc(1.5em + 0.75rem);
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

.formulario-texto {
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #6c757d;
}

.feedback-invalido {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875rem;
    color: #dc3545;
}

/* Input Group */
.grupo-input {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: stretch;
    width: 100%;
}

.grupo-input-texto {
    display: flex;
    align-items: center;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: center;
    white-space: nowrap;
    background-color: #e9ecef;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

.grupo-input > .formulario-control {
    flex: 1 1 auto;
    width: 1%;
    min-width: 0;
}

/* Checkboxes y Switches */
.form-check {
    display: block;
    min-height: 1.5rem;
    padding-left: 1.5em;
    margin-bottom: 0.125rem;
}

.form-check-input {
    width: 1em;
    height: 1em;
    margin-top: 0.25em;
    vertical-align: top;
    background-color: #fff;
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
    border: 1px solid rgba(0,0,0,.25);
    appearance: none;
    margin-left: -1.5em;
}

.form-check-input[type="checkbox"] {
    border-radius: 0.25em;
}

.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.form-check-input:checked[type="checkbox"] {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e");
}

.form-switch {
    padding-left: 2.5em;
}

.form-switch .form-check-input {
    width: 2em;
    margin-left: -2.5em;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='rgba%280, 0, 0, 0.25%29'/%3e%3c/svg%3e");
    background-position: left center;
    border-radius: 2em;
    transition: background-position 0.15s ease-in-out;
}

.form-switch .form-check-input:checked {
    background-position: right center;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e");
}

.form-check-label {
    color: #212529;
}

/* Botones */
.btn {
    display: inline-block;
    font-weight: 400;
    color: #212529;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    user-select: none;
    background-color: transparent;
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.btn-primario {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primario:hover {
    color: #fff;
    background-color: #0069d9;
    border-color: #0062cc;
}

.btn-outline-secundario {
    color: #6c757d;
    background-color: transparent;
    border-color: #6c757d;
}

.btn-outline-secundario:hover {
    color: #fff;
    background-color: #6c757d;
    border-color: #6c757d;
}

/* Imágenes */
.img-miniatura {
    padding: 0.25rem;
    background-color: #fff;
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
    max-width: 100%;
    height: auto;
}

/* Audio con Wave */
.waveform {
    width: 100%;
    height: 80px;
    margin-bottom: 15px;
    position: relative;
    background-color: #f8f9fa;
    border-radius: 4px;
    overflow: hidden;
}

.audio-player {
    padding: 15px;
    border-radius: 8px;
    background-color: #f8f9fa;
    margin: 15px 0;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.audio-controls {
    display: flex;
    align-items: center;
    margin-top: 10px;
}

.audio-controls button {
    border: none;
    background: transparent;
    font-size: 20px;
    cursor: pointer;
    color: #555;
    transition: color 0.2s;
    margin-right: 15px;
}

.audio-controls button:hover {
    color: #007bff;
}

.audio-time {
    margin-left: auto;
    font-size: 14px;
    font-family: monospace;
    color: #666;
}

.volume-control {
    display: flex;
    align-items: center;
    margin-left: 15px;
}

.volume-control input {
    width: 80px;
}

/* Utilidades */
.d-none {
    display: none !important;
}

.d-inline {
    display: inline !important;
}

.d-flex {
    display: flex !important;
}

.w-100 {
    width: 100% !important;
}

/* Media Queries para Responsive */
@media (min-width: 768px) {
    .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
    }
}

@media (max-width: 767.98px) {
    .contenedor-flex {
        flex-direction: column;
    }
    
    .contenedor-flex > div {
        margin-top: 1rem;
    }
    
    .fila {
        flex-direction: column;
    }
    
    .tarjeta-cuerpo .contenedor-flex {
        flex-direction: column;
    }
    
    .tarjeta-cuerpo .contenedor-flex > a,
    .tarjeta-cuerpo .contenedor-flex > button {
        margin-top: 0.5rem;
        width: 100%;
    }
}
</style>
<div class="contenedor">
    <div class="fila" style="justify-content: space-between; align-items: center;">
        <h1>Editar Vinilo</h1>
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
            <form action="{{ route('vinilos.update', $vinilo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="fila">
                    <div class="col-md-6">
                        <label class="formulario-label" for="titulo">Título</label>
                        <input class="formulario-control" id="titulo" name="titulo" value="{{ old('titulo', $vinilo->titulo) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="formulario-label" for="artista">Artista</label>
                        <input class="formulario-control" id="artista" name="artista" value="{{ old('artista', $vinilo->artista) }}" required>
                    </div>
                </div>

                <div class="fila">
                    <div class="col-md-6">
                        <label class="formulario-label" for="genero">Género</label>
                        <input class="formulario-control" id="genero" name="genero" value="{{ old('genero', $vinilo->genero) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="formulario-label" for="anio">Año</label>
                        <input type="number" class="formulario-control" id="anio" name="anio" value="{{ old('anio', $vinilo->anio) }}" min="1900" max="{{ date('Y') + 1 }}" required>
                    </div>
                </div>

                <div class="fila">
                    <div class="col-md-6">
                        <label class="formulario-label" for="precio_unitario">Precio (€)</label>
                        <input type="number" class="formulario-control" id="precio_unitario" name="precio_unitario" value="{{ old('precio_unitario', $vinilo->precio_unitario) }}" step="0.01" min="0" required>
                    </div>
                    <div class="col-md-6">
                        <label class="formulario-label" for="imagen">Portada del Vinilo</label>
                        <input type="file" class="formulario-control" id="imagen" name="imagen" accept="image/*">
                        @if($vinilo->imagen)
                            <div class="mt-2">
                                <p>Imagen actual:</p>
                                <img src="{{ asset('storage/'.$vinilo->imagen) }}" alt="Portada actual" class="img-miniatura" style="max-height: 100px;">
                            </div>
                        @endif
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
                            <p>Previsualización del nuevo audio:</p>
                            <audio id="audio-preview" controls class="w-100"></audio>
                        </div>
<input type="hidden" name="preview_audio_path" id="preview_audio_path" value="{{ old('preview_audio_path', $vinilo->preview_audio) }}">

                        @if($vinilo->preview_audio)
                            <div class="mt-3">
                                <p>Audio actual:</p>
                                <audio controls class="w-100">
                                    <source src="{{ asset('storage/' . $vinilo->preview_audio) }}" type="audio/mpeg">
                                    Tu navegador no soporta la reproducción de audio.
                                </audio>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="fila mt-3">
                    <label>
                        <input type="checkbox" name="visible" value="1" {{ old('visible', $vinilo->visible ?? true) ? 'checked' : '' }}> Visible en la tienda
                    </label>
                </div>

                <div class="fila" style="justify-content: space-between; margin-top: 2rem;">
                    <a href="{{ route('vinilos.index') }}" class="btn btn-outline-secundario">Cancelar</a>
                    <button type="submit" class="btn btn-primario">Guardar Cambios</button>
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
