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

    .mb-4 {
        margin-bottom: 1.5rem;
    }

    .mt-4 {
        margin-top: 1.5rem;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .page-header h1 {
        margin: 0;
        font-size: 2rem;
        color: #212529;
        font-weight: 500;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -0.75rem;
    }

    .col-md-4 {
        flex: 0 0 auto;
        width: 33.333333%;
        padding: 0 0.75rem;
        margin-bottom: 1.5rem;
    }

    .card {
        background: #fff;
        border-radius: 0.375rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: 1px solid rgba(0, 0, 0, 0.125);
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        height: 100%;
    }

    .card-img-top {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 0.375rem 0.375rem 0 0;
    }

    .card-body {
        flex: 1 1 auto;
        padding: 1.25rem;
    }

    .card-title {
        margin-bottom: 0.75rem;
        font-size: 1.25rem;
        font-weight: 500;
        color: #212529;
    }

    .card-text {
        margin-bottom: 1rem;
        color: #6c757d;
        line-height: 1.6;
    }

    .card-footer {
        padding: 0.75rem 1.25rem;
        background-color: #fff;
        border-top: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 0 0 0.375rem 0.375rem;
    }

    .card-footer-buttons {
        display: flex;
        justify-content: space-between;
        gap: 0.5rem;
    }

    .alert {
        position: relative;
        padding: 0.75rem 1.25rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: 0.375rem;
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

    .btn i {
        margin-right: 0.25rem;
    }

    .d-inline {
        display: inline;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 1.5rem;
    }

    .fas, .far {
        margin-right: 0.25rem;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .col-md-4 {
            width: 50%;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }

        .page-header h1 {
            font-size: 1.5rem;
        }

        .col-md-4 {
            width: 100%;
        }

        .card-footer-buttons {
            flex-direction: column;
            gap: 0.5rem;
        }

        .btn {
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        .container {
            padding: 0 0.5rem;
        }

        .page-header h1 {
            font-size: 1.25rem;
        }

        .card-body {
            padding: 1rem;
        }

        .card-footer {
            padding: 0.75rem;
        }

        .alert {
            padding: 0.5rem 0.75rem;
        }
    }
</style>

<div class="container">
    <div class="mb-4">
        <div class="page-header">
            <h1>Mis Vinilos Favoritos</h1>
            <a href="{{ route('vinilos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver al Catálogo
            </a>
        </div>
    </div>

    @if($vinilos->isEmpty())
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Aún no has agregado ningún vinilo a tus favoritos.
            <a href="{{ route('vinilos.index') }}" class="alert-link">Explora nuestro catálogo</a> para encontrar vinilos que te gusten.
        </div>
    @else
        <div class="row">
            @foreach($vinilos as $vinilo)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('storage/'.$vinilo->imagen) }}" class="card-img-top" alt="{{ $vinilo->titulo }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $vinilo->titulo }}</h5>
                        <p class="card-text">
                            <strong>Artista:</strong> {{ $vinilo->artista }}<br>
                            <strong>Género:</strong> {{ ucfirst($vinilo->genero) }}<br>
                            <strong>Año:</strong> {{ $vinilo->anio }}<br>
                            <strong>Precio:</strong> {{ number_format($vinilo->precio_unitario, 2) }} €
                        </p>
                    </div>
                    <div class="card-footer">
                        <div class="card-footer-buttons">
                            <a href="{{ route('vinilos.show', $vinilo->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye"></i> Ver Detalles
                            </a>
                            <form action="{{ route('likes.toggle', $vinilo->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-heart-broken"></i> Quitar de favoritos
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="pagination-container">
            {{ $vinilos->links() }}
        </div>
    @endif
</div>
@endsection