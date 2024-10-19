@extends('layouts.app')

@section('title', 'Aportantes')

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

        .pagination .page-link {
            color: #000;
            padding: 8px 16px;
            font-size: 24px;
            /* Aumenta el tamaño de las flechas */
            border: none;
            background-color: transparent;
        }

        .pagination .page-item.disabled .page-link {
            color: #ccc;
        }

        .pagination .page-link:hover {
            color: #007bff;
            /* Cambia de color al pasar el mouse */
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Lista de Aportantes</h1>

        <!-- Formulario de búsqueda -->
        <form action="{{ route('aportantes.index') }}" method="GET" class="d-flex">
            <div class="input-group" style="width: 300px;">
                <input type="text" class="form-control" name="cedula" placeholder="Buscar aportante por cédula..."
                    aria-label="Buscar aportante" aria-describedby="button-addon2">
                <button class="btn btn-custom" type="submit" id="button-addon2">Buscar</button>
            </div>
        </form>

        <!-- Botón para abrir el modal de nuevo aportante -->
        <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#nuevoAportanteModal">
            Nuevo Aportante
        </button>
    </div>

    <!-- Tabla de aportantes -->
    <table class="table table-hover table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Cédula</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Fecha de Nacimiento</th>
                <th>Cantidad de Beneficiarios</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aportantes as $aportante)
                <tr>
                    <td>{{ $aportante->nombres }} {{ $aportante->apellidos }}</td>
                    <td>{{ $aportante->cedula }}</td>
                    <td>{{ $aportante->direccion }}</td>
                    <td>{{ $aportante->telefono }}</td>
                    <td>{{ $aportante->fecha_nacimiento }}</td>
                    <td>{{ $aportante->beneficiarios->count() }}</td>
                    <td class="d-flex">
                        <a href="{{ route('aportantes.edit', $aportante->id) }}"
                            class="btn btn-custom btn-sm me-2">Editar</a>
                        <form action="{{ route('aportantes.destroy', $aportante->id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-custom btn-sm"
                                onclick="return confirm('¿Seguro que quieres eliminar este aportante?');">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Mostrar la paginación -->
    @if ($aportantes->hasPages())
        <nav aria-label="Page navigation" class="d-flex justify-content-center">
            <ul class="pagination">
                {{-- Flecha para la página anterior --}}
                @if ($aportantes->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link" aria-hidden="true">&lsaquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $aportantes->previousPageUrl() }}" rel="prev"
                            aria-label="Previous">&lsaquo;</a>
                    </li>
                @endif

                {{-- Flecha para la siguiente página --}}
                @if ($aportantes->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $aportantes->nextPageUrl() }}" rel="next"
                            aria-label="Next">&rsaquo;</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link" aria-hidden="true">&rsaquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif


    <!-- Modal para crear un nuevo aportante -->
    <div class="modal fade" id="nuevoAportanteModal" tabindex="-1" aria-labelledby="nuevoAportanteLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nuevoAportanteLabel">Registrar Aportante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario de creación de aportante -->
                    <form action="{{ route('aportantes.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nombres" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="nombres" name="nombres" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                        </div>
                        <div class="mb-3">
                            <label for="cedula" class="form-label">Cédula</label>
                            <input type="text" class="form-control" id="cedula" name="cedula" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                                required>
                        </div>
                        <button type="submit" class="btn btn-custom">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
