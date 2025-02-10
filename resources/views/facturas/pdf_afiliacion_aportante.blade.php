<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura Afiliación Aportante</title>
    <style>
        /* Estilo optimizado para impresión POS */
        body {
            font-family: Arial, sans-serif;
            width: 80mm; /* Ancho típico de impresoras POS */
            margin: 0;
            padding: 5px;
            font-size: 11px;
            color: #333;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 5px;
        }
        .header img {
            width: 50px;
            height: auto;
            margin-bottom: 5px;
        }
        h1, h2 {
            font-size: 13px;
            margin: 5px 0;
        }
        .details, .payment-details {
            margin: 5px 0;
        }
        .details p, .payment-details p {
            margin: 2px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }
        th, td {
            padding: 4px;
            border-bottom: 1px dashed #000; /* Línea punteada para separar filas */
            text-align: left;
        }
        .total {
            font-size: 12px;
            font-weight: bold;
            text-align: right;
        }
        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-size: 10px;
            text-align: center;
        }
        .signature-line {
            border-top: 1px solid #000;
            width: 50px;
            margin: 10px auto 2px auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('img/Logo.png') }}" alt="Logo Empresa" style="max-width: 80px; height: auto;">
        <h1>Asociación Mutual El Paraíso</h1>
        <div>
            <p>NIT: 901.157.850 - 7</p>
            <p>Matrícula mercantil No. 29503371</p>
            <p>San Isidro, Rio Quito - Chocó</p>
        </div>
        <h2>Factura de Afiliación</h2>
        <p><strong>Fecha:</strong> {{ now()->format('d/m/Y') }}</p>
    </div>

    <div class="details">
        <p><strong>Nombre:</strong> {{ $aportante->nombres }} {{ $aportante->apellidos }}</p>
        <p><strong>Cédula:</strong> {{ $aportante->cedula }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Concepto</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Afiliación</td>
                <td>${{ number_format($valorAfiliacion, 2) }}</td>
            </tr>
            <tr>
                <td>Meses Pagados</td>
                <td>{{ $mesesPagados }}</td>
            </tr>
            <tr>
                <td>Valor Mensual</td>
                <td>${{ number_format($valorMensual, 2) }}</td>
            </tr>
            <tr>
                <td><strong>Total</strong></td>
                <td><strong>${{ number_format($total, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="signature-section">
        <div>
            <div class="signature-line"></div>
            <p>Presidente</p>
        </div>
        <div>
            <div class="signature-line"></div>
            <p>Tesorero</p>
        </div>
        <div>
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
