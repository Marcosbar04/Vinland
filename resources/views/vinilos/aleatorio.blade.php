@extends('layouts.app')
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
    padding-top: 3rem;
    padding-bottom: 3rem;
}

.mb-4 {
    margin-bottom: 1.5rem !important;
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

.alerta-info {
    color: #0c5460;
    background-color: #d1ecf1;
    border-color: #bee5eb;
}

/* Tarjeta de vinilo */
.tarjeta-vinilo {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: 0.25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15);
    overflow: hidden;
    transition: all 0.3s ease;
}

/* Filas y columnas */
.fila {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.fila-sin-margen {
    display: flex;
    flex-wrap: wrap;
    margin-right: 0;
    margin-left: 0;
}

.col-md-4 {
    position: relative;
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
}

.col-md-8 {
    position: relative;
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
}

/* Imagen de portada */
.posicion-relativa {
    position: relative;
}

.img-fluida {
    max-width: 100%;
    height: auto;
}

.vinilo-portada {
    transition: all 0.4s ease;
    height: 100%;
    object-fit: cover;
}

.tarjeta-vinilo:hover .vinilo-portada {
    transform: scale(1.05);
}

.borde-redondeado-inicio {
    border-top-left-radius: 0.25rem;
    border-bottom-left-radius: 0.25rem;
}

/* Overlay con información */
.posicion-absoluta {
    position: absolute;
}

.inferior-0 {
    bottom: 0;
}

.inicio-0 {
    left: 0;
}

.w-100 {
    width: 100% !important;
}

.p-3 {
    padding: 1rem !important;
}

.bg-oscuro {
    background-color: rgba(0, 0, 0, 0.75);
}

.texto-blanco {
    color: #fff !important;
}

/* Contenido de la tarjeta */
.tarjeta-cuerpo {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.tarjeta-titulo {
    font-size: 1.5rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
    line-height: 1.2;
}

.tarjeta-subtitulo {
    font-size: 1.25rem;
    font-weight: 500;
    margin-top: -0.375rem;
    margin-bottom: 0.75rem;
    color: #6c757d;
}

.tarjeta-texto {
    margin-bottom: 1rem;
}

.texto-muted {
    color: #6c757d !important;
}

/* Precio */
.fs-4 {
    font-size: 1.5rem !important;
}

.fw-bold {
    font-weight: 700 !important;
}

.texto-primario {
    color: #007bff !important;
}

.mb-4 {
    margin-bottom: 1.5rem !important;
}

/* Audio player */
.audio-player {
    border-radius: 30px;
    background-color: #f8f9fa;
    width: 100%;
}

/* Botones y badges */
.contenedor-flex {
    display: flex;
}

.justify-between {
    justify-content: space-between;
}

.alinear-centro {
    align-items: center;
}

.flex-wrap {
    flex-wrap: wrap;
}

.mt-auto {
    margin-top: auto;
}

.mt-3 {
    margin-top: 1rem !important;
}

.mb-2 {
    margin-bottom: 0.5rem !important;
}

.d-inline {
    display: inline !important;
}

.btn {
    display: inline-block;
    font-weight: 400;
    color: #212529;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
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

.btn-outline-peligro {
    color: #dc3545;
    border-color: #dc3545;
}

.btn-outline-peligro:hover {
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-outline-secundario {
    color: #6c757d;
    border-color: #6c757d;
}

.btn-outline-secundario:hover {
    color: #fff;
    background-color: #6c757d;
    border-color: #6c757d;
}

.btn-outline-primario {
    color: #007bff;
    border-color: #007bff;
}

.btn-outline-primario:hover {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
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

/* Utilidades */
.h-100 {
    height: 100% !important;
}

/* Media Queries para Responsive */
@media (min-width: 768px) {
    .col-md-4 {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
    
    .col-md-8 {
        flex: 0 0 66.666667%;
        max-width: 66.666667%;
    }
    
    .tarjeta-vinilo {
        min-height: 450px;
    }
}

@media (max-width: 767.98px) {
    .fila, .fila-sin-margen {
        flex-direction: column;
    }
    
    .contenedor-flex {
        flex-direction: column;
    }
    
    .contenedor-flex > div {
        margin-bottom: 0.5rem;
        width: 100%;
    }
    
    .contenedor-flex.justify-between .mb-2 {
        margin-bottom: 1rem !important;
    }
}
</style>

<div class="contenedor">
    <h1 class="mb-4"><i class="fas fa-random"></i> Explora Vinilos Aleatorios</h1>
    
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
    
    @if($vinilo)
    <div class="tarjeta-vinilo">
        <div class="fila-sin-margen">
            <div class="col-md-4">
                <div class="posicion-relativa">
                    <img src="{{ asset($vinilo->imagen ? 'storage/'.$vinilo->imagen : 'img/no-cover.jpg') }}" 
                         class="img-fluida borde-redondeado-inicio vinilo-portada" alt="{{ $vinilo->titulo }}"
                         style="height: 100%; object-fit: cover;">
                    
                    <div class="posicion-absoluta inferior-0 inicio-0 w-100 p-3 bg-oscuro texto-blanco">
                        <div class="contenedor-flex justify-between alinear-centro">
                            <span><i class="fas fa-compact-disc"></i> {{ $vinilo->anio }}</span>
                            <span class="badge badge-primario">{{ $vinilo->genero }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="tarjeta-cuerpo">
                    <div>
                        <h3 class="tarjeta-titulo">{{ $vinilo->titulo }}</h3>
                        <h5 class="tarjeta-subtitulo">{{ $vinilo->artista }}</h5>
                        
                        <p class="tarjeta-texto mb-4">
                            <span class="fs-4 fw-bold texto-primario">{{ number_format($vinilo->precio_unitario, 2) }} €</span>
                        </p>
                        
                        @if($vinilo->preview_audio)
                        <div class="mb-4">
                            <h6><i class="fas fa-headphones"></i> Preview:</h6>
                            <audio controls class="audio-player w-100">
                                <source src="{{ asset('storage/'.$vinilo->preview_audio) }}" type="audio/mpeg">
                                Tu navegador no soporta el elemento de audio.
                            </audio>
                        </div>
                        @endif
                    </div>
                    
                    <div class="mt-auto">
                        <div class="contenedor-flex justify-between alinear-centro flex-wrap">
                            <div class="mb-2">
                                @auth
                                <form action="{{ route('likes.toggle', $vinilo->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-peligro">
                                        <i class="fas {{ $userLike ? 'fa-heart-broken' : 'fa-heart' }}"></i> 
                                        {{ $userLike ? 'Quitar de favoritos' : 'Añadir a favoritos' }}
                                    </button>
                                </form>
                                @endauth
                            </div>
                            
                            <div class="mb-2">
                                @auth
                                <form action="{{ route('pedidos.agregar', $vinilo->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="cantidad" value="1">
                                    <button type="submit" class="btn btn-primario">
                                        <i class="fas fa-shopping-cart"></i> Añadir al carrito
                                    </button>
                                </form>
                                @else
                                <a href="{{ route('login') }}" class="btn btn-primario">
                                    <i class="fas fa-sign-in-alt"></i> Inicia sesión para comprar
                                </a>
                                @endauth
                            </div>
                        </div>
                        
                        <div class="mt-3 contenedor-flex justify-between">
                            <a href="{{ route('vinilos.show', $vinilo->id) }}" class="btn btn-outline-secundario">
                                <i class="fas fa-info-circle"></i> Ver detalles
                            </a>
                            
                            <a href="{{ route('vinilos.random') }}" class="btn btn-outline-primario" id="next-vinilo">
                                <i class="fas fa-random"></i> Siguiente vinilo
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="alerta alerta-info">
        <i class="fas fa-info-circle"></i> No hay vinilos disponibles para explorar.
    </div>
    @endif
</div>

<style>
.vinilo-card {
    transition: all 0.3s ease;
    overflow: hidden;
}

.vinilo-cover {
    transition: all 0.4s ease;
}

.vinilo-card:hover .vinilo-cover {
    transform: scale(1.05);
}

@media (min-width: 768px) {
    .vinilo-card {
        min-height: 450px;
    }
}

audio {
    border-radius: 30px;
    background-color: #f8f9fa;
}

.like-btn.liked {
    background-color: #dc3545;
    color: white;
}
</style>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Añadir animación al cambiar de vinilo
        const nextBtn = document.getElementById('next-vinilo');
        if (nextBtn) {
            nextBtn.addEventListener('click', function(e) {
                const card = document.querySelector('.tarjeta-vinilo');
                card.style.opacity = '0.5';
                card.style.transform = 'translateX(20px)';
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateX(0)';
                }, 300);
            });
        }
        
        // Inicializar reproductor de audio
        const audioPlayer = document.querySelector('audio');
        if (audioPlayer) {
            audioPlayer.volume = 0.7; // Establece un volumen predeterminado
        }
    });
</script>
@endsection
