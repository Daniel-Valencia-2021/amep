@extends('layouts.app')

@section('content')

<style>
    /* Estilo para el formulario */
    .form-label {
        color: #f0f0f0;
    }

    .form-control {
        color: #1E1E1E;
        border-radius: 5px;
    }

    .form-control::placeholder {
        color: #7D7D7D;
    }

    /* Botón personalizado */
    .btn-custom {
        background-color: #7D7D7D;
        color: white;
        border-color: #7D7D7D;
    }

    .btn-custom:hover {
        background-color: #6B6B6B;
        border-color: #6B6B6B;
    }

    /* Caja del formulario */
    .desembolso-box {
        color: white;
        background-color: #282828;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }
</style>

<div class="container">
    <div class="desembolso-box w-50 mx-auto">
        <h1 class="text-center mb-4">Desembolso de Fallecido</h1>

        <!-- Formulario para buscar al fallecido -->
        <form action="{{ route('desembolsos.buscar') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="cedula_fallecido" class="form-label">Cédula del Fallecido</label>
                <input type="text" class="form-control" id="cedula_fallecido" name="cedula_fallecido" placeholder="Ingrese la cédula del fallecido" required>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-custom">Buscar Fallecido</button>
            </div>
        </form>

        <!-- Mostrar errores si los hay -->
        @if($errors->any())
            <div class="alert alert-danger mt-4">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </div>
</div>

@endsection
