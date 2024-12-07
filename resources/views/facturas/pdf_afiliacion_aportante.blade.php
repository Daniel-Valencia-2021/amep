<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura Afiliación Aportante</title>
    <style>
        /* Tamaño para ticket */
        body {
            font-family: Arial, sans-serif;
            width: 80mm;
            margin: 0;
            padding: 10px;
            color: #333;
            font-size: 12px;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 5px;
        }
        .header img {
            width: 50px;
            height: auto;
        }
        h1, h2 {
            font-size: 14px;
            margin: 5px 0;
        }
        .association-info p {
            margin: 2px 0;
            font-size: 10px;
        }
        .details, .payment-details {
            margin: 10px 0;
        }
        .details p, .payment-details p {
            margin: 2px 0;
        }
        .total {
            font-size: 12px;
            font-weight: bold;
            text-align: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            font-size: 10px;
        }
        th, td {
            padding: 5px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .signature-section {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
            font-size: 10px;
            text-align: center;
        }
        .signature-line {
            margin-top: 20px;
            border-top: 1px solid #000;
            width: 80px;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ Vite::asset('resources/img/logo.png') }}" alt="Logo Empresa">
        <h1>Asociación mutual El Paraíso</h1>
        <div class="association-info">
            <p>NIT: 901.157.850 - 7</p>
            <p>Matrícula mercantil No. 29503371</p>
            <p>San Isidro, municipio de Rio Quito - Chocó</p>
        </div>
        <h2>Factura de Afiliación - Aportante</h2>
        <p><strong>Fecha de Pago:</strong> {{ now()->format('d/m/Y') }}</p>
    </div>

    <div class="details">
        <p><strong>Nombre:</strong> {{ $aportante->nombres }} {{ $aportante->apellidos }}</p>
        <p><strong>Cédula:</strong> {{ $aportante->cedula }}</p>
    </div>

    <div class="payment-details">
        <p><strong>Valor de Afiliación:</strong> ${{ number_format($valorAfiliacion, 2) }}</p>
        <p><strong>Meses Pagados:</strong> {{ $mesesPagados }}</p>
        <p><strong>Valor Mensual:</strong> ${{ number_format($valorMensual, 2) }}</p>
        <p class="total"><strong>Total a Pagar:</strong> ${{ number_format($total, 2) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Detalle</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Valor Afiliación</td>
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

    <!-- Sección de firmas -->
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
        <p>Gracias por su pago. Si tiene alguna pregunta, no dude en contactarnos.</p>
        <p>&copy; {{ now()->year }} Asociación mutual El Paraíso. Todos los derechos reservados.</p>
    </div>
</body>
</html>
