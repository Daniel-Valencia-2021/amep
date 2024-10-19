<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura Afiliación Aportante</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        h1, h2 {
            text-align: center;
            color: #555;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 120px;
            height: auto;
        }
        .details, .payment-details {
            margin-bottom: 20px;
        }
        .details p, .payment-details p {
            margin: 5px 0;
        }
        .details strong, .payment-details strong {
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        .total {
            font-size: 18px;
            font-weight: bold;
            text-align: right;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="{{ Vite::asset('resources/img/Logo.jpg') }}" alt="Logo Empresa">
    </div>

    <h1>Factura de Afiliación - Aportante</h1>
    <p style="text-align: right;"><strong>Fecha de Pago:</strong> {{ now()->format('d/m/Y') }}</p>

    <div class="details">
        <h2>Detalles del Aportante</h2>
        <p><strong>Nombre:</strong> {{ $aportante->nombres }} {{ $aportante->apellidos }}</p>
        <p><strong>Cédula:</strong> {{ $aportante->cedula }}</p>
    </div>

    <div class="payment-details">
        <h2>Detalles del Pago</h2>
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
                <td><strong>Total a Pagar</strong></td>
                <td><strong>${{ number_format($total, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Gracias por su pago. Si tiene alguna pregunta, no dude en contactarnos.</p>
        <p>&copy; {{ now()->year }} Empresa. Todos los derechos reservados.</p>
    </div>
</body>
</html>
