@extends('layouts.app')

@section('content')

<style>
    /* Estilos para el formulario */
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
    }

    .subtitulo {
        color: #f8f9fa;
        font-size: 1.25rem;
        margin-bottom: 20px;
    }

</style>

<div class="container">
    <div class="desembolso-box w-50 mx-auto">
        <h1 class="text-center mb-4">Formulario de Desembolso</h1>

        <!-- Mostrar el nombre completo del fallecido como subtítulo -->
        <h2 class="subtitulo text-center">Fallecido: {{ $muerto->nombre }}</h2>

        <!-- Formulario de desembolso -->
        <form action="{{ route('desembolsos.guardar') }}" method="POST">
            @csrf
            <input type="hidden" name="muerto_id" value="{{ $muerto->id }}">

            <div class="mb-3">
                <label for="nombre_reclamante" class="form-label">Nombres del Reclamante</label>
                <input type="text" class="form-control" id="nombre_reclamante" name="nombre_reclamante" required>
            </div>

            <div class="mb-3">
                <label for="apellidos_reclamante" class="form-label">Apellidos del Reclamante</label>
                <input type="text" class="form-control" id="apellidos_reclamante" name="apellidos_reclamante" required>
            </div>

            <div class="mb-3">
                <label for="cedula_reclamante" class="form-label">Cédula del Reclamante</label>
                <input type="text" class="form-control" id="cedula_reclamante" name="cedula_reclamante" required>
            </div>

            <div class="mb-3">
                <label for="telefono_reclamante" class="form-label">Teléfono del Reclamante</label>
                <input type="text" class="form-control" id="telefono_reclamante" name="telefono_reclamante" required>
            </div>

            <div class="mb-3">
                <label for="parentesco" class="form-label">Parentesco con el Fallecido</label>
                <input type="text" class="form-control" id="parentesco" name="parentesco" required>
            </div>

            <div class="mb-3">
                <label for="valor_desembolso" class="form-label">Valor del Desembolso</label>
                <input type="text" class="form-control" id="valor_desembolso" value="${{ number_format($valorDesembolso, 2) }}" readonly>
            </div>

            <!-- Botón de guardar y generar PDF -->
            <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-custom px-4">Guardar y Generar PDF</button>
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
