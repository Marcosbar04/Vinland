@extends('layouts.admin')

@section('title', 'Detalles de Pedido')

@section('content')
<style>
.contenedor-flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.btn {
    display: inline-block;
    font-weight: 400;
    line-height: 1.5;
    text-align: center;
    text-decoration: none;
    vertical-align: middle;
    cursor: pointer;
    user-select: none;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    border-radius: 0.25rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
}

.btn-primary {
    color: #fff;
    background-color: #0d6efd;
    border: 1px solid #0d6efd;
}

.btn-primary:hover {
    background-color: #0b5ed7;
    border-color: #0a58ca;
}

.btn-secondary {
    color: #fff;
    background-color: #6c757d;
    border: 1px solid #6c757d;
}

.btn-secondary:hover {
    background-color: #5c636a;
    border-color: #565e64;
}

.btn-success {
    color: #fff;
    background-color: #198754;
    border: 1px solid #198754;
}

.btn-success:hover {
    background-color: #157347;
    border-color: #146c43;
}

.btn-outline-primary {
    color: #0d6efd;
    border: 1px solid #0d6efd;
    background-color: transparent;
}

.btn-outline-primary:hover {
    color: #fff;
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.fila {
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(-1 * 1.5rem);
    margin-right: calc(-0.5 * 1.5rem);
    margin-left: calc(-0.5 * 1.5rem);
}

.fila > * {
    flex-shrink: 0;
    width: 100%;
    max-width: 100%;
    padding-right: calc(1.5rem * 0.5);
    padding-left: calc(1.5rem * 0.5);
    margin-top: 1.5rem;
}

.col-md-8 {
    width: 66.66666667%;
}

.col-md-4 {
    width: 33.33333333%;
}

.tarjeta {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem;
    margin-bottom: 24px;
}

.tarjeta-cabecera {
    padding: 0.5rem 1rem;
    margin-bottom: 0;
    background-color: #fff;
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
}

.tarjeta-cuerpo {
    flex: 1 1 auto;
    padding: 1rem 1rem;
}

.tabla-contenedor {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.tabla {
    width: 100%;
    margin-bottom: 0;
    color: #212529;
    vertical-align: top;
    border-color: #dee2e6;
    border-collapse: collapse;
}

.tabla > thead {
    vertical-align: bottom;
}

.tabla > tbody {
    vertical-align: inherit;
}

.tabla-claro {
    background-color: #f8f9fa;
}

.tabla th,
.tabla td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}

.tabla thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
}

.tabla tfoot td {
    border-top: 2px solid #dee2e6;
}

.texto-centro {
    text-align: center !important;
}

.texto-fin {
    text-align: right !important;
}

.formulario-select {
    display: block;
    width: 100%;
    padding: 0.375rem 2.25rem 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 16px 12px;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    appearance: none;
}

.grupo-input {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: stretch;
    width: 100%;
}

.grupo-input > .formulario-select {
    position: relative;
    flex: 1 1 auto;
    width: 1%;
    min-width: 0;
}

.grupo-input > .btn {
    position: relative;
    z-index: 2;
}

