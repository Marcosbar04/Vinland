@extends('layouts.admin')

@section('title', 'Detalles de Usuario')

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

    .header-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .main-row {
        display: flex;
        gap: 1.5rem;
        width: 100%;
    }

    .profile-column {
        flex: 0 0 400px;
        min-width: 300px;
    }

    .content-column {
        flex: 1;
        min-width: 0;
    }

    .card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border: 1px solid #dee2e6;
        margin-bottom: 1.5rem;
        overflow: hidden;
    }

    .card-header {
        padding: 1rem 1.5rem;
        background-color: #fff;
        border-bottom: 1px solid #dee2e6;
    }

    .card-header h5 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 500;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-body.no-padding {
        padding: 0;
    }

    .profile-image-section {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .profile-image {
        border-radius: 50%;
        max-width: 150px;
        height: auto;
        border: 3px solid #dee2e6;
    }

    .info-item {
        margin-bottom: 1rem;
        border-bottom: 1px solid #f8f9fa;
        padding-bottom: 0.75rem;
    }

    .info-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .info-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.25rem;
        display: block;
    }

    .info-label i {
        margin-right: 0.5rem;
        width: 16px;
        color: #6c757d;
    }

    .info-value {
        margin: 0;
        color: #212529;
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

    .bg-danger {
        background-color: #dc3545 !important;
    }

    .bg-info {
        background-color: #0dcaf0 !important;
    }

    .bg-warning {
        background-color: #ffc107 !important;
        color: #000 !important;
    }

    .bg-success {
        background-color: #198754 !important;
    }

    .bg-secondary {
        background-color: #6c757d !important;
    }

    .table-container {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        margin-bottom: 0;
        color: #212529;
        border-collapse: collapse;
        min-width: 600px;
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

    .empty-state {
        padding: 3rem 2rem;
        text-align: center;
        color: #6c757d;
    }

    .empty-state .icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        color: #adb5bd;
        display: block;
    }

    .empty-state p {
        margin: 0;
        font-size: 1.1rem;
    }

    .favorites-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .favorite-card {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .favorite-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

    .favorite-info {
        padding: 1rem;
        flex-grow: 1;
    }

    .favorite-title {
        margin: 0 0 0.5rem 0;
        font-size: 1rem;
        font-weight: 600;
        color: #212529;
    }

    .favorite-artist {
        margin: 0;
        color: #6c757d;
        font-size: 0.875rem;
    }

    .favorite-action {
        padding: 1rem;
        border-top: 1px solid #dee2e6;
        text-align: center;
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
    }

    .btn-warning {
        color: #000;
        background-color: #ffc107;
        border-color: #ffc107;
    }

    .btn-warning:hover {
        background-color: #ffca2c;
        border-color: #ffc720;
        text-decoration: none;
        color: #000;
    }

    .btn-secondary {
        color: #fff;
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5c636a;
        border-color: #565e64;
        text-decoration: none;
        color: #fff;
    }

    .btn-info {
        color: #000;
        background-color: #0dcaf0;
        border-color: #0dcaf0;
    }

    .btn-info:hover {
        background-color: #31d2f2;
        border-color: #25cff2;
        text-decoration: none;
        color: #000;
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

    /* Responsive */
    @media (max-width: 992px) {
        .main-row {
            flex-direction: column;
            gap: 1rem;
        }

        .profile-column {
            flex: none;
            min-width: auto;
        }

        .favorites-container {
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
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

        .header-buttons {
            width: 100%;
        }

        .header-buttons .btn {
            flex: 1;
        }

        .favorites-container {
            grid-template-columns: repeat(2, 1fr);
        }

        .table {
            font-size: 0.875rem;
            min-width: 500px;
        }

        .table th,
        .table td {
            padding: 0.5rem 0.25rem;
        }
    }

    @media (max-width: 480px) {
        .favorites-container {
            grid-template-columns: 1fr;
        }

        .header-buttons {
            flex-direction: column;
        }

        .page-header h1 {
            font-size: 1.25rem;
        }

        .card-body {
            padding: 1rem;
        }
    }
</style>

<div class="page-header">
    <h1><i class="fas fa-user"></i> Detalles de Usuario</h1>
    <div class="header-buttons">
        <a href="{{ route('admin.usuarios.edit', $usuario->id) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Editar
        </a>
        <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>
</div>

<div class="main-row">
    <div class="profile-column">
        <div class="card">
            <div class="card-header">
                <h5>Información de Perfil</h5>
            </div>
            <div class="card-body">
                <div class="profile-image-section">
                    <img src="{{ asset($usuario->profile_image ? 'storage/' . $usuario->profile_image : 'img/default-profile.png') }}" 
                         alt="{{ $usuario->nombre_completo }}" class="profile-image">
                </div>
                
                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-user"></i>Nombre completo:
                    </div>
                    <p class="info-value">{{ $usuario->nombre_completo }}</p>
                </div>
                
                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-at"></i>Username:
                    </div>
                    <p class="info-value">{{ $usuario->username }}</p>
                </div>
                
                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-envelope"></i>Email:
                    </div>
                    <p class="info-value">{{ $usuario->email }}</p>
                </div>
                
                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-tag"></i>Rol:
                    </div>
                    <p class="info-value">
                        <span class="badge {{ $usuario->rol === 'admin' ? 'bg-danger' : 'bg-info' }}">
                            {{ ucfirst($usuario->rol) }}
                        </span>
                    </p>
                </div>
                
                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-calendar"></i>Fecha de registro:
                    </div>
                    <p class="info-value">{{ $usuario->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content-column">
        <div class="card">
            <div class="card-header">
                <h5>Historial de Pedidos</h5>
            </div>
            <div class="card-body no-padding">
                @if(count($pedidos) > 0)
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedidos as $pedido)
                            <tr>
                                <td>{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $pedido->fecha_creacion->format('d/m/Y H:i') }}</td>
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
                                <td>{{ number_format($pedido->precio_total, 2) }} €</td>
                                <td>
                                    <a href="{{ route('admin.pedidos.show', $pedido->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-state">
                    <i class="fas fa-shopping-bag icon"></i>
                    <p>Este usuario aún no ha realizado ningún pedido.</p>
                </div>
                @endif
            </div>
        </div>

@endsection