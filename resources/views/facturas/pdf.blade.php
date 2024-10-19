<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Pago</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1, h2, h3 {
            text-align: center;
            color: #2c3e50;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }

        .header {
            margin-top: 30px;
        }

        .details {
            margin-bottom: 20px;
        }

        .details p {
            font-size: 14px;
            line-height: 1.5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        td {
            text-align: center;
        }

        .total {
            font-weight: bold;
            text-align: right;
            margin-right: 10px;
        }

        .signature {
            margin-top: 40px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Encabezado -->
        <div class="header">
            <h1>Funeraria AMEP</h1>
            <p>Comprobante de Pago</p>
            <p>Fecha: {{ $fecha_pago->format('d/m/Y') }}</p>
        </div>

        <!-- Datos del Aportante -->
        <div class="details">
            <h3>Datos del Aportante</h3>
            <p><strong>Nombre:</strong> {{ $aportante->nombres }} {{ $aportante->apellidos }}</p>
            <p><strong>Cédula:</strong> {{ $aportante->cedula }}</p>
            <p><strong>Teléfono:</strong> {{ $aportante->telefono }}</p>
        </div>

        <!-- Detalles de los Muertos -->
        <table>
            <thead>
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
                        <td>{{ date('d/m/Y', strtotime($muerto->fecha_fallecimiento)) }}</td>
                        <td>{{ $muerto->causaDeMuerte->nombre }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total a Pagar -->
        <div class="total">
            <h3>Total a Pagar: ${{ number_format($total, 2) }}</h3>
        </div>

        <!-- Firma -->
        <div class="signature">
            <p>______________________________</p>
            <p>Firma del Responsable</p>
        </div>
    </div>
</body>
</html>
