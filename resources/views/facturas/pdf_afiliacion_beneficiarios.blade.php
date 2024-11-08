<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura Afiliación Beneficiarios</title>
    <style>
        /* Tamaño para ticket */
        body {
            font-family: Arial, sans-serif;
            width: 80mm;
            margin: 5px;
            color: #333;
            font-size: 11px;
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
        .details, .beneficiarios-details {
            margin-bottom: 5px;
        }
        .details p, .beneficiarios-details p {
            margin: 2px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            font-size: 10px;
        }
        th, td {
            padding: 4px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .total {
            font-size: 12px;
            font-weight: bold;
            text-align: right;
            margin-top: 5px;
        }
        .signature-section {
            display: flex;
            justify-content: space-around;
            margin-top: 10px;
            font-size: 10px;
        }
        .signature-line {
            margin-top: 10px;
            border-top: 1px solid #000;
            width: 80px;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ Vite::asset('resources/img/Logo.jpg') }}" alt="Logo Empresa">
        <h1>Asociación mutual El Paraíso</h1>
        <h2>Factura de Afiliación - Beneficiarios</h2>
        <div class="association-info">
            <p>NIT: 901.157.850 - 7</p>
            <p>Matrícula mercantil No. 29503371</p>
            <p>San Isidro, municipio de Rio Quito - Chocó</p>
        </div>
    </div>

    <p style="text-align: right;"><strong>Fecha de Pago:</strong> {{ now()->format('d/m/Y') }}</p>

    <div class="details">
        <p><strong>Nombre Aportante:</strong> {{ $aportante->nombres }} {{ $aportante->apellidos }}</p>
        <p><strong>Cédula:</strong> {{ $aportante->cedula }}</p>
    </div>

    <div class="beneficiarios-details">
        <h3>Beneficiarios</h3>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>ID</th>
                    <th>Parentesco</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($beneficiarios as $beneficiario)
                    <tr>
                        <td>{{ $beneficiario->nombres }} {{ $beneficiario->apellidos }}</td>
                        <td>{{ $beneficiario->identificacion }}</td>
                        <td>{{ $beneficiario->parentesco }}</td>
                        <td>${{ number_format($valorAfiliacion, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="total">
        <p>Total Beneficiarios: ${{ number_format($beneficiarios->count() * $valorAfiliacion, 2) }}</p>
    </div>

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