.grupo-input > .formulario-select:not(:last-child),
.grupo-input > .btn:not(:last-child) {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.grupo-input > .formulario-select:not(:first-child),
.grupo-input > .btn:not(:first-child) {
    margin-left: -1px;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

.imagen-redondeada {
    border-radius: 50% !important;
}

.imagen-producto {
    width: 50px;
    height: 50px;
    border-radius: 4px;
    margin-right: 15px;
    object-fit: cover;
}

.w-100 {
    width: 100% !important;
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

.me-2 {
    margin-right: 0.5rem !important;
}

.me-3 {
    margin-right: 1rem !important;
}

.p-0 {
    padding: 0 !important;
}

.bg-white {
    background-color: #fff !important;
}

.d-flex {
    display: flex !important;
}

.align-items-center {
    align-items: center !important;
}

.fw-bold {
    font-weight: 700 !important;
}

.text-muted {
    color: #6c757d !important;
}

@media (max-width: 767.98px) {
    .contenedor-flex {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .contenedor-flex > div {
        margin-top: 1rem;
        display: flex;
        flex-direction: column;
        width: 100%;
    }
    
    .contenedor-flex > div > .btn {
        margin-bottom: 0.5rem;
    }
    
    .col-md-8,
    .col-md-4 {
        width: 100%;
    }
    
    .tabla-contenedor {
        width: 100%;
        overflow-x: auto;
    }
}
</style>

<div class="contenedor-flex">
    <h1><i class="fas fa-file-invoice"></i> Pedido #{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}</h1>
    <div>
        <a href="{{ route('facturas.descargar', $pedido->id) }}" class="btn btn-success">
            <i class="fas fa-file-pdf"></i> Descargar Factura
        </a>
        <a href="{{ route('admin.pedidos.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>
</div>

<div class="fila">
    <div class="col-md-8">
        <div class="tarjeta mb-4">
            <div class="tarjeta-cabecera bg-white">
                <h5 class="mb-0">Productos del Pedido</h5>
            </div>
            <div class="tarjeta-cuerpo p-0">
                <div class="tabla-contenedor">
                    <table class="tabla mb-0">
                        <thead class="tabla-claro">
                            <tr>
                                <th>Producto</th>
                                <th class="texto-centro">Precio Unit.</th>
                                <th class="texto-centro">Cantidad</th>
                                <th class="texto-fin">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedido->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/'.$item->vinilo->imagen) }}" class="imagen-producto" alt="{{ $item->vinilo->titulo }}">
                                        <div>
                                            <h6 class="mb-0">{{ $item->vinilo->titulo }}</h6>
                                            <small class="text-muted">{{ $item->vinilo->artista }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="texto-centro">{{ number_format($item->precio_unitario, 2) }} €</td>
                                <td class="texto-centro">{{ $item->cantidad }}</td>
                                <td class="texto-fin">{{ number_format($item->cantidad * $item->precio_unitario, 2) }} €</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="tabla-claro">
                            <tr>
                                <td colspan="3" class="texto-fin"><strong>Subtotal:</strong></td>
                                <td class="texto-fin">{{ number_format($pedido->precio_total, 2) }} €</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="texto-fin"><strong>Gastos de envío:</strong></td>
                                <td class="texto-fin">5.00 €</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="texto-fin"><strong>Total:</strong></td>
                                <td class="texto-fin fw-bold">{{ number_format($pedido->precio_total + 5, 2) }} €</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="tarjeta mb-4">
            <div class="tarjeta-cabecera bg-white">
                <h5 class="mb-0">Información del Pedido</h5>
            </div>
            <div class="tarjeta-cuerpo">
                <div class="mb-3">
                    <strong><i class="fas fa-calendar me-2"></i>Fecha:</strong>
                    <p class="mt-1">{{ $pedido->fecha_creacion->format('d/m/Y H:i') }}</p>
                </div>
                
                <div class="mb-4">
                    <strong><i class="fas fa-tag me-2"></i>Estado:</strong>
                    <form action="{{ route('admin.pedidos.update', $pedido->id) }}" method="POST" class="mt-2">
                        @csrf
                        @method('PUT')
                        <div class="grupo-input">
                            <select name="estado" class="formulario-select">
                                <option value="pendiente" {{ $pedido->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="pagado" {{ $pedido->estado == 'pagado' ? 'selected' : '' }}>Pagado</option>
                                <option value="cancelado" {{ $pedido->estado == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="tarjeta">
            <div class="tarjeta-cabecera bg-white">
                <h5 class="mb-0">Información del Cliente</h5>
            </div>
            <div class="tarjeta-cuerpo">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset($pedido->usuario->profile_image ? 'storage/' . $pedido->usuario->profile_image : 'img/default-profile.png') }}" 
                         alt="{{ $pedido->usuario->nombre_completo }}" class="imagen-redondeada me-3" width="50" height="50">
                    <div>
                        <h6 class="mb-0">{{ $pedido->usuario->nombre_completo }}</h6>
                        <small class="text-muted">{{ $pedido->usuario->email }}</small>
                    </div>
                </div>
                
                <a href="{{ route('admin.usuarios.show', $pedido->usuario->id) }}" class="btn btn-outline-primary w-100">
                    <i class="fas fa-user"></i> Ver Perfil del Cliente
                </a>
            </div>
        </div>
    </div>
</div>
@endsection