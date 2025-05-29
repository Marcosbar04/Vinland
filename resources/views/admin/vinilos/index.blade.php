@extends('layouts.admin')

@section('title', 'Gestión de Vinilos')

@section('content')
<style>
    * {
        box-sizing: border-box;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .page-header h1 {
        margin: 0;
        font-size: 2rem;
        color: #212529;
        font-weight: 500;
    }

    .card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: 1px solid #dee2e6;
        margin-bottom: 1.5rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-body.no-padding {
        padding: 0;
    }

    .card-footer {
        padding: 1rem 1.5rem;
        background-color: rgba(0, 0, 0, 0.03);
        border-top: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 0 0 8px 8px;
    }

    .search-form {
        display: flex;
        gap: 1rem;
        align-items: end;
    }

    .search-input-container {
        flex: 1;
    }

    .search-button-container {
        flex-shrink: 0;
        min-width: 120px;
    }

    .input-group {
        display: flex;
        position: relative;
        width: 100%;
    }

    .input-group-text {
        display: flex;
        align-items: center;
        padding: 0.5rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        text-align: center;
        white-space: nowrap;
        background-color: #e9ecef;
        border: 1px solid #ced4da;
        border-radius: 0.375rem 0 0 0.375rem;
        border-right: 0;
    }

    .form-control {
        display: block;
        width: 100%;
        padding: 0.5rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ced4da;
        border-radius: 0 0.375rem 0.375rem 0;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus {
        color: #212529;
        background-color: #fff;
        border-color: #86b7fe;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
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
        text-align: left;
    }

    .table thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        color: #495057;
    }

    .table tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.075);
    }

    .vinyl-image {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 0.375rem;
        border: 1px solid #dee2e6;
    }

    .btn-group {
        display: inline-flex;
        vertical-align: middle;
        border-radius: 0.375rem;
        overflow: hidden;
    }

    .btn-group .btn,
    .btn-group form .btn {
        border-radius: 0;
        border-right: 0;
        margin: 0;
        display: inline-block;
    }

    .btn-group .btn:first-child,
    .btn-group form:first-child .btn {
        border-top-left-radius: 0.375rem;
        border-bottom-left-radius: 0.375rem;
    }

    .btn-group .btn:last-child,
    .btn-group form:last-child .btn {
        border-top-right-radius: 0.375rem;
        border-bottom-right-radius: 0.375rem;
        border-right: 1px solid;
    }

    .btn-group .btn:not(:first-child):not(:last-child),
    .btn-group form:not(:first-child):not(:last-child) .btn {
        border-radius: 0;
    }

    .btn-group form {
        display: inline-flex;
        margin: 0;
        align-items: stretch;
    }

    /* Asegurar que todos los botones tengan la misma altura */
    .btn-group .btn,
    .btn-group form .btn {
        min-height: 31px; /* Altura mínima para btn-sm */
        align-items: center;
        display: inline-flex;
        justify-content: center;
    }    .pagination-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .pagination-text {
        color: #6c757d;
        font-size: 0.875rem;
    }

    .btn {
        display: inline-block;
        padding: 0.5rem 1rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        text-align: center;
        text-decoration: none;
        vertical-align: middle;
        cursor: pointer;
        border: 1px solid transparent;
        border-radius: 0.375rem;
        transition: all 0.15s ease-in-out;
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
        background-color: #0b5ed7;
        border-color: #0a58ca;
        color: #fff;
        text-decoration: none;
    }

    .btn-info {
        color: #000;
        background-color: #0dcaf0;
        border-color: #0dcaf0;
    }

    .btn-info:hover {
        background-color: #31d2f2;
        border-color: #25cff2;
        color: #000;
        text-decoration: none;
    }

    .btn-warning {
        color: #000;
        background-color: #ffc107;
        border-color: #ffc107;
    }

    .btn-warning:hover {
        background-color: #ffca2c;
        border-color: #ffc720;
        color: #000;
        text-decoration: none;
    }

    .btn-danger {
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
        color: #fff;
        text-decoration: none;
    }

    .w-100 {
        width: 100% !important;
    }

    .fas {
        margin-right: 0.5rem;
    }

    .btn .fas {
        margin-right: 0.25rem;
    }

    .btn-sm .fas {
        margin-right: 0;
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

        .search-form {
            flex-direction: column;
            gap: 1rem;
        }

        .search-input-container,
        .search-button-container {
            flex: none;
            width: 100%;
        }

        .table-responsive {
            font-size: 0.875rem;
        }

        .table th,
        .table td {
            padding: 0.5rem 0.25rem;
        }

        .btn-group {
            display: flex;
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

        .pagination-info {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .vinyl-image {
            width: 40px;
            height: 40px;
        }
    }

    @media (max-width: 480px) {
        .card-body {
            padding: 1rem;
        }

        .table th:nth-child(1),
        .table td:nth-child(1) {
            display: none;
        }

        .table th:nth-child(2),
        .table td:nth-child(2) {
            display: none;
        }

        .page-header h1 {
            font-size: 1.25rem;
        }

        .vinyl-image {
            width: 35px;
            height: 35px;
        }
    }
</style>

<div class="page-header">
    <h1><i class="fas fa-compact-disc"></i> Gestión de Vinilos</h1>
    <a href="{{ route('vinilos.create') }}" class="btn btn-primary">
        <i class="fas fa-plus-circle"></i> Nuevo Vinilo
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.vinilos.index') }}" method="GET" class="search-form">
            <div class="search-input-container">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" name="busqueda" placeholder="Buscar por título o artista..." value="{{ $busqueda ?? '' }}">
                </div>
            </div>
            <div class="search-button-container">
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body no-padding">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Título</th>
                        <th scope="col">Artista</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Creado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vinilos as $vinilo)
                    <tr>
                        <td>{{ $vinilo->id }}</td>
                        <td>
                            <img src="{{ asset($vinilo->imagen ? 'storage/'.$vinilo->imagen : 'img/no-cover.jpg') }}" 
                                 alt="{{ $vinilo->titulo }}" class="vinyl-image">
                        </td>
                        <td>{{ $vinilo->titulo }}</td>
                        <td>{{ $vinilo->artista }}</td>
                        <td>{{ number_format($vinilo->precio_unitario, 2) }} €</td>
                        <td>{{ $vinilo->fecha_creacion->format('d/m/Y') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('vinilos.show', $vinilo->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('vinilos.edit', $vinilo->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('vinilos.destroy', $vinilo->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este vinilo?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="pagination-info">
            <div class="pagination-text">Mostrando {{ $vinilos->firstItem() ?? 0 }} - {{ $vinilos->lastItem() ?? 0 }} de {{ $vinilos->total() }} vinilos</div>
            <div>{{ $vinilos->links('custom.pagination') }}</div>
        </div>
    </div>
</div>
@endsection
