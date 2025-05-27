@extends('layouts.app')

@section('title', $vinilo->titulo . ' - ' . $vinilo->artista)

@section('content')
<style>
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

.contenedor-flex {
    display: flex;
}

.justify-between {
    justify-content: space-between;
}

.alinear-centro {
    align-items: center;
}

.mb-0 {
    margin-bottom: 0 !important;
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

.inline-block {
    display: inline-block;
}

.fila {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.col-md-5, .col-md-7, .col-md-4, .col-md-8 {
    position: relative;
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
}

.fila-g-2 {
    display: flex;
    flex-wrap: wrap;
    margin-top: -0.5rem;
    margin-right: -0.5rem;
    margin-left: -0.5rem;
}

.fila-g-2 > * {
    padding-right: 0.5rem;
    padding-left: 0.5rem;
    margin-top: 0.5rem;
}

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

.alerta-info {
    color: #0c5460;
    background-color: #d1ecf1;
    border-color: #bee5eb;
}

.alerta-enlace {
    font-weight: 700;
    color: inherit;
    text-decoration: underline;
}

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
    box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
    margin-bottom: 1.5rem;
}

.tarjeta-img-superior {
    width: 100%;
    border-top-left-radius: calc(0.25rem - 1px);
    border-top-right-radius: calc(0.25rem - 1px);
    max-height: 400px;
    object-fit: contain;
    background-color: #f8f9fa;
}

.tarjeta-cuerpo {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
}

.tarjeta-cabecera {
    padding: 0.75rem 1.25rem;
    margin-bottom: 0;
    background-color: #fff;
    border-bottom: 1px solid rgba(0,0,0,.125);
}

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
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
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

.grupo-input > .formulario-control {
    position: relative;
    flex: 1 1 100px; 
    width: 10%;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

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

.btn-alerta {
    color: #212529;
    background-color: #ffc107;
    border-color: #ffc107;
}

.btn-alerta:hover {
    color: #212529;
    background-color: #e0a800;
    border-color: #d39e00;
}

.btn-peligro {
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-peligro:hover {
    color: #fff;
    background-color: #c82333;
    border-color: #bd2130;
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

.btn-outline-peligro {
    color: #dc3545;
    background-color: transparent;
    border-color: #dc3545;
}

.btn-outline-peligro:hover {
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-outline-peligro.activo {
    background-color: #dc3545;
    color: white;
    border-color: #dc3545;
}

.lista-grupo {
    display: flex;
    flex-direction: column;
    padding-left: 0;
    margin-bottom: 0;
    border-radius: 0.25rem;
}

.lista-grupo-item {
    position: relative;
    display: block;
    padding: 0.75rem 1.25rem;
    background-color: #fff;
    border: 1px solid rgba(0,0,0,.125);
}

.lista-grupo-item:first-child {
    border-top-left-radius: inherit;
    border-top-right-radius: inherit;
}

.lista-grupo-item:last-child {
    border-bottom-left-radius: inherit;
    border-bottom-right-radius: inherit;
}

.lista-grupo-item + .lista-grupo-item {
    border-top-width: 0;
}

.lista-grupo-flush .lista-grupo-item {
    border-right-width: 0;
    border-left-width: 0;
    border-radius: 0;
}

.lista-grupo-flush .lista-grupo-item:first-child {
    border-top-width: 0;
}

.badge {
    display: inline-block;
    padding: 0.35em 0.65em;
    font-size: 0.75em;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25rem;
}

.badge-primario {
    background-color: #007bff;
}

.badge-pill {
    padding-right: 0.6em;
    padding-left: 0.6em;
    border-radius: 10rem;
}

/* Texto */
.texto-primario {
    color: #007bff !important;
}

.texto-muted {
    color: #6c757d !important;
}

.texto-fin {
    text-align: right !important;
}

.fw-bold {
    font-weight: 700 !important;
}

/* Audio Player Personalizado */
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
.w-100 {
    width: 100% !important;
}

.d-inline {
    display: inline !important;
}

.bg-white {
    background-color: #fff !important;
}

/* Media Queries para Responsive */
@media (min-width: 768px) {
    .col-md-4 {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
    
    .col-md-5 {
        flex: 0 0 41.666667%;
        max-width: 41.666667%;
    }
    
    .col-md-7 {
        flex: 0 0 58.333333%;
        max-width: 58.333333%;
    }
    
    .col-md-8 {
        flex: 0 0 66.666667%;
        max-width: 66.666667%;
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
    
    .fila-g-2 {
        flex-direction: column;
    }
    
    .fila-g-2 > * {
        width: 100%;
    }
    
    .lista-grupo-item {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>

<div class="contenedor">
    <div class="contenedor-flex justify-between alinear-centro mb-4">
        <div>
            <h1 class="mb-0">{{ $vinilo->titulo }}</h1>
            <h5 class="texto-muted">{{ $vinilo->artista }}</h5>
        </div>
        <div>
            @if($esAdmin)
            <a href="{{ route('vinilos.edit', $vinilo->id) }}" class="btn btn-alerta">
                <i class="fas fa-edit"></i> Editar
            </a>
            <form action="{{ route('vinilos.destroy', $vinilo->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-peligro" onclick="return confirm('¿Estás seguro de eliminar este vinilo?')">
                    <i class="fas fa-trash-alt"></i> Eliminar
                </button>
            </form>
            @endif
            <a href="{{ route('vinilos.index') }}" class="btn btn-outline-secundario">
                <i class="fas fa-arrow-left"></i> Volver al Catálogo
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
    
    <div class="fila">
        <div class="col-md-5">
            <div class="tarjeta mb-4">
                <img src="{{ asset($vinilo->imagen ? 'storage/'.$vinilo->imagen : 'img/no-cover.jpg') }}" 
                     class="tarjeta-img-superior" alt="{{ $vinilo->titulo }}" 
                     style="max-height: 400px; object-fit: contain; background-color: #f8f9fa;">
                     
                <div class="tarjeta-cuerpo">
                    <div class="contenedor-flex justify-between alinear-centro mb-3">
                        <h3 class="texto-primario mb-0">{{ number_format($vinilo->precio_unitario, 2) }} €</h3>
                        
                        <div>
                            @auth
                            <form action="{{ route('likes.toggle', $vinilo->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-peligro {{ $userLike ? 'activo' : '' }}">
                                    <i class="fas {{ $userLike ? 'fa-heart' : 'fa-heart' }}"></i> 
                                    {{ $userLike ? 'Quitar de favoritos' : 'Añadir a favoritos' }}
                                </button>
                            </form>
                            @endauth
                        </div>
                    </div>
                    
                    @auth
                    <form action="{{ route('pedidos.agregar', $vinilo->id) }}" method="POST" class="mt-3">
                        @csrf
                        <div class="fila-g-2">
                            <div class="col-md-4">
                                <div class="grupo-input">
                                    <span class="grupo-input-texto">Cantidad</span>
                                    <input type="number" name="cantidad" class="formulario-control" value="1" min="1" max="10">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primario w-100">
                                    <i class="fas fa-shopping-cart"></i> Añadir al Carrito
                                </button>
                            </div>
                        </div>
                    </form>
                    @else
                    <div class="alerta alerta-info mt-3">
                        <i class="fas fa-info-circle"></i> Para comprar este vinilo, debes <a href="{{ route('login') }}" class="alerta-enlace">iniciar sesión</a>.
                    </div>
                    @endauth
                </div>
            </div>
        </div>
        
        <div class="col-md-7">
            <div class="tarjeta mb-4">
                <div class="tarjeta-cabecera bg-white">
                    <h5 class="mb-0">Detalles del Vinilo</h5>
                </div>
                <div class="tarjeta-cuerpo">
                    <ul class="lista-grupo lista-grupo-flush">
                        <li class="lista-grupo-item contenedor-flex justify-between">
                            <span><strong>Artista:</strong></span>
                            <span>{{ $vinilo->artista }}</span>
                        </li>
                        <li class="lista-grupo-item contenedor-flex justify-between">
                            <span><strong>Género:</strong></span>
                            <span class="badge badge-primario badge-pill">{{ $vinilo->genero }}</span>
                        </li>
                        <li class="lista-grupo-item contenedor-flex justify-between">
                            <span><strong>Año:</strong></span>
                            <span>{{ $vinilo->anio }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            @if($vinilo->preview_audio)
            <div class="tarjeta mb-4">
                <div class="tarjeta-cabecera bg-white">
                    <h5 class="mb-0">Preview de Audio</h5>
                </div>
                <div class="tarjeta-cuerpo">
                    <div class="audio-player">
                        <div id="waveform" class="waveform"></div>
                        <div class="audio-controls">
                            <button id="playBtn" type="button" aria-label="Reproducir/Pausar"><i class="fas fa-play"></i></button>
                            <button id="stopBtn" type="button" aria-label="Detener"><i class="fas fa-stop"></i></button>
                            <div class="volume-control">
                                <button id="muteBtn" type="button" aria-label="Silenciar"><i class="fas fa-volume-up"></i></button>
                                <input type="range" id="volume" min="0" max="1" step="0.01" value="0.7">
                            </div>
                            <span class="audio-time">
                                <span id="currentTime">0:00</span> / <span id="duration">0:00</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
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
    .like-btn.active {
        background-color: #dc3545;
        color: white;
        border-color: #dc3545;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/6.4.0/wavesurfer.min.js"></script>
@if($vinilo->preview_audio)
<script>
document.addEventListener('DOMContentLoaded', function() {
    var wavesurfer = WaveSurfer.create({
        container: '#waveform',
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
    
    wavesurfer.load('{{ asset("storage/".$vinilo->preview_audio) }}');
    
    const playBtn = document.getElementById('playBtn');
    const stopBtn = document.getElementById('stopBtn');
    const muteBtn = document.getElementById('muteBtn');
    const volumeInput = document.getElementById('volume');
    const currentTimeEl = document.getElementById('currentTime');
    const durationEl = document.getElementById('duration');
    
    function formatTime(seconds) {
        seconds = Math.floor(seconds);
        const minutes = Math.floor(seconds / 60);
        seconds = seconds % 60;
        return minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
    }
    
    wavesurfer.on('audioprocess', function() {
        currentTimeEl.textContent = formatTime(wavesurfer.getCurrentTime());
    });
    
    wavesurfer.on('ready', function() {
        durationEl.textContent = formatTime(wavesurfer.getDuration());
        volumeInput.value = wavesurfer.getVolume();
    });
    
    playBtn.addEventListener('click', function() {
        wavesurfer.playPause();
        
        if (wavesurfer.isPlaying()) {
            playBtn.innerHTML = '<i class="fas fa-pause"></i>';
        } else {
            playBtn.innerHTML = '<i class="fas fa-play"></i>';
        }
    });
    
    wavesurfer.on('finish', function() {
        playBtn.innerHTML = '<i class="fas fa-play"></i>';
    });
    
    stopBtn.addEventListener('click', function() {
        wavesurfer.stop();
        playBtn.innerHTML = '<i class="fas fa-play"></i>';
    });
    
    volumeInput.addEventListener('input', function() {
        wavesurfer.setVolume(volumeInput.value);
        
        if (parseFloat(volumeInput.value) === 0) {
            muteBtn.innerHTML = '<i class="fas fa-volume-mute"></i>';
        } else if (parseFloat(volumeInput.value) < 0.5) {
            muteBtn.innerHTML = '<i class="fas fa-volume-down"></i>';
        } else {
            muteBtn.innerHTML = '<i class="fas fa-volume-up"></i>';
        }
    });
    
    let previousVolume = wavesurfer.getVolume();
    muteBtn.addEventListener('click', function() {
        if (wavesurfer.getVolume() > 0) {
            previousVolume = wavesurfer.getVolume();
            wavesurfer.setVolume(0);
            volumeInput.value = 0;
            muteBtn.innerHTML = '<i class="fas fa-volume-mute"></i>';
        } else {
            wavesurfer.setVolume(previousVolume);
            volumeInput.value = previousVolume;
            
            if (previousVolume < 0.5) {
                muteBtn.innerHTML = '<i class="fas fa-volume-down"></i>';
            } else {
                muteBtn.innerHTML = '<i class="fas fa-volume-up"></i>';
            }
        }
    });
});
</script>
@endif
@endpush