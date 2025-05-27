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

    .mb-2 {
        margin-bottom: 0.5rem;
    }

    .mb-0 {
        margin-bottom: 0;
    }

    .mt-3 {
        margin-top: 1rem;
    }

    .me-3 {
        margin-right: 1rem;
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

    .col-md-8 {
        flex: 0 0 auto;
        width: 66.666667%;
        padding: 0 0.75rem;
    }

    .col-md-4 {
        flex: 0 0 auto;
        width: 33.333333%;
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

    .alert-link {
        font-weight: 700;
        color: #04414d;
        text-decoration: underline;
    }

    .alert-link:hover {
        color: #032830;
        text-decoration: underline;
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

    .text-muted {
        color: #6c757d;
    }

    .align-middle {
        vertical-align: middle;
    }

    .product-info {
        display: flex;
        align-items: center;
    }

    .product-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 0.375rem;
        margin-right: 1rem;
    }

    .input-group {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        width: 100px;
        margin: 0 auto;
    }

    .input-group-sm {
        font-size: 0.875rem;
        border-radius: 0.25rem;
    }

    .input-group .form-control {
        position: relative;
        flex: 1 1 auto;
        width: 1%;
        min-width: 0;
    }

    .form-control {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        text-align: center;
    }

    .form-control:focus {
        color: #212529;
        background-color: #fff;
        border-color: #86b7fe;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .input-group .btn {
        position: relative;
        z-index: 2;
    }

    .input-group .btn:first-child {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .input-group .btn:last-child {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .input-group .form-control:not(:first-child):not(:last-child) {
        border-radius: 0;
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

    .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
        background-color: transparent;
    }

    .btn-outline-secondary:hover {
        color: #fff;
        background-color: #6c757d;
        border-color: #6c757d;
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

    .d-inline {
        display: inline;
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

    .d-grid {
        display: grid;
    }

    .fw-bold {
        font-weight: 700;
    }

    hr {
        margin: 1rem 0;
        color: inherit;
        background-color: currentColor;
        border: 0;
        opacity: 0.25;
        height: 1px;
    }

    .fas {
        margin-right: 0.25rem;
    }

    small {
        font-size: 0.875em;
    }

    @media (max-width: 768px) {
        .col-md-8,
        .col-md-4 {
            width: 100%;
        }

        .product-info {
            flex-direction: column;
            text-align: center;
            gap: 0.5rem;
        }

        .product-image {
            margin-right: 0;
            margin-bottom: 0.5rem;
        }

        .table-responsive {
            font-size: 0.875rem;
        }

        .table th,
        .table td {
            padding: 0.5rem 0.25rem;
        }

        .input-group {
            width: 80px;
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

        .table th:nth-child(2),
        .table td:nth-child(2) {
            display: none;
        }
    }
</style>

<div class="container py-4">
    <h1 class="mb-4"><i class="fas fa-shopping-cart"></i> Mi Carrito</h1>
    
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
    
    @if($pedido && $pedido->items->count() > 0)
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Productos en el carrito ({{ $pedido->items->count() }})</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Vinilo</th>
                                        <th class="text-center">Precio</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Subtotal</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pedido->items as $item)
                                    <tr>
                                        <td>
                                            <div class="product-info">
                                                <img src="{{ asset($item->vinilo->imagen ? 'storage/'.$item->vinilo->imagen : 'img/no-cover.jpg') }}" 
                                                     class="product-image" 
                                                     alt="{{ $item->vinilo->titulo }}">
                                                <div>
                                                    <h6 class="mb-0">{{ $item->vinilo->titulo }}</h6>
                                                    <small class="text-muted">{{ $item->vinilo->artista }} ({{ $item->vinilo->anio }})</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">{{ number_format($item->precio_unitario, 2) }} €</td>
                                        <td class="text-center align-middle">
                                            <form action="{{ route('pedidos.actualizar', $item->id) }}" method="POST" class="d-inline quantity-form" id="form-item-{{ $item->id }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="input-group input-group-sm">
                                                    <button type="button" class="btn btn-outline-secondary quantity-decrease" data-item="{{ $item->id }}">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <input type="number" name="cantidad" value="{{ $item->cantidad }}" 
                                                           min="1" max="10" class="form-control text-center quantity-input"
                                                           id="cantidad-{{ $item->id }}" data-item="{{ $item->id }}">
                                                    <button type="button" class="btn btn-outline-secondary quantity-increase" data-item="{{ $item->id }}">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="text-center align-middle">{{ number_format($item->cantidad * $item->precio_unitario, 2) }} €</td>
                                        <td class="text-center align-middle">
                                            <form action="{{ route('pedidos.remover', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('vinilos.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left"></i> Seguir comprando
                            </a>
                            <a href="{{ route('pedidos.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-shopping-bag"></i> Mis Pedidos
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="mb-0">Resumen del Pedido</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal ({{ $pedido->items->sum('cantidad') }} artículos):</span>
                            <span>{{ number_format($pedido->precio_total, 2) }} €</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Envío:</span>
                            <span>5.00 €</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold mb-3">
                            <span>Total:</span>
                            <span>{{ number_format($pedido->precio_total + 5, 2) }} €</span>
                        </div>
                        
                        <div class="d-grid">
                            <a href="{{ route('pedidos.checkout') }}" class="btn btn-primary">
                                <i class="fas fa-credit-card"></i> Proceder al Pago
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Tu carrito está vacío. <a href="{{ route('vinilos.index') }}" class="alert-link">Explora nuestro catálogo</a> para añadir vinilos.
        </div>
        
        <div class="d-flex justify-content-between mt-3">
            <a href="{{ route('vinilos.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left"></i> Volver a la tienda
            </a>
            <a href="{{ route('pedidos.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-shopping-bag"></i> Mis Pedidos
            </a>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.quantity-decrease').forEach(function(button) {
            button.addEventListener('click', function() {
                const itemId = this.getAttribute('data-item');
                const input = document.getElementById('cantidad-' + itemId);
                const currentValue = parseInt(input.value);
                if (currentValue > 1) {
                    input.value = currentValue - 1;
                    document.getElementById('form-item-' + itemId).submit();
                }
            });
        });

        document.querySelectorAll('.quantity-increase').forEach(function(button) {
            button.addEventListener('click', function() {
                const itemId = this.getAttribute('data-item');
                const input = document.getElementById('cantidad-' + itemId);
                const currentValue = parseInt(input.value);
                if (currentValue < 10) {
                    input.value = currentValue + 1;
                    document.getElementById('form-item-' + itemId).submit();
                }
            });
        });

        document.querySelectorAll('.quantity-input').forEach(function(input) {
            input.addEventListener('change', function() {
                const itemId = this.getAttribute('data-item');
                document.getElementById('form-item-' + itemId).submit();
            });
        });
    });
</script>
@endsection