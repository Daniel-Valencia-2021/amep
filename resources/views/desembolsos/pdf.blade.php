<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Desembolso</title>
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
        .signature-section {
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            margin-top: 10px;
            text-align: center;
        }
        .signature-box {
            text-align: center;
            padding-top: 15px;
        }
        .signature-line {
            width: 70px;
            border-top: 1px solid #000;
            margin: 2px auto;
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('img/logo.png') }}" alt="Logo Empresa">
        <h1>Asociación Mutual El Paraíso</h1>
        <h2>Comprobante de Desembolso</h2>
        <div class="association-info">
            <p>NIT: 901.157.850 - 7</p>
            <p>Matrícula mercantil No. 29503371</p>
            <p>San Isidro, municipio de Rio Quito - Chocó</p>
        </div>
        <p><strong>Fecha del Desembolso:</strong> {{ \Carbon\Carbon::parse($desembolso->fecha_desembolso)->format('d/m/Y') }}</p>
    </div>

    <div class="details">
        <p><strong>Fallecido:</strong> {{ $muerto->nombre }}</p>
        <p><strong>Reclamante:</strong> {{ $desembolso->nombre_reclamante }} {{ $desembolso->apellidos_reclamante }}</p>
        <p><strong>Cédula:</strong> {{ $desembolso->cedula_reclamante }}</p>
        <p><strong>Teléfono:</strong> {{ $desembolso->telefono_reclamante }}</p>
        <p><strong>Parentesco:</strong> {{ $desembolso->parentesco }}</p>
        <p><strong>Valor del Desembolso:</strong> ${{ number_format($desembolso->valor_desembolso, 2) }}</p>
    </div>

    <div class="signature-section">
        <div class="signature-box">
            <div class="signature-line"></div>
            <p>Firma de la Funeraria</p>
        </div>
        <div class="signature-box">
            <div class="signature-line"></div>
            <p>Firma del Reclamante</p>
        </div>
    </div>

    <div class="footer">
        <p>&copy; {{ now()->year }} Asociación Mutual El Paraíso.</p>
    </div>

</body>
</html>
