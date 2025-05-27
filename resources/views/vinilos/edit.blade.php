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
    <div class="contenedor-flex justify-between alinear-centro mb-4">
        <h1><i class="fas fa-edit"></i> Editar Vinilo</h1>
        <div>
            <a href="{{ route('vinilos.show', $vinilo->id) }}" class="btn btn-outline-secundario">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
    
    @if(session('success'))
        <div class="alerta alerta-exito">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alerta alerta-error">
            {{ session('error') }}
        </div>
    @endif
    
    <div class="tarjeta">
        <div class="tarjeta-cuerpo">
            <form action="{{ route('vinilos.update', $vinilo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="fila mb-3">
                    <div class="col-md-6">
                        <label for="titulo" class="formulario-label">Título</label>
                        <input type="text" class="formulario-control @error('titulo') es-invalido @enderror" 
                               id="titulo" name="titulo" value="{{ old('titulo', $vinilo->titulo) }}" required>
                        @error('titulo')
                            <div class="feedback-invalido">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="artista" class="formulario-label">Artista</label>
                        <input type="text" class="formulario-control @error('artista') es-invalido @enderror" 
                               id="artista" name="artista" value="{{ old('artista', $vinilo->artista) }}" required>
                        @error('artista')
                            <div class="feedback-invalido">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="fila mb-3">
                    <div class="col-md-6">
                        <label for="genero" class="formulario-label">Género</label>
                        <input type="text" class="formulario-control @error('genero') es-invalido @enderror" 
                               id="genero" name="genero" value="{{ old('genero', $vinilo->genero) }}" required>
                        @error('genero')
                            <div class="feedback-invalido">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="anio" class="formulario-label">Año</label>
                        <input type="number" class="formulario-control @error('anio') es-invalido @enderror" 
                               id="anio" name="anio" value="{{ old('anio', $vinilo->anio) }}" 
                               min="1900" max="{{ date('Y') + 1 }}" required>
                        @error('anio')
                            <div class="feedback-invalido">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="precio_unitario" class="formulario-label">Precio (€)</label>
                    <div class="grupo-input">
                        <input type="number" class="formulario-control @error('precio_unitario') es-invalido @enderror" 
                               id="precio_unitario" name="precio_unitario" 
                               value="{{ old('precio_unitario', $vinilo->precio_unitario) }}" 
                               step="0.01" min="0" required>
                        <span class="grupo-input-texto">€</span>
                        @error('precio_unitario')
                            <div class="feedback-invalido">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="fila mb-4">
                    <div class="col-md-6">
                        <label for="imagen" class="formulario-label">Portada del Vinilo</label>
                        <input type="file" class="formulario-control @error('imagen') es-invalido @enderror" 
                               id="imagen" name="imagen" accept="image/*">
                        @error('imagen')
                            <div class="feedback-invalido">{{ $message }}</div>
                        @enderror
                        
                        <div class="formulario-texto">Formatos permitidos: JPEG, PNG, JPG, GIF. Tamaño máximo: 2MB</div>
                        
                        @if($vinilo->imagen)
                            <div class="mt-2">
                                <p class="mb-1">Imagen actual:</p>
                                <img src="{{ asset('storage/'.$vinilo->imagen) }}" alt="Portada actual" 
                                     class="img-miniatura" style="max-height: 100px;">
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        <label for="preview_audio" class="formulario-label">Audio de Preview</label>
                        <input type="file" class="formulario-control @error('preview_audio') es-invalido @enderror" 
                               id="preview_audio" name="preview_audio" accept="audio/mp3,audio/wav">
                        @error('preview_audio')
                            <div class="feedback-invalido">{{ $message }}</div>
                        @enderror
                        
                        <div class="formulario-texto">Formatos permitidos: MP3, WAV (Recomendado: archivos de menos de 5MB para mejor rendimiento)</div>
                        
                        <div id="audio-preview-container" class="d-none mt-3">
                            <p class="mb-2">Previsualización del nuevo audio:</p>
                            <audio id="audio-preview" controls class="w-100"></audio>
                        </div>
                        
                        @if($vinilo->preview_audio)
                            <div class="mt-3">
                                <p class="mb-2">Audio actual:</p>
                                <div class="audio-player">
                                    <div id="waveform-edit" class="waveform" data-audio-url="{{ asset('storage/'.$vinilo->preview_audio) }}"></div>
                                    <div class="audio-controls">
                                        <button id="playBtn-edit" type="button" aria-label="Reproducir/Pausar"><i class="fas fa-play"></i></button>
                                        <button id="stopBtn-edit" type="button" aria-label="Detener"><i class="fas fa-stop"></i></button>
                                        <div class="volume-control">
                                            <button id="muteBtn-edit" type="button" aria-label="Silenciar"><i class="fas fa-volume-up"></i></button>
                                            <input type="range" id="volume-edit" min="0" max="1" step="0.01" value="0.7">
                                        </div>
                                        <span class="audio-time">
                                            <span id="currentTime-edit">0:00</span> / <span id="duration-edit">0:00</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="visible" name="visible" 
                               value="1" {{ old('visible', $vinilo->visible ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="visible">Visible en la tienda</label>
                    </div>
                </div>
                
                <div class="contenedor-flex justify-between">
                    <a href="{{ route('vinilos.show', $vinilo->id) }}" class="btn btn-outline-secundario">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primario">
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/6.4.0/wavesurfer.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Previsualización de la imagen subida
    const imagenInput = document.getElementById('imagen');
    if (imagenInput) {
        imagenInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                
                // Verificar si es una imagen
                if (file.type.startsWith('image/')) {
                    // Mostrar previsualización
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const imgPreview = document.createElement('img');
                        imgPreview.src = e.target.result;
                        imgPreview.className = 'img-miniatura mt-2';
                        imgPreview.style.maxHeight = '100px';
                        
                        const container = imagenInput.parentElement;
                        const existingPreview = container.querySelector('.img-preview-wrapper');
                        
                        if (existingPreview) {
                            existingPreview.querySelector('img').src = e.target.result;
                        } else {
                            const wrapper = document.createElement('div');
                            wrapper.className = 'mt-2 img-preview-wrapper';
                            const text = document.createElement('p');
                            text.className = 'mb-1';
                            text.textContent = 'Nueva imagen:';
                            
                            wrapper.appendChild(text);
                            wrapper.appendChild(imgPreview);
                            container.appendChild(wrapper);
                        }
                    };
                    reader.readAsDataURL(file);
                } else {
                    // No es una imagen
                    this.value = '';
                    alert('Por favor, selecciona un archivo de imagen válido (JPEG, PNG, JPG, GIF).');
                }
            }
        });
    }
    
    // Previsualización del audio nuevo
    const audioInput = document.getElementById('preview_audio');
    const previewContainer = document.getElementById('audio-preview-container');
    const audioPreview = document.getElementById('audio-preview');
    
    if (audioInput && previewContainer && audioPreview) {
        audioInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                
                // Verificar si es un archivo de audio
                if (file.type.startsWith('audio/')) {
                    // Crear URL para el archivo seleccionado
                    const objectURL = URL.createObjectURL(file);
                    
                    // Actualizar el elemento de audio y mostrar
                    audioPreview.src = objectURL;
                    previewContainer.classList.remove('d-none');
                    
                    // Añadir mensaje si el archivo es grande
                    const existingWarning = previewContainer.querySelector('.alerta-alerta');
                    if (file.size > 5 * 1024 * 1024) {
                        if (!existingWarning) {
                            const sizeWarning = document.createElement('div');
                            sizeWarning.className = 'alerta alerta-alerta mt-2';
                            sizeWarning.textContent = 'El archivo es grande, lo que puede afectar el rendimiento. Considera usar un archivo más pequeño.';
                            previewContainer.appendChild(sizeWarning);
                        }
                    } else if (existingWarning) {
                        existingWarning.remove();
                    }
                } else {
                    // No es un archivo de audio
                    previewContainer.classList.add('d-none');
                    this.value = '';
                    alert('Por favor, selecciona un archivo de audio válido (MP3 o WAV).');
                }
            } else {
                // No hay archivo seleccionado
                previewContainer.classList.add('d-none');
            }
        });
    }
    
    // Inicializar WaveSurfer para el audio actual
    const waveformElement = document.getElementById('waveform-edit');
    if (waveformElement) {
        const audioUrl = waveformElement.getAttribute('data-audio-url');
        
        var wavesurferEdit = WaveSurfer.create({
            container: '#waveform-edit',
            waveColor: '#4F7CAC',
            progressColor: '#007BFF',
            cursorColor: '#ff6b6b',
            barWidth: 2,
            barRadius: 3,
            cursorWidth: 1,
            height: 80,
            barGap: 2,
            responsive: true
        });
        
        wavesurferEdit.load(audioUrl);
        
        const playBtn = document.getElementById('playBtn-edit');
        const stopBtn = document.getElementById('stopBtn-edit');
        const muteBtn = document.getElementById('muteBtn-edit');
        const volumeInput = document.getElementById('volume-edit');
        const currentTimeEl = document.getElementById('currentTime-edit');
        const durationEl = document.getElementById('duration-edit');
        
        // Funciones para formatear el tiempo
        function formatTime(seconds) {
            seconds = Math.floor(seconds);
            const minutes = Math.floor(seconds / 60);
            seconds = seconds % 60;
            return minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
        }
        
        // Actualizar tiempo actual
        wavesurferEdit.on('audioprocess', function() {
            currentTimeEl.textContent = formatTime(wavesurferEdit.getCurrentTime());
        });
        
        // Actualizar duración cuando se carga el audio
        wavesurferEdit.on('ready', function() {
            durationEl.textContent = formatTime(wavesurferEdit.getDuration());
            volumeInput.value = wavesurferEdit.getVolume();
        });
        
        // Control de reproducción
        playBtn.addEventListener('click', function() {
            wavesurferEdit.playPause();
            
            if (wavesurferEdit.isPlaying()) {
                playBtn.innerHTML = '<i class="fas fa-pause"></i>';
            } else {
                playBtn.innerHTML = '<i class="fas fa-play"></i>';
            }
        });
        
        // Cuando termina la reproducción, cambiar el ícono a play
        wavesurferEdit.on('finish', function() {
            playBtn.innerHTML = '<i class="fas fa-play"></i>';
        });
        
        // Detener reproducción
        stopBtn.addEventListener('click', function() {
            wavesurferEdit.stop();
            playBtn.innerHTML = '<i class="fas fa-play"></i>';
        });
        
        // Control de volumen
        volumeInput.addEventListener('input', function() {
            wavesurferEdit.setVolume(volumeInput.value);
            
            // Actualizar icono de volumen
            if (parseFloat(volumeInput.value) === 0) {
                muteBtn.innerHTML = '<i class="fas fa-volume-mute"></i>';
            } else if (parseFloat(volumeInput.value) < 0.5) {
                muteBtn.innerHTML = '<i class="fas fa-volume-down"></i>';
            } else {
                muteBtn.innerHTML = '<i class="fas fa-volume-up"></i>';
            }
        });
        
        // Mute/Unmute
        let previousVolume = wavesurferEdit.getVolume();
        muteBtn.addEventListener('click', function() {
            if (wavesurferEdit.getVolume() > 0) {
                previousVolume = wavesurferEdit.getVolume();
                wavesurferEdit.setVolume(0);
                volumeInput.value = 0;
                muteBtn.innerHTML = '<i class="fas fa-volume-mute"></i>';
            } else {
                wavesurferEdit.setVolume(previousVolume);
                volumeInput.value = previousVolume;
                
                if (previousVolume < 0.5) {
                    muteBtn.innerHTML = '<i class="fas fa-volume-down"></i>';
                } else {
                    muteBtn.innerHTML = '<i class="fas fa-volume-up"></i>';
                }
            }
        });
    }
});
</script>
@endpush