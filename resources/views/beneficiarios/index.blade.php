@extends('layouts.app')

@section('title', 'Beneficiarios')

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

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lista de Beneficiarios</h1>

        <!-- Botón para abrir el modal de nuevo beneficiario -->
        <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#nuevoBeneficiarioModal">
            Nuevo Beneficiario
        </button>
    </div>

  <!-- Barra de búsqueda en la cabecera de la tabla -->
  <div class="search-container mb-3">
    <!-- Buscar beneficiario por cédula -->
    <form action="{{ route('beneficiarios.index') }}" method="GET" class="search-bar">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Buscar por cédula..." name="identificacion" id="buscarCedula">
            <button class="btn btn-custom" type="submit">Buscar</button>
        </div>
    </form>

    <!-- Buscar beneficiarios de un aportante -->
    <form action="{{ route('beneficiarios.index') }}" method="GET" class="search-bar">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Buscar por aportante..." name="cedula_aportante" id="buscarAportante">
            <button class="btn btn-custom" type="submit">Buscar</button>
        </div>
    </form>
</div>


    <!-- Tabla de beneficiarios -->
    <table class="table table-striped table-hover mt-4">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Identificación</th>
                <th>Fecha de Nacimiento</th>
                <th>Dirección</th>
                <th>Aportante</th>
                <th>Parentesco</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if ($beneficiarios->isEmpty())
                <tr>
                    <td colspan="8" class="text-center">No se encontraron beneficiarios</td>
                </tr>
            @else
                @foreach ($beneficiarios as $beneficiario)
                    <tr>
                        <td>{{ $beneficiario->nombres }} {{ $beneficiario->apellidos }}</td>
                        <td>{{ $beneficiario->tipo_identificacion }}: {{ $beneficiario->identificacion }}</td>
                        <td>{{ $beneficiario->fecha_nacimiento }}</td>
                        <td>{{ $beneficiario->direccion }}</td>
                        <td>{{ $beneficiario->aportante->cedula == '00000000' ? 'Sin Aportante' : $beneficiario->aportante->nombres }} {{ $beneficiario->aportante->apellidos }}</td>
                        <td>{{ $beneficiario->parentesco }}</td>
                        <td>
                            <a href="{{ route('beneficiarios.edit', $beneficiario->id) }}" class="btn btn-custom btn-sm">Editar</a>
                            <form action="{{ route('beneficiarios.destroy', $beneficiario->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-custom btn-sm" onclick="return confirm('¿Seguro que quieres eliminar este beneficiario?');">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        
    </table>

    <!-- Mostrar la paginación -->
    @if ($beneficiarios->hasPages())
        <nav aria-label="Page navigation" class="d-flex justify-content-center">
            <ul class="pagination">
                {{-- Flecha para la página anterior --}}
                @if ($beneficiarios->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link" aria-hidden="true">&lsaquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $beneficiarios->previousPageUrl() }}" rel="prev"
                            aria-label="Previous">&lsaquo;</a>
                    </li>
                @endif

                {{-- Flecha para la siguiente página --}}
                @if ($beneficiarios->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $beneficiarios->nextPageUrl() }}" rel="next"
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

    <!-- Modal para crear nuevo beneficiario -->
    <div class="modal fade" id="nuevoBeneficiarioModal" tabindex="-1" aria-labelledby="nuevoBeneficiarioLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nuevoBeneficiarioLabel">Registrar Beneficiario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('beneficiarios.store') }}" method="POST">
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
                            <label for="tipo_identificacion" class="form-label">Tipo de Identificación</label>
                            <select class="form-control" id="tipo_identificacion" name="tipo_identificacion" required>
                                <option value="TI">Tarjeta de Identidad (TI)</option>
                                <option value="RC">Registro Civil (RC)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="identificacion" class="form-label">Identificación (TI o RC)</label>
                            <input type="text" class="form-control" id="identificacion" name="identificacion" required>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                        <div class="mb-3">
                            <label for="parentesco" class="form-label">Parentesco</label>
                            <input type="text" class="form-control" id="parentesco" name="parentesco" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="aportante_id" class="form-label">Aportante</label>
                            <select class="form-control" id="aportante_id" name="aportante_id" required>
                                <option value="">Selecciona un Aportante</option>
                                @foreach ($aportantes as $aportante)
                                    <option value="{{ $aportante->id }}">{{ $aportante->nombres }}
                                        {{ $aportante->apellidos }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-custom">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
