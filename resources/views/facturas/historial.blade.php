@extends('layouts.app')

@section('content')

    <style>
        /* Estilo para los títulos */
        h1, h2 {
            text-align: center;
            color: #f8f9fa;
            margin-bottom: 20px;
        }

        /* Estilo para las tablas */
        .table {
            background-color: #f0f0f0;
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead {
            background-color: #282828;
            color: #f8f9fa;
        }

        .table tbody tr {
            background-color: #f8f9fa;
            color: #000;
        }

        .table tbody tr:hover {
            background-color: #ddd;
        }

        /* Estilo para las etiquetas y campos del formulario */
        .form-label {
            color: #f0f0f0;
        }

        .form-control, .form-select {
            color: #1E1E1E;
            border-radius: 5px;
        }

        .form-control::placeholder {
            color: #7D7D7D;
        }

        /* Botones personalizados */
        .btn-custom {
            background-color: #7D7D7D;
            color: white;
            border-color: #7D7D7D;
        }

        .btn-custom:hover {
            background-color: #6B6B6B;
            border-color: #6B6B6B;
        }

        /* Estilo para las listas de muertos */
        ul {
            padding-left: 20px;
            list-style-type: disc;
        }

        ul li {
            margin-bottom: 5px;
        }

        /* Caja del historial */
        .historial-box {
            background-color: #1E1E1E;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
    </style>

    <div class="historial-box w-75 mx-auto">
        <h1>Historial de Facturas</h1>

        <!-- Formulario para buscar -->
        <form action="{{ route('factura.historial.buscar') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="cedula" class="form-label">Cédula del Aportante</label>
                <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ingrese la cédula del aportante" required>
            </div>

            <div class="mb-3">
                <label for="tipo_busqueda" class="form-label">Tipo de Búsqueda</label>
                <select class="form-select" id="tipo_busqueda" name="tipo_busqueda" required>
                    <option value="vivo">Vivo</option>
                    <option value="fallecido">Fallecido</option>
                </select>
            </div>

            <button type="submit" class="btn btn-custom">Buscar</button>
        </form>

        <!-- Mostrar los resultados para aportantes vivos -->
        @if(isset($aportante) && $pagos->isNotEmpty() && request('tipo_busqueda') === 'vivo')
            <h2>Pagos de {{ $aportante->nombres }} {{ $aportante->apellidos }}</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Fallecidos Pagados</th>
                        <th>Total Pagado</th>
                        <th>Fecha de Pago</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pagos as $pago)
                        <tr>
                            <td>
                                @if(isset($pago->muertos))
                                    <ul>
                                        @foreach($pago->muertos as $muerto)
                                            <li>{{ $muerto->nombre }} - {{ $muerto->fecha_fallecimiento }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>${{ number_format($pago->total, 2) }}</td>
                            <td>{{ $pago->fecha_pago }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif(isset($aportante) && $pagos->isEmpty() && request('tipo_busqueda') === 'vivo')
            <p class="text-danger text-center">No hay pagos registrados para este aportante vivo.</p>
        @endif

        <!-- Mostrar los resultados para aportantes fallecidos -->
        @if(isset($historialPagos) && $historialPagos->isNotEmpty() && request('tipo_busqueda') === 'fallecido')
            <h2>Historial de Pagos de Fallecidos</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Fallecidos Pagados</th>
                        <th>Nombre del Aportante</th>
                        <th>Cédula del Aportante</th>
                        <th>Total Pagado</th>
                        <th>Fecha de Pago</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($historialPagos as $pago)
                        <tr>
                            <td>
                                @if(isset($pago->muertos))
                                    <ul>
                                        @foreach($pago->muertos as $muerto)
                                            <li>{{ $muerto->nombre }} - {{ $muerto->fecha_fallecimiento }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $pago->nombre_aportante }}</td>
                            <td>{{ $pago->cedula_aportante }}</td>
                            <td>${{ number_format($pago->total, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($pago->fecha_pago) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif(isset($historialPagos) && $historialPagos->isEmpty() && request('tipo_busqueda') === 'fallecido')
            <p class="text-danger text-center">No hay pagos registrados para este aportante fallecido.</p>
        @endif

        <!-- Mostrar errores -->
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </div>
@endsection
