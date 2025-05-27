@extends('layouts.app')

@section('content')
<style>
.contenedor {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
    max-width: 1140px;
}

.mb-4 {
    margin-bottom: 1.5rem !important;
}

.fila {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.col-md-4 {
    position: relative;
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
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
    height: 100%;
}

.tarjeta-img-superior {
    width: 100%;
    border-top-left-radius: calc(0.25rem - 1px);
    border-top-right-radius: calc(0.25rem - 1px);
    object-fit: cover;
    height: 200px; 
}

.tarjeta-cuerpo {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
}

.tarjeta-titulo {
    margin-bottom: 0.75rem;
    font-size: 1.25rem;
    font-weight: 500;
    line-height: 1.2;
}

.tarjeta-texto {
    margin-top: 0;
    margin-bottom: 1rem;
}

.tarjeta-pie {
    padding: 0.75rem 1.25rem;
    background-color: #fff;
    border-top: 1px solid rgba(0,0,0,.125);
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

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    line-height: 1.5;
    border-radius: 0.2rem;
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

.btn-exito {
    color: #fff;
    background-color: #28a745;
    border-color: #28a745;
}

.btn-exito:hover {
    color: #fff;
    background-color: #218838;
    border-color: #1e7e34;
}

.d-flex {
    display: flex !important;
}

.justify-content-center {
    justify-content: center !important;
}

.h-100 {
    height: 100% !important;
}

.bg-white {
    background-color: #fff !important;
}

@media (min-width: 768px) {
    .col-md-4 {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
}

@media (max-width: 767.98px) {
    .fila {
        flex-direction: column;
    }
    
    .col-md-4 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
</style>

<div class="contenedor">
    <h1 class="mb-4">Catálogo de Vinilos</h1>
    
    @if($esAdmin)
    <div class="mb-4">
        <a href="{{ route('vinilos.create') }}" class="btn btn-exito">
            <i class="fas fa-plus"></i> Añadir Nuevo Vinilo
        </a>
    </div>
    @endif

    <div class="fila">
        @foreach($vinilos as $vinilo)
        <div class="col-md-4 mb-4">
            <div class="tarjeta h-100">
                <img src="{{ asset('storage/'.$vinilo->imagen) }}" class="tarjeta-img-superior" alt="{{ $vinilo->titulo }}">
                <div class="tarjeta-cuerpo">
                    <h5 class="tarjeta-titulo">{{ $vinilo->titulo }}</h5>
                    <p class="tarjeta-texto">
                        <strong>Artista:</strong> {{ $vinilo->artista }}<br>
                        <strong>Género:</strong> {{ ucfirst($vinilo->genero) }}<br>
                        <strong>Año:</strong> {{ $vinilo->anio }}<br>
                        <strong>Precio:</strong> {{ number_format($vinilo->precio_unitario, 2) }} €
                    </p>
                </div>
                <div class="tarjeta-pie bg-white">
                    <a href="{{ route('vinilos.show', $vinilo->id) }}" class="btn btn-primario btn-sm">
                        <i class="fas fa-eye"></i> Ver Detalles
                    </a>
                    @if($esAdmin)
                    <a href="{{ route('vinilos.edit', $vinilo->id) }}" class="btn btn-alerta btn-sm">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
            {{ $vinilos->links('custom.pagination') }}
    </div>
</div>
@endsection
