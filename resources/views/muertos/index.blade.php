@extends('layouts.app')

@section('title', 'Reportar Fallecimiento')

@section('content')

    <style>
        .btn-custom {
            background-color: #7D7D7D;
            color: white;
            border-color: #7D7D7D;
        }

        .btn-custom:hover {
            background-color: #6B6B6B;
            border-color: #6B6B6B;
        }

        .form-control {
            background-color: white;
            color: black;
            border-color: #7D7D7D;
        }

        .form-dark {
            background-color: #1E1E1E;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            color: #f8f9fa;
        }

        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>

    <div class="d-flex flex-column align-items-center">
        <h1>Reportar Fallecimiento</h1>

        <!-- Formulario con fondo oscuro -->
        <div class="form-dark w-50">
            <form action="{{ route('muertos.reportar') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="identificacion" class="form-label">Cédula / Identificación</label>
                    <input type="text" class="form-control" id="identificacion" name="identificacion" required>
                </div>

                <div class="mb-3 d-flex align-items-center">
                    <label for="causa_muerte_id" class="form-label">Causa de Muerte</label>
                    <select class="form-control mx-3" id="causa_muerte_id" name="causa_muerte_id" required>
                        @foreach ($causasDeMuerte as $causa)
                            <option value="{{ $causa->id }}" {{ $causa->nombre == 'Muerte Natural' ? 'selected' : '' }}>
                                {{ $causa->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addCausaModal">
                        Nueva Causa
                    </button>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-custom">Reportar Fallecimiento</button>
                </div>
            </form>
        </div>

        <!-- Buscador de fallecido por cédula -->
        <div class="form-dark w-50 mt-4">
            <form action="{{ route('muertos.buscar') }}" method="GET">
                <div class="mb-3">
                    <label for="buscar_cedula" class="form-label">Buscar Fallecido por Cédula</label>
                    <input type="text" class="form-control" id="buscar_cedula" name="buscar_cedula" placeholder="Ingrese la cédula del fallecido">
                </div>
                <button type="submit" class="btn btn-custom">Buscar</button>
            </form>
        </div>
    </div>

    <hr>

    <div class="mt-5">
        <h2>Lista de Muertos Reportados</h2>

        <table class="table table-striped table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Identificación</th>
                    <th>Fecha de nacimiento</th>
                    <th>Fecha de Fallecimiento</th>
                    <th>Causa de Muerte</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($muerto))
                    <tr>
                        <td>{{ $muerto->nombre }}</td>
                        <td>{{ $muerto->tipo_identificacion }}: {{ $muerto->identificacion }}</td>
                        <td>{{ $muerto->fecha_nacimiento }}</td>
                        <td>{{ $muerto->fecha_fallecimiento }}</td>
                        <td>{{ $muerto->causaDeMuerte ? $muerto->causaDeMuerte->nombre : 'Sin Causa de Muerte' }}</td>
                    </tr>
                @else
                    @foreach ($muertos as $muerto)
                        <tr>
                            <td>{{ $muerto->nombre }}</td>
                            <td>{{ $muerto->tipo_identificacion }}: {{ $muerto->identificacion }}</td>
                            <td>{{ $muerto->fecha_nacimiento }}</td>
                            <td>{{ $muerto->fecha_fallecimiento }}</td>
                            <td>{{ $muerto->causaDeMuerte ? $muerto->causaDeMuerte->nombre : 'Sin Causa de Muerte' }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <!-- Mostrar la paginación solo si existe la variable $muertos -->
    @if(isset($muertos) && $muertos->hasPages())
        <nav aria-label="Page navigation" class="d-flex justify-content-center">
            <ul class="pagination">
                @if ($muertos->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&lsaquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $muertos->previousPageUrl() }}">&lsaquo;</a>
                    </li>
                @endif

                @if ($muertos->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $muertos->nextPageUrl() }}">&rsaquo;</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">&rsaquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif

    <!-- Modal para agregar nueva causa de muerte -->
    <div class="modal fade" id="addCausaModal" tabindex="-1" aria-labelledby="addCausaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCausaModalLabel">Nueva Causa de Muerte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('causas-de-muerte.store') }}" method="POST" id="causaForm">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de la Causa</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-custom" form="causaForm">Guardar</button>
                </div>
            </div>
        </div>
    </div>

@endsection
