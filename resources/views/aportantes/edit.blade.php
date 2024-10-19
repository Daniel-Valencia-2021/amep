@extends('layouts.app')

@section('title', 'Editar Aportante')

@section('content')

    <style>
        /* Cambiar el color de los botones */
        .btn-custom {
            background-color: #7D7D7D;
            color: white;
            border-color: #7D7D7D;
        }

        .btn-custom:hover {
            background-color: #6B6B6B;
            /* Color un poco más oscuro para el hover */
            border-color: #6B6B6B;
        }
    </style>

    <div class="d-flex flex-column align-items-center mt-5">
        <!-- Título centrado -->
        <h1 class="text-center mb-4">Editar Aportante</h1>

        <!-- Relleno blanco en el fondo del formulario -->
        <div class="p-4 bg-light w-50" style="border-radius: 0; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
            <form action="{{ route('aportantes.update', $aportante->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Campos más cortos -->
                <div class="mb-3">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="nombres" name="nombres"
                        value="{{ $aportante->nombres }}" required>
                </div>

                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos"
                        value="{{ $aportante->apellidos }}" required>
                </div>

                <div class="mb-3">
                    <label for="cedula" class="form-label">Cédula</label>
                    <input type="text" class="form-control" id="cedula" name="cedula"
                        value="{{ $aportante->cedula }}" required>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono"
                        value="{{ $aportante->telefono }}" required>
                </div>

                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion"
                        value="{{ $aportante->direccion }}" required>
                </div>

                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                        value="{{ $aportante->fecha_nacimiento }}" required>
                </div>
                <!-- Botón de guardar centrado fuera del recuadro -->
                <div class="mt-3">
                    <button type="submit" class="btn btn-custom px-5">Guardar cambios</button>
                </div>
            </form>
        </div>


    </div>
@endsection
