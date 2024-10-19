@extends('layouts.app')

@section('title', 'Editar Beneficiario')

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
        <h1 class="text-center mb-4">Editar Beneficiario</h1>

        <!-- Relleno blanco en el fondo del formulario -->
        <div class="p-4 bg-light w-50" style="border-radius: 0; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
            <form action="{{ route('beneficiarios.update', $beneficiario->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Campos más cortos -->
                <div class="mb-3">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="nombres" name="nombres"
                        value="{{ $beneficiario->nombres }}" required>
                </div>

                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos"
                        value="{{ $beneficiario->apellidos }}" required>
                </div>

                <div class="mb-3">
                    <label for="tipo_identificacion" class="form-label">Tipo de Identificación</label>
                    <select class="form-control" id="tipo_identificacion" name="tipo_identificacion" required>
                        <option value="TI" {{ $beneficiario->tipo_identificacion == 'TI' ? 'selected' : '' }}>Tarjeta de
                            Identidad (TI)</option>
                        <option value="RC" {{ $beneficiario->tipo_identificacion == 'RC' ? 'selected' : '' }}>Registro Civil
                            (RC)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="identificacion" class="form-label">Identificación</label>
                    <input type="text" class="form-control" id="identificacion" name="identificacion"
                        value="{{ $beneficiario->identificacion }}" required>
                </div>

                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion"
                        value="{{ $beneficiario->direccion }}" required>
                </div>

                <div class="mb-3">
                    <label for="parentesco" class="form-label">Parentesco</label>
                    <input type="text" class="form-control" id="parentesco" name="parentesco"
                        value="{{ $beneficiario->parentesco }}" required>
                </div>

                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                        value="{{ $beneficiario->fecha_nacimiento }}" required>
                </div>

                <div class="mb-3">
                    <label for="aportante_id" class="form-label">Aportante</label>
                    <select class="form-control" id="aportante_id" name="aportante_id" required>
                        <option value="">Selecciona un Aportante</option>
                        @foreach ($aportantes as $aportante)
                            <option value="{{ $aportante->id }}"
                                {{ $beneficiario->aportante_id == $aportante->id ? 'selected' : '' }}>
                                {{ $aportante->nombres }} {{ $aportante->apellidos }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Botón de guardar centrado fuera del recuadro -->
                <div class="mt-3">
                    <button type="submit" class="btn btn-custom px-5">Guardar cambios</button>
                </div>
            </form>
        </div>

    </div>
@endsection
