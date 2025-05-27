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

    .py-5 {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -0.75rem;
    }

    .justify-content-center {
        justify-content: center;
    }

    .col-md-8 {
        flex: 0 0 auto;
        width: 66.666667%;
        padding: 0 0.75rem;
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
    }

    .shadow-lg {
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175);
    }

    .card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 0.375rem 0.375rem 0 0;
    }

    .bg-primary {
        background-color: #0d6efd !important;
    }

    .text-white {
        color: #fff !important;
    }

    .card-header h4 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 500;
        color: inherit;
    }

    .mb-0 {
        margin-bottom: 0;
    }

    .me-2 {
        margin-right: 0.5rem;
    }

    .card-body {
        flex: 1 1 auto;
        padding: 1.25rem;
    }

    .p-4 {
        padding: 1.5rem !important;
    }

    .mb-3 {
        margin-bottom: 1rem;
    }

    .mt-3 {
        margin-top: 1rem;
    }

    .mt-4 {
        margin-top: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 400;
        color: #212529;
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
    }

    .form-control:focus {
        color: #212529;
        background-color: #fff;
        border-color: #86b7fe;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
        padding-right: calc(1.5em + 0.75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='m5.8 3.6.7.7 1.1-1.1M9 8L6 5l-3 3'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }

    .form-control.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
    }

    .form-control-file {
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
    }

    .form-control-file:focus {
        color: #212529;
        background-color: #fff;
        border-color: #86b7fe;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
    }

    .form-text {
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #6c757d;
    }

    .d-grid {
        display: grid;
    }

    .gap-2 {
        gap: 0.5rem;
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

    .btn-primary:focus {
        color: #fff;
        background-color: #0b5ed7;
        border-color: #0a58ca;
        box-shadow: 0 0 0 0.25rem rgba(49, 132, 253, 0.5);
    }

    .py-2 {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }

    .text-center {
        text-align: center;
    }

    .text-primary {
        color: #0d6efd !important;
    }

    .text-primary:hover {
        color: #0a58ca !important;
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .col-md-8 {
            width: 100%;
        }

        .col-md-6 {
            width: 100%;
        }

        .row.mb-3 .col-md-6:first-child {
            margin-bottom: 1rem;
        }
    }

    @media (max-width: 576px) {
        .container {
            padding: 0 0.5rem;
        }

        .py-5 {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        .card-header {
            padding: 0.5rem 1rem;
        }

        .card-header h4 {
            font-size: 1.25rem;
        }

        .card-body {
            padding: 1rem;
        }

        .p-4 {
            padding: 1rem !important;
        }
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-user-plus me-2"></i> Crear Cuenta</h4>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input id="nombre" type="text" 
                                       class="form-control @error('nombre') is-invalid @enderror" 
                                       name="nombre" value="{{ old('nombre') }}" 
                                       required autocomplete="given-name" autofocus>
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input id="apellido" type="text" 
                                       class="form-control @error('apellido') is-invalid @enderror" 
                                       name="apellido" value="{{ old('apellido') }}" 
                                       required autocomplete="family-name">
                                @error('apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Nombre de Usuario</label>
                            <input id="username" type="text" 
                                   class="form-control @error('username') is-invalid @enderror" 
                                   name="username" value="{{ old('username') }}" 
                                   required autocomplete="username">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input id="email" type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" 
                                   required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Contraseña</label>
                                <input id="password" type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password-confirm" class="form-label">Confirmar Contraseña</label>
                                <input id="password-confirm" type="password" 
                                       class="form-control" 
                                       name="password_confirmation" required 
                                       autocomplete="new-password">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="profile_image" class="form-label">Foto de Perfil (Opcional)</label>
                            <input type="file" class="form-control-file" id="foto_perfil" name="foto_perfil">
                            @error('profile_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-text">Formatos aceptados: JPEG, PNG, JPG, GIF (Max. 2MB)</div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary py-2">
                                <i class="fas fa-user-plus me-2"></i> Registrarse
                            </button>
                            
                            <div class="text-center mt-3">
                                <p class="mb-0">¿Ya tienes una cuenta? 
                                    <a href="{{ route('login') }}" class="text-primary">Inicia Sesión</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection