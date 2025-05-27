@extends('layouts.app')

@section('content')
<style>
    * {
        box-sizing: border-box;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .py-4 {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }

    .mb-4 {
        margin-bottom: 1.5rem;
    }

    .mb-3 {
        margin-bottom: 1rem;
    }

    .mb-0 {
        margin-bottom: 0;
    }

    .me-2 {
        margin-right: 0.5rem;
    }

    .me-3 {
        margin-right: 1rem;
    }

    .pb-2 {
        padding-bottom: 0.5rem;
    }

    h1 {
        font-size: 2rem;
        font-weight: 500;
        color: #212529;
        margin: 0 0 1.5rem 0;
    }

    h5 {
        font-size: 1.25rem;
        font-weight: 500;
        color: #212529;
        margin: 0;
    }

    h6 {
        font-size: 1rem;
        font-weight: 500;
        color: #212529;
        margin: 0;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -0.75rem;
    }

    .col-md-6 {
        flex: 0 0 auto;
        width: 50%;
        padding: 0 0.75rem;
    }

    .card {
        background: #fff;
        border-radius: 0.375rem;
        border: 1px solid rgba(0, 0, 0, 0.125);
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        margin-bottom: 1.5rem;
    }

    .shadow {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 0.375rem 0.375rem 0 0;
    }

    .card-body {
        flex: 1 1 auto;
        padding: 1.25rem;
    }

    .card-body.p-0 {
        padding: 0;
    }

    .card-footer {
        padding: 0.75rem 1.25rem;
        background-color: #fff;
        border-top: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 0 0 0.375rem 0.375rem;
    }

    .alert {
        position: relative;
        padding: 0.75rem 1.25rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: 0.375rem;
    }

    .alert-success {
        color: #0f5132;
        background-color: #d1e7dd;
        border-color: #badbcc;
    }

    .alert-danger {
        color: #842029;
        background-color: #f8d7da;
        border-color: #f5c2c7;
    }

    .alert-info {
        color: #055160;
        background-color: #d1ecf1;
        border-color: #bee5eb;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        margin-bottom: 0;
        color: #212529;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: middle;
        border-bottom: 1px solid #dee2e6;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        color: #495057;
    }

    .text-center {
        text-align: center;
    }

    .text-end {
        text-align: right;
    }

    .text-muted {
        color: #6c757d;
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
        border-radius: 0.375rem;
        text-transform: capitalize;
    }

    .bg-warning {
        background-color: #ffc107 !important;
        color: #000 !important;
    }

    .bg-success {
        background-color: #198754 !important;
    }

    .bg-danger {
        background-color: #dc3545 !important;
    }

    .bg-secondary {
        background-color: #6c757d !important;
    }

    .btn-group {
        position: relative;
        display: inline-flex;
        vertical-align: middle;
    }

    .btn-group .btn {
        position: relative;
        flex: 1 1 auto;
        border-radius: 0;
        border-right: 0;
    }

    .btn-group .btn:first-child {
        border-top-left-radius: 0.375rem;
        border-bottom-left-radius: 0.375rem;
    }

    .btn-group .btn:last-child {
        border-top-right-radius: 0.375rem;
        border-bottom-right-radius: 0.375rem;
        border-right: 1px solid;
    }

    .btn {
        display: inline-block;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        text-align: center;
        text-decoration: none;
        vertical-align: middle;
        cursor: pointer;
        border: 1px solid transparent;
        border-radius: 0.375rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        border-radius: 0.25rem;
    }

    .btn-primary {
        color: #fff;
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .btn-primary:hover {
        color: #fff;
        background-color: #0b5ed7;
        border-color: #0a58ca;
        text-decoration: none;
    }

    .btn-success {
        color: #fff;
        background-color: #198754;
        border-color: #198754;
    }

    .btn-success:hover {
        color: #fff;
        background-color: #146c43;
        border-color: #135e39;
        text-decoration: none;
    }

    .btn-secondary {
        color: #fff;
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        color: #fff;
        background-color: #5c636a;
        border-color: #565e64;
        text-decoration: none;
    }

    .btn-outline-primary {
        color: #0d6efd;
        border-color: #0d6efd;
        background-color: transparent;
    }

    .btn-outline-primary:hover {
        color: #fff;
        background-color: #0d6efd;
        border-color: #0d6efd;
        text-decoration: none;
    }

    .btn-danger {
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        color: #fff;
        background-color: #c82333;
        border-color: #bd2130;
        text-decoration: none;
    }

    .d-flex {
        display: flex;
    }

    .justify-content-between {
        justify-content: space-between;
    }

    .align-items-center {
        align-items: center;
    }

    .d-inline {
        display: inline;
    }

    .border-bottom {
        border-bottom: 1px solid #dee2e6;
    }

    .rounded {
        border-radius: 0.375rem;
    }

    /* Modal styles */
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1055;
        display: none;
        width: 100%;
        height: 100%;
        overflow-x: hidden;
        overflow-y: auto;
        outline: 0;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal.show {
        display: block;
    }

    .modal-dialog {
        position: relative;
        width: auto;
        margin: 0.5rem;
        pointer-events: none;
    }

    .modal-lg {
        max-width: 800px;
    }

    .modal-content {
        position: relative;
        display: flex;
        flex-direction: column;
        width: 100%;
        pointer-events: auto;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 0.375rem;
        outline: 0;
        margin: 1.75rem auto;
        max-width: 500px;
    }

    .modal-lg .modal-content {
        max-width: 800px;
    }

    .modal-header {
        display: flex;
        flex-shrink: 0;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1rem;
        border-bottom: 1px solid #dee2e6;
        border-top-left-radius: calc(0.375rem - 1px);
        border-top-right-radius: calc(0.375rem - 1px);
    }

    .modal-title {
        margin-bottom: 0;
        line-height: 1.5;
    }

    .btn-close {
        box-sizing: content-box;
        width: 1em;
        height: 1em;
        padding: 0.25em 0.25em;
        color: #000;
        background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;
        border: 0;
        border-radius: 0.375rem;
        opacity: 0.5;
        cursor: pointer;
    }

    .btn-close:hover {
        opacity: 0.75;
    }

    .modal-body {
        position: relative;
        flex: 1 1 auto;
        padding: 1rem;
    }

    .modal-footer {
        display: flex;
        flex-wrap: wrap;
        flex-shrink: 0;
        align-items: center;
        justify-content: flex-end;
        padding: 0.75rem;
        border-top: 1px solid #dee2e6;
        border-bottom-right-radius: calc(0.375rem - 1px);
        border-bottom-left-radius: calc(0.375rem - 1px);
        gap: 0.5rem;
    }

    .fas {
        margin-right: 0.25rem;
    }

    small {
        font-size: 0.875em;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .col-md-6 {
            width: 100%;
        }

        .text-md-end {
            text-align: left;
        }

        .table-responsive {
            font-size: 0.875rem;
        }

        .table th,
        .table td {
            padding: 0.5rem 0.25rem;
        }

        .btn-group {
            flex-direction: column;
            width: 100px;
        }

        .btn-group .btn {
            border-radius: 0.25rem !important;
            border-right: 1px solid !important;
            margin-bottom: 2px;
        }

        .btn-group .btn:last-child {
            margin-bottom: 0;
        }

        .modal-dialog {
            margin: 0.25rem;
        }

        .modal-content {
            margin: 0.5rem auto;
        }

        h1 {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .container {
            padding: 0 0.5rem;
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .card-body {
            padding: 1rem;
        }

        .card-header {
            padding: 0.5rem 1rem;
        }

        .card-footer {
            padding: 0.5rem 1rem;
        }

        h1 {
            font-size: 1.25rem;
        }

        .table th:nth-child(3),
        .table td:nth-child(3) {
            display: none;
        }

        .modal-footer {
            flex-direction: column;
        }

        .modal-footer .btn {
            width: 100%;
        }
    }
</style>

<div class="container py-4">
    <h1 class="mb-4"><i class="fas fa-shopping-bag"></i> Mis Pedidos</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(count($pedidos) > 0)
        <div class="card shadow mb-4">
            <div class="card-header">
                <h5 class="mb-0">Historial de pedidos</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Pedido #</th>
                                <th>Fecha</th>
                                <th>Productos</th>
                                <th>Estado</th>
                                <th class="text-end">Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedidos as $pedido)
                            <tr>
                                <td>{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $pedido->fecha_creacion->format('d/m/Y H:i') }}</td>
                                <td>{{ $pedido->items->count() }} item(s)</td>
                                <td>
                                    @if($pedido->estado == 'pendiente')
                                    <span class="badge bg-warning">Pendiente</span>
                                    @elseif($pedido->estado == 'pagado')
                                    <span class="badge bg-success">Pagado</span>
                                    @elseif($pedido->estado == 'cancelado')
                                    <span class="badge bg-danger">Cancelado</span>
                                    @else
                                    <span class="badge bg-secondary">{{ ucfirst($pedido->estado) }}</span>
                                    @endif
                                </td>
                                <td class="text-end">{{ number_format($pedido->precio_total, 2) }} €</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary" onclick="openModal('pedidoModal{{ $pedido->id }}')">
                                            <i class="fas fa-eye"></i> Ver
                                        </button>
                                        @if($pedido->estado == 'pagado')
                                        <a href="{{ route('facturas.descargar', $pedido->id) }}" class="btn btn-sm btn-success">
                                            <i class="fas fa-file-invoice"></i> Factura
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('vinilos.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Volver a la tienda
                    </a>
                    <div>{{ $pedidos->links() }}</div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info">
            <p class="mb-0">No tienes pedidos todavía. <a href="{{ route('vinilos.index') }}">¡Empieza a comprar ahora!</a></p>
        </div>
    @endif
</div>

@foreach($pedidos as $pedido)
<div class="modal" id="pedidoModal{{ $pedido->id }}" tabindex="-1" aria-labelledby="pedidoModalLabel{{ $pedido->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pedidoModalLabel{{ $pedido->id }}">Detalles del Pedido #{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}</h5>
                <button type="button" class="btn-close" onclick="closeModal('pedidoModal{{ $pedido->id }}')" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Fecha:</strong> {{ $pedido->fecha_creacion->format('d/m/Y H:i') }}</p>
                        <p><strong>Estado:</strong> 
                            @if($pedido->estado == 'pendiente')
                                <span class="badge bg-warning">Pendiente</span>
                            @elseif($pedido->estado == 'pagado')
                                <span class="badge bg-success">Pagado</span>
                            @elseif($pedido->estado == 'cancelado')
                                <span class="badge bg-danger">Cancelado</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($pedido->estado) }}</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p><strong>Subtotal:</strong> {{ number_format($pedido->precio_total, 2) }} €</p>
                        <p><strong>Gastos de envío:</strong> 5.00 €</p>
                        <p><strong>Total:</strong> {{ number_format($pedido->precio_total + 5, 2) }} €</p>
                    </div>
                </div>
                
                <h6 class="border-bottom pb-2 mb-3">Productos</h6>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th class="text-center">Precio</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedido->items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/'.$item->vinilo->imagen) }}" width="50" height="50" class="rounded me-3" alt="{{ $item->vinilo->titulo }}">
                                            <div>
                                                <h6 class="mb-0">{{ $item->vinilo->titulo }}</h6>
                                                <small class="text-muted">{{ $item->vinilo->artista }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ number_format($item->precio_unitario, 2) }} €</td>
                                    <td class="text-center">{{ $item->cantidad }}</td>
                                    <td class="text-end">{{ number_format($item->cantidad * $item->precio_unitario, 2) }} €</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('pedidoModal{{ $pedido->id }}')">Cerrar</button>
                
                @if($pedido->estado == 'pendiente')
                <div class="btn-group">
                    <form action="{{ route('pedidos.cancelar', $pedido->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger me-2" onclick="return confirm('¿Estás seguro de cancelar este pedido?')">
                            <i class="fas fa-times"></i> Cancelar Pedido
                        </button>
                    </form>
                    
                    <a href="{{ route('facturas.descargar', $pedido->id) }}" class="btn btn-success">
                        <i class="fas fa-file-invoice"></i> Descargar Factura
                    </a>
                </div>
                @elseif($pedido->estado == 'pagado')
                <a href="{{ route('facturas.descargar', $pedido->id) }}" class="btn btn-success">
                    <i class="fas fa-file-invoice"></i> Descargar Factura
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
function openModal(modalId) {
    document.getElementById(modalId).classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.remove('show');
    document.body.style.overflow = 'auto';
}

// Cerrar modal al hacer click fuera
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.classList.remove('show');
        document.body.style.overflow = 'auto';
    }
});
</script>
@endsection