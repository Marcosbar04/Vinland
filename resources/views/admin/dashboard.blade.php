@extends('layouts.admin')

@section('title', 'Panel Admin')

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

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: 1px solid #dee2e6;
        overflow: hidden;
        transition: transform 0.2s ease-in-out;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .stat-card.bg-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%) !important;
        color: white;
    }

    .stat-card.bg-success {
        background: linear-gradient(135deg, #198754 0%, #146c43 100%) !important;
        color: white;
    }

    .stat-card.bg-danger {
        background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%) !important;
        color: white;
    }

    .stat-card.bg-info {
        background: linear-gradient(135deg, #0dcaf0 0%, #31d2f2 100%) !important;
        color: white;
    }

    .stat-card-body {
        padding: 1.5rem;
    }

    .stat-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .stat-info h6 {
        margin: 0 0 0.5rem 0;
        font-size: 0.875rem;
        font-weight: 600;
        opacity: 0.9;
    }

    .stat-info h2 {
        margin: 0;
        font-size: 2rem;
        font-weight: 700;
        line-height: 1;
    }

    .stat-icon {
        opacity: 0.5;
    }

    .stat-icon i {
        font-size: 3rem;
    }

    .stat-link {
        color: white;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        transition: opacity 0.15s ease-in-out;
    }

    .stat-link:hover {
        opacity: 0.8;
        text-decoration: none;
        color: white;
    }

    .stat-link i {
        margin-left: 0.5rem;
        font-size: 0.75rem;
    }

    .card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: 1px solid #dee2e6;
        margin-bottom: 1.5rem;
    }

    .card-header {
        padding: 1rem 1.5rem;
        background-color: #fff;
        border-bottom: 1px solid #dee2e6;
        border-radius: 8px 8px 0 0;
    }

    .card-header h5 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 500;
        color: #212529;
    }

    .card-body {
        padding: 1.5rem;
    }

    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .btn {
        display: inline-block;
        padding: 0.75rem 1rem;
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
        width: 100%;
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
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(13, 110, 253, 0.3);
    }

    .btn-success {
        color: #fff;
        background-color: #198754;
        border-color: #198754;
    }

    .btn-success:hover {
        background-color: #146c43;
        border-color: #135e39;
        color: #fff;
        text-decoration: none;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(25, 135, 84, 0.3);
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
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
    }

    .fas {
        margin-right: 0.5rem;
    }

    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 1.5rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .stat-card-body {
            padding: 1rem;
        }

        .stat-info h2 {
            font-size: 1.5rem;
        }

        .stat-icon i {
            font-size: 2rem;
        }

        .actions-grid {
            grid-template-columns: 1fr;
            gap: 0.75rem;
        }

        .card-body {
            padding: 1rem;
        }
    }

    @media (max-width: 480px) {
        .page-header h1 {
            font-size: 1.25rem;
        }

        .stat-content {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .stat-icon {
            align-self: flex-end;
        }

        .stat-info h2 {
            font-size: 1.75rem;
        }

        .stat-icon i {
            font-size: 2.5rem;
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-card {
        animation: fadeInUp 0.6s ease-out;
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }
</style>

<div class="page-header">
    <h1><i class="fas fa-tachometer-alt"></i> Panel Admin</h1>
</div>

<div class="stats-grid">
    <div class="stat-card bg-primary">
        <div class="stat-card-body">
            <div class="stat-content">
                <div class="stat-info">
                    <h6>Total Vinilos</h6>
                    <h2>{{ $totalVinilos }}</h2>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-compact-disc"></i>
                </div>
            </div>
            <div>
                <a href="{{ route('admin.vinilos.index') }}" class="stat-link">
                    Ver detalles <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="stat-card bg-success">
        <div class="stat-card-body">
            <div class="stat-content">
                <div class="stat-info">
                    <h6>Total Usuarios</h6>
                    <h2>{{ $totalUsuarios }}</h2>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div>
                <a href="{{ route('admin.usuarios.index') }}" class="stat-link">
                    Ver detalles <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="stat-card bg-danger">
        <div class="stat-card-body">
            <div class="stat-content">
                <div class="stat-info">
                    <h6>Total Pedidos</h6>
                    <h2>{{ $totalPedidos }}</h2>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
            </div>
            <div>
                <a href="{{ route('admin.pedidos.index') }}" class="stat-link">
                    Ver detalles <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="stat-card bg-info">
        <div class="stat-card-body">
            <div class="stat-content">
                <div class="stat-info">
                    <h6>Ventas Totales</h6>
                    <h2>{{ number_format($ventasTotal, 2) }} €</h2>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-euro-sign"></i>
                </div>
            </div>
            <div>
                <a href="{{ route('admin.pedidos.index') }}" class="stat-link">
                    Ver detalles <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>Acciones Rápidas</h5>
    </div>
    <div class="card-body">
        <div class="actions-grid">
            <a href="{{ route('vinilos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Añadir Nuevo Vinilo
            </a>
            <a href="{{ route('admin.usuarios.index') }}" class="btn btn-success">
                <i class="fas fa-user-cog"></i> Gestionar Usuarios
            </a>
            <a href="{{ route('admin.pedidos.index') }}" class="btn btn-danger">
                <i class="fas fa-clipboard-list"></i> Ver Pedidos Recientes
            </a>
        </div>
    </div>
</div>
@endsection