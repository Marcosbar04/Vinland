@extends('layouts.admin')

@section('title', 'Gestión de Pedidos')

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

.btn-info {
    color: #fff;
    background-color: #0dcaf0;
    border: 1px solid #0dcaf0;
}

.btn-info:hover {
    background-color: #31d2f2;
    border-color: #25cff2;
}

.btn-warning {
    color: #000;
    background-color: #ffc107;
    border: 1px solid #ffc107;
}

.btn-warning:hover {
    background-color: #ffca2c;
    border-color: #ffc720;
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

.btn-danger {
    color: #fff;
    background-color: #dc3545;
    border: 1px solid #dc3545;
}

.btn-danger:hover {
    background-color: #bb2d3b;
    border-color: #b02a37;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    border-radius: 0.2rem;
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
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem;
    margin-bottom: 24px;
}

.tarjeta-cuerpo {
    flex: 1 1 auto;
    padding: 1rem 1rem;
}

.tarjeta-pie {
    padding: 0.5rem 1rem;
    background-color: rgba(0, 0, 0, 0.03);
    border-top: 1px solid rgba(0, 0, 0, 0.125);
}

/* Formulario */
.formulario-fila {
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(-0.5 * 1rem);
    margin-right: calc(-0.5 * 0.5rem);
    margin-left: calc(-0.5 * 0.5rem);
}

.formulario-fila > * {
    flex-shrink: 0;
    width: 100%;
    max-width: 100%;
    padding-right: calc(0.5 * 0.5rem);
    padding-left: calc(0.5 * 0.5rem);
    margin-top: calc(0.5 * 1rem);
}

.col-md-4 {
    width: 33.33333333%;
}

.col-md-8 {
    width: 66.66666667%;
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

.input-control {
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
    appearance: none;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.input-control:focus, .formulario-select:focus {
    border-color: #86b7fe;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
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

.tabla-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.05);
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

.badge-pendiente {
    background-color: #ffc107;
    color: #000;
}

.badge-pagado {
    background-color: #198754;
}

.badge-cancelado {
    background-color: #dc3545;
}

.badge-enviado {
    background-color: #0dcaf0;
    color: #000;
}

/* Filtros */
.filtros-contenedor {
    background-color: #f8f9fa;
    border-radius: 0.5rem;
    padding: 1.5rem;
    margin-bottom: 2rem;
}

.filtros-titulo {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #495057;
}

.filtros-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    align-items: end;
}

.campo-filtro {
    display: flex;
    flex-direction: column;
}

.campo-filtro label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #6c757d;
    margin-bottom: 0.25rem;
}

/* Estadísticas */
.estadisticas-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.estadistica-tarjeta {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1.5rem;
    border-radius: 0.5rem;
    text-align: center;
}

.estadistica-tarjeta.exito {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}

.estadistica-tarjeta.alerta {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.estadistica-tarjeta.info {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.estadistica-numero {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.estadistica-texto {
    font-size: 0.875rem;
    opacity: 0.9;
}

/* Utilidades */
.w-100 {
    width: 100% !important;
}

.p-0 {
    padding: 0 !important;
}

.mb-0 {
    margin-bottom: 0 !important;
}

.mb-4 {
    margin-bottom: 1.5rem !important;
}

.texto-centro {
    text-align: center !important;
}

.texto-fin {
    text-align: right !important;
}

.paginacion-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

@media (max-width: 767.98px) {
    .contenedor-flex {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .contenedor-flex > * + * {
        margin-top: 1rem;
    }
    
    .formulario-fila {
        flex-direction: column;
    }
    
    .col-md-4, .col-md-8 {
        width: 100%;
    }
    
    .paginacion-info {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .paginacion-info > * + * {
        margin-top: 0.5rem;
    }
    
    .filtros-grid {
        grid-template-columns: 1fr;
    }
    
    .estadisticas-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 479.98px) {
    .estadisticas-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="contenedor-flex">
    <h1><i class="fas fa-shopping-cart"></i> Gestión de Pedidos</h1>
    <div>
        @if(Route::has('admin.pedidos.export'))
        <a href="{{ route('admin.pedidos.export') }}" class="btn btn-success">
            <i class="fas fa-file-excel"></i> Exportar Excel
        </a>
        @endif
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
    </div>
</div>

@if(isset($estadisticas))
<div class="estadisticas-grid">
    <div class="estadistica-tarjeta">
        <div class="estadistica-numero">{{ $estadisticas['total'] ?? $pedidos->total() ?? 0 }}</div>
        <div class="estadistica-texto">Total Pedidos</div>
    </div>
    <div class="estadistica-tarjeta exito">
        <div class="estadistica-numero">{{ $estadisticas['pagados'] ?? $pedidos->where('estado', 'pagado')->count() ?? 0 }}</div>
        <div class="estadistica-texto">Pedidos Pagados</div>
    </div>
    <div class="estadistica-tarjeta alerta">
        <div class="estadistica-numero">{{ $estadisticas['pendientes'] ?? $pedidos->where('estado', 'pendiente')->count() ?? 0 }}</div>
        <div class="estadistica-texto">Pedidos Pendientes</div>
    </div>
    <div class="estadistica-tarjeta info">
        <div class="estadistica-numero">€{{ number_format($estadisticas['ingresos'] ?? $pedidos->where('estado', 'pagado')->sum('precio_total') ?? 0, 2) }}</div>
        <div class="estadistica-texto">Ingresos Totales</div>
    </div>
</div>
@endif

<div class="filtros-contenedor">
    <div class="filtros-titulo">
        <i class="fas fa-filter"></i> Filtros de Búsqueda
    </div>
    <form action="{{ route('admin.pedidos.index') }}" method="GET">
        <div class="filtros-grid">
            <div class="campo-filtro">
                <label for="busqueda">Buscar</label>
                <input type="text" id="busqueda" name="busqueda" class="input-control" 
                       placeholder="ID, cliente, email..." value="{{ request('busqueda') }}">
            </div>
            
            <div class="campo-filtro">
                <label for="estado">Estado</label>
                <select name="estado" id="estado" class="formulario-select">
                    <option value="">Todos los estados</option>
                    <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="pagado" {{ request('estado') == 'pagado' ? 'selected' : '' }}>Pagado</option>
                    <option value="enviado" {{ request('estado') == 'enviado' ? 'selected' : '' }}>Enviado</option>
                    <option value="cancelado" {{ request('estado') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                </select>
            </div>
            
            <div class="campo-filtro">
                <label for="fecha_desde">Desde</label>
                <input type="date" id="fecha_desde" name="fecha_desde" class="input-control" 
                       value="{{ request('fecha_desde') }}">
            </div>
            
            <div class="campo-filtro">
                <label for="fecha_hasta">Hasta</label>
                <input type="date" id="fecha_hasta" name="fecha_hasta" class="input-control" 
                       value="{{ request('fecha_hasta') }}">
            </div>
            
            <div class="campo-filtro">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-search"></i> Buscar
                </button>
            </div>
        </div>
    </form>
</div>

<div class="tarjeta">
    <div class="tarjeta-cuerpo p-0">
        <div class="tabla-contenedor">
            <table class="tabla tabla-hover mb-0">
                <thead class="tabla-claro">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Email</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Estado</th>
                        <th scope="col" class="texto-fin">Total</th>
                        <th scope="col" class="texto-centro">Productos</th>
                        <th scope="col" class="texto-centro">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pedidos as $pedido)
                    <tr>
                        <td>
                            #{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}
                        </td>
                        <td>{{ $pedido->usuario ? $pedido->usuario->nombre_completo : 'Usuario eliminado' }}</td>
                        <td>{{ $pedido->usuario ? $pedido->usuario->email : 'N/A' }}</td>
                        <td>{{ $pedido->created_at ? $pedido->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                        <td>
                            <span class="badge badge-{{ $pedido->estado ?? 'pendiente' }}">
                                @switch($pedido->estado ?? 'pendiente')
                                    @case('pendiente')
                                        <i class="fas fa-clock"></i> Pendiente
                                        @break
                                    @case('pagado')
                                        <i class="fas fa-check-circle"></i> Pagado
                                        @break
                                    @case('enviado')
                                        <i class="fas fa-shipping-fast"></i> Enviado
                                        @break
                                    @case('cancelado')
                                        <i class="fas fa-times-circle"></i> Cancelado
                                        @break
                                    @default
                                        {{ ucfirst($pedido->estado ?? 'pendiente') }}
                                @endswitch
                            </span>
                        </td>
                        <td class="texto-fin">
                            <strong>{{ number_format(($pedido->precio_total ?? 0) + 5, 2) }} €</strong>
                            <br>
                            <small class="text-muted">+ 5€ envío</small>
                        </td>
                        <td class="texto-centro">
                            <span class="badge badge-info">{{ $pedido->items ? $pedido->items->count() : 0 }} items</span>
                        </td>
                        <td class="texto-centro">
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.pedidos.show', $pedido->id) }}" class="btn btn-sm btn-info" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(Route::has('facturas.descargar'))
                                <a href="{{ route('facturas.descargar', $pedido->id) }}" class="btn btn-sm btn-success" title="Descargar factura">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                                @endif
                                @if(($pedido->estado ?? 'pendiente') !== 'cancelado')
                                <form action="{{ route('admin.pedidos.update', $pedido->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="estado" value="cancelado">
                                    <button type="submit" class="btn btn-sm btn-danger" title="Cancelar pedido" 
                                            onclick="return confirm('¿Estás seguro de cancelar este pedido?')">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="texto-centro">
                            <div style="padding: 2rem;">
                                <i class="fas fa-inbox" style="font-size: 3rem; color: #dee2e6; margin-bottom: 1rem;"></i>
                                <p class="text-muted">No se encontraron pedidos que coincidan con los filtros aplicados.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($pedidos->hasPages())
    <div class="tarjeta-pie">
        <div class="paginacion-info">
            <div>
                Mostrando {{ $pedidos->firstItem() ?? 0 }} - {{ $pedidos->lastItem() ?? 0 }} 
                de {{ $pedidos->total() }} pedidos
            </div>
            <div>{{ $pedidos->links('custom.pagination') }}</div>
        </div>
    </div>
    @endif
</div>
@endsection