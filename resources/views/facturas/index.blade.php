@extends('layouts.app')

@section('title', 'Facturación de Fallecidos')

@section('content')

    <style>
        /* Estilo para los botones */
        .btn-custom {
            background-color: #7D7D7D;
            color: white;
            border-color: #7D7D7D;
        }

        .btn-custom:hover {
            background-color: #6B6B6B;
            border-color: #6B6B6B;
        }

        /* Estilo para los formularios */
        .form-control {
            border-radius: 0;
            background-color: #f8f9fa;
        }

        /* Fondo claro para las tablas */
        .table {
            background-color: #f0f0f0;
        }

        /* Estilo para el título principal */
        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
            color: white;
        }

        /* Cuadro de contenido */
        .factura-box {
            color: white;
            background-color: #1E1E1E;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Botón de pagar alineado al centro */
        .btn-pagar {
            display: block;
            margin: 20px auto;
        }

        /* Estilo para el total a pagar */
        .total {
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
            font-size: 1.2em;
        }
    </style>

    <div class="factura-box w-75 mx-auto">
        <h1>Facturación de Fallecidos</h1>

        <!-- Formulario para buscar aportante -->
        <form action="{{ route('facturas.buscar') }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="cedula" class="form-label">Cédula del Aportante</label>
                <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ingrese la cédula del aportante" required>
            </div>
            <button type="submit" class="btn btn-custom">Buscar Aportante</button>
        </form>

        <!-- Mensajes de error -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Verificar si existen muertos asociados -->
        @if(isset($muertos) && $muertos->isEmpty())
            <p class="text-center">No hay muertos asociados a este aportante.</p>
        @elseif(isset($muertos))
            <h2>Muertos asociados a {{ $aportante->nombres ?? '' }} {{ $aportante->apellidos ?? '' }}</h2>

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Identificación</th>
                        <th>Tipo de Identificación</th>
                        <th>Fecha de Fallecimiento</th>
                        <th>Causa de Muerte</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($muertos as $muerto)
                        <tr>
                            <td>{{ $muerto->nombre }}</td>
                            <td>{{ $muerto->identificacion }}</td>
                            <td>{{ $muerto->tipo_identificacion }}</td>
                            <td>{{ $muerto->fecha_fallecimiento }}</td>
                            <td>{{ $muerto->causaDeMuerte->nombre ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @php
                $cantidadMuertos = $muertos->count(); // Cantidad de muertos asociados al aportante
                $total = $cantidadMuertos * $costoMuerto; // Multiplicar por el valor del muerto en la tabla costos
            @endphp

            <!-- Mostrar el total acumulado -->
            <div class="total">
                Total a pagar: ${{ number_format($total, 2) }}
            </div>

            <!-- Botón de pago -->
            <form action="{{ route('facturas.pagar') }}" method="POST">
                @csrf
                <input type="hidden" name="aportante_id" value="{{ $aportante->id }}">
                <button type="submit" class="btn btn-success btn-pagar">Pagar</button>
            </form>
        @endif
    </div>

@endsection
