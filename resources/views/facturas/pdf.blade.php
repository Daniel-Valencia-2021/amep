<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Pago - Fallecidos</title>
    <style>
        /* Formato de ticket */
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            width: 80mm;
            margin: 5px;
            color: #333;
        }
        h1, h2 {
            text-align: center;
            margin: 5px 0;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 5px;
        }
        .header img {
            width: 50px;
            height: auto;
        }
        .association-info, .details p {
            font-size: 10px;
            color: #666;
            margin: 2px 0;
            text-align: center;
        }
        .details, .total {
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
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        .total {
            font-weight: bold;
            text-align: right;
        }
        .signature-section {
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            margin-top: 10px;
        }
        .signature-box {
            text-align: center;
            padding-top: 20px;
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
        <img src="{{ Vite::asset('resources/img/Logo.jpg') }}" alt="Logo Empresa">
        <h1>Asociación mutual El Paraíso</h1>
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
                <th>Identificación</th>
                <th>Fecha de Fallecimiento</th>
                <th>Causa de Muerte</th>
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
            <p>Firma del Presidente</p>
        </div>
        <div class="signature-box">
            <div class="signature-line"></div>
            <p>Firma del Tesorero</p>
        </div>
        <div class="signature-box">
            <div class="signature-line"></div>
            <p>Firma del Usuario</p>
        </div>
    </div>

    <div class="footer">
        <p>Gracias por su pago. Si tiene alguna pregunta, no dude en contactarnos.</p>
        <p>&copy; {{ now()->year }} Asociación mutual El Paraíso. Todos los derechos reservados.</p>
    </div>

</body>
</html>
