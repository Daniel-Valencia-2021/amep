@extends('layouts.app')

@section('title', 'Inicio de Sesión')

@section('content')

<style>
    /* Estilos generales */
    body {
        background-color: #0A0A0A;
        color: #f8f9fa;
    }

    .login-container {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-box {
        background-color: #1E1E1E;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 400px;
    }

    .login-logo {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
    }

    .login-title {
        text-align: center;
        margin-bottom: 30px;
        font-size: 24px;
        font-weight: bold;
        color: #768010;
    }

    .form-label {
        color: #f0f0f0;
    }

    .form-control {
        background-color: #282828;
        color: #f8f9fa;
        border: none;
        border-radius: 5px;
    }

    .form-control::placeholder {
        color: #7D7D7D;
    }

    .form-control:focus {
        border-color: #768010;
        box-shadow: 0 0 0 0.2rem rgba(118, 128, 16, 0.25);
    }

    .btn.login-btn {
        background-color: #768010;
        color: white;
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: none;
    }

    .btn.login-btn:hover {
        background-color: #6B6B6B;
        color: white;
    }

    .alert-danger {
        text-align: center;
        background-color: #D9534F;
        color: white;
    }

</style>

<div class="login-container">
    <div class="login-box">
        <div class="login-logo">
            <!-- Logo de la empresa -->
            <img src="{{ Vite::asset('resources/img/Logo.jpg') }}" alt="Logo Empresa" class="avatar">
        </div>
        <h1 class="login-title">Inicio de sesión</h1>
        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first('error') }}
            </div>
        @endif
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control input-field" id="password" name="password" required>
            </div>
            <button type="submit" class="btn login-btn">Iniciar sesión</button>
        </form>
    </div>
</div>

@endsection
