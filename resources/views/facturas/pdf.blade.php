<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Pago - Fallecidos</title>
    <style>
        /* Estilo optimizado para ticket POS */
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            width: 80mm;
            margin: 5px;
            color: #333;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 5px;
        }
        .header img {
            width: 60px;
            height: auto;
        }
        h1, h2 {
            font-size: 13px;
            margin: 5px 0;
        }
        .association-info p, .details p {
            font-size: 10px;
            margin: 2px 0;
            text-align: center;
        }
        .details {
            margin-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            margin-bottom: 5px;
        }
        th, td {
            padding: 3px;
            border-bottom: 1px dashed #000;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        .total {
            font-weight: bold;
            text-align: right;
            font-size: 12px;
            margin-top: 5px;
        }
        .signature-section {
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            margin-top: 10px;
        }
        .signature-box {
            text-align: center;
            padding-top: 15px;
        }
        .signature-line {
            width: 60px;
            border-top: 1px solid #000;
            margin: 2px auto;
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('img/logo.png') }}" alt="Logo Empresa">
        <h1>Asociación Mutual El Paraíso</h1>
        <h2>Comprobante de Pago - Fallecidos</h2>
        <div class="association-info">
            <p>NIT: 901.157.850 - 7</p>
            <p>Matrícula mercantil No. 29503371</p>
            <p>San Isidro, municipio de Rio Quito - Chocó</p>
        </div>
        <p><strong>Fecha de Pago:</strong> {{ $fecha_pago->format('d/m/Y') }}</p>
    </div>

    <div class="details">
        <p><strong>Nombre:</strong> {{ $aportante->nombres }} {{ $aportante->apellidos }}</p>
        <p><strong>Cédula:</strong> {{ $aportante->cedula }}</p>
        <p><strong>Teléfono:</strong> {{ $aportante->telefono }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>ID</th>
                <th>Fecha Fallecimiento</th>
                <th>Causa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($muertos as $muerto)
                <tr>
                    <td>{{ $muerto->nombre }}</td>
                    <td>{{ $muerto->identificacion }}</td>
                    <td>{{ date('d/m/Y', strtotime($muerto->fecha_fallecimiento)) }}</td>
                    <td>{{ $muerto->causaDeMuerte->nombre }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <p>Total a Pagar: ${{ number_format($total, 2) }}</p>
    </div>

    <div class="signature-section">
        <div class="signature-box">
            <div class="signature-line"></div>
            <p>Presidente</p>
        </div>
        <div class="signature-box">
            <div class="signature-line"></div>
            <p>Tesorero</p>
        </div>
        <div class="signature-box">
            <div class="signature-line"></div>
            <p>Usuario</p>
        </div>
    </div>

    <div class="footer">
        <p>Gracias por su pago.</p>
        <p>&copy; {{ now()->year }} Asociación Mutual El Paraíso.</p>
    </div>

</body>
</html>
