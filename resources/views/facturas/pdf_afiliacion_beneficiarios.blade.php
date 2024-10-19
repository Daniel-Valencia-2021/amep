<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura Afiliación Beneficiarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        h1, h2, h3 {
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
        .details, .beneficiarios-details {
            margin-bottom: 20px;
        }
        .details p, .beneficiarios-details p {
            margin: 5px 0;
        }
        .details strong, .beneficiarios-details strong {
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
            margin-top: 20px;
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

    <h1>Factura de Afiliación - Beneficiarios</h1>
    <p style="text-align: right;"><strong>Fecha de Pago:</strong> {{ now()->format('d/m/Y') }}</p>

    <div class="details">
        <h2>Detalles del Aportante</h2>
        <p><strong>Nombre:</strong> {{ $aportante->nombres }} {{ $aportante->apellidos }}</p>
        <p><strong>Cédula:</strong> {{ $aportante->cedula }}</p>
    </div>

    <div class="beneficiarios-details">
        <h2>Detalles de los Beneficiarios</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo de Identificación</th>
                    <th>Identificación</th>
                    <th>Parentesco</th>
                    <th>Valor Afiliación</th>
                </tr>
            </thead>
            <tbody>
                @foreach($beneficiarios as $beneficiario)
                    <tr>
                        <td>{{ $beneficiario->nombres }} {{ $beneficiario->apellidos }}</td>
                        <td>{{ $beneficiario->tipo_identificacion }}</td>
                        <td>{{ $beneficiario->identificacion }}</td>
                        <td>{{ $beneficiario->parentesco }}</td>
                        <td>${{ number_format($valorAfiliacion, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="total">
        <h3>Total a Pagar por Beneficiarios: ${{ number_format($beneficiarios->count() * $valorAfiliacion, 2) }}</h3>
        <h3>Total General: ${{ number_format($total, 2) }}</h3>
    </div>

    <div class="footer">
        <p>Gracias por su pago. Si tiene alguna pregunta, no dude en contactarnos.</p>
        <p>&copy; {{ now()->year }} Empresa. Todos los derechos reservados.</p>
    </div>

</body>
</html>
