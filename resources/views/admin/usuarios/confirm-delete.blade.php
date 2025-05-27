@extends('layouts.admin')

@section('title', 'Confirmar Eliminación de Usuario')

@section('content')
<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .card-header {
        background-color: #dc3545;
        color: white;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }

    .card-header h5 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 500;
    }

    .card-body {
        padding: 1.5rem;
    }

    .alert {
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-warning {
        color: #856404;
        background-color: #fff3cd;
        border-color: #ffeaa7;
    }

    .user-info-card {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        margin-bottom: 1.5rem;
    }

    .user-info-card .card-body {
        padding: 1.5rem;
    }

    .user-display {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .profile-image {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
    }

    .user-details h5 {
        margin: 0 0 0.25rem 0;
        font-size: 1.25rem;
        color: #212529;
    }

    .user-email {
        margin: 0 0 0.5rem 0;
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

    .badge.bg-danger {
        background-color: #dc3545;
    }

    .badge.bg-info {
        background-color: #0dcaf0;
    }

    .consequences-list {
        margin: 1rem 0;
        padding-left: 1.5rem;
    }

    .consequences-list li {
        margin-bottom: 0.5rem;
        color: #495057;
    }

    .button-group {
        display: flex;
        justify-content: flex-end;
        gap: 0.5rem;
        margin-top: 2rem;
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

    .btn-secondary {
        color: #fff;
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5c636a;
        border-color: #565e64;
        color: #fff;
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
    }

    .fas {
        margin-right: 0.5rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 1rem 0.5rem;
        }
        
        .button-group {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            margin-bottom: 0.5rem;
        }
        
        .user-display {
            flex-direction: column;
            text-align: center;
            gap: 0.5rem;
        }
    }
</style>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h5><i class="fas fa-exclamation-triangle"></i> Confirmar Eliminación</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-circle"></i> ¡Atención! Esta acción no se puede deshacer.
            </div>
            
            <p>¿Estás seguro de que deseas eliminar el siguiente usuario?</p>
            
            <div class="user-info-card">
                <div class="card-body">
                    <div class="user-display">
                        <img src="{{ asset($usuario->profile_image ? 'storage/' . $usuario->profile_image : 'img/default-profile.png') }}"
                             alt="{{ $usuario->nombre_completo }}" class="profile-image">
                        <div class="user-details">
                            <h5>{{ $usuario->nombre_completo }}</h5>
                            <p class="user-email">{{ $usuario->email }}</p>
                            <span class="badge {{ $usuario->rol === 'admin' ? 'bg-danger' : 'bg-info' }}">
                                {{ ucfirst($usuario->rol) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <p>Esta acción eliminará permanentemente:</p>
            <ul class="consequences-list">
                <li>Todos los datos personales del usuario</li>
                <li>Su actividad en la plataforma</li>
                <li>Sus favoritos</li>
                <li>Su historial de pedidos (se conservan los registros por motivos contables)</li>
            </ul>
            
            <div class="button-group">
                <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
                
                <form action="{{ route('admin.usuarios.destroy', $usuario->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i> Eliminar Usuario
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection