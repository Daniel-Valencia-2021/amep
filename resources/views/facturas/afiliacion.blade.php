@extends('layouts.app')

@section('content')

    <style>
        /* Estilo de botones */
        .btn-custom {
            background-color: #7D7D7D;
            color: white;
            border-color: #7D7D7D;
        }

        .btn-custom:hover {
            background-color: #6B6B6B;
            border-color: #6B6B6B;
        }

        /* Estilo de los formularios */
        .form-control {
            border-radius: 0;
            background-color: #f8f9fa;
            color: #1E1E1E;
        }

        /* Estilo de las etiquetas de los formularios */
        .form-label {
            color: #f0f0f0; /* Mayor contraste para evitar que se pierdan */
        }

        /* Caja de facturación */
        .factura-box {
            background-color: #1E1E1E;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        /* Títulos centrados */
        h1, h2, h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
        }

        /* Tabla de detalles */
        table {
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #7D7D7D;
            color: white;
        }

        td {
            background-color: #f8f9fa;
            color: white;
        }

        /* Botón de pago */
        .btn-pagar {
            display: block;
            margin: 20px auto;
        }

    </style>

    <div class="factura-box w-75 mx-auto">
        <h1>Facturación por Afiliación</h1>

        <!-- Formulario de búsqueda -->
        <form action="{{ route('factura.afiliacion.buscar') }}" method="POST" class="formulario">
            @csrf
            <div class="mb-3">
                <label for="cedula" class="form-label">Cédula del Aportante</label>
                <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ingrese la cédula del aportante" required>
            </div>

            <div class="mb-3">
                <label for="tipo_pago" class="form-label">Tipo de Pago</label>
                <select class="form-select" id="tipo_pago" name="tipo_pago" required>
                    <option value="aportante">Afiliación Aportante</option>
                    <option value="beneficiarios">Afiliación Beneficiarios</option>
                </select>
            </div>

            <button type="submit" class="btn btn-custom">Buscar Aportante</button>
        </form>

        <!-- Mensajes de error -->
        @if($errors->any())
            <div class="alert alert-danger mt-3">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Detalles del aportante y proceso de pago -->
        @if(isset($aportante))
            <hr>
            <div class="detalles-aportante">
                <h2>Detalles del Aportante</h2>
                <table class="table table-bordered">
                    <tr>
                        <th>Nombre</th>
                        <td>{{ $aportante->nombres }} {{ $aportante->apellidos }}</td>
                    </tr>
                    <tr>
                        <th>Cédula</th>
                        <td>{{ $aportante->cedula }}</td>
                    </tr>
                    <tr>
                        <th>Valor de Afiliación</th>
                        <td>${{ $valorAfiliacion }}</td>
                    </tr>
                </table>

                <!-- Tabla de beneficiarios -->
                @if(request()->tipo_pago === 'beneficiarios' && $aportante->beneficiarios->isNotEmpty())
                    <h3>Beneficiarios</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Identificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aportante->beneficiarios as $beneficiario)
                                <tr>
                                    <td>{{ $beneficiario->nombres }} {{ $beneficiario->apellidos }}</td>
                                    <td>{{ $beneficiario->identificacion }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @elseif(request()->tipo_pago === 'beneficiarios')
                    <p class="text-center text-danger">Sin beneficiarios a pagar.</p>
                @endif
            </div>

            <!-- Formulario de pago -->
            <hr>
            <form action="{{ route('factura.afiliacion.pagar') }}" method="POST">
                @csrf
                <input type="hidden" name="aportante_id" value="{{ $aportante->id }}">
                <input type="hidden" name="tipo_pago" value="{{ request()->tipo_pago }}">

                <div class="mb-3">
                    <label for="meses_pagados" class="form-label">Meses a pagar (opcional)</label>
                    <input type="number" class="form-control" id="meses_pagados" name="meses_pagados" min="0" max="{{ $mesesRestantes }}">
                </div>

                <button type="submit" class="btn btn-success btn-pagar">Pagar</button>
            </form>
        @endif
    </div>

@endsection
