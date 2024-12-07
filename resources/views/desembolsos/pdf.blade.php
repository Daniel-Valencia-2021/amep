<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Desembolso</title>
    <style>
        /* Configuración para formato ticket */
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
            width: 50px;
            height: auto;
        }
        h1, h2 {
            font-size: 14px;
            margin: 5px 0;
        }
        .association-info p, .details p {
            font-size: 10px;
            margin: 2px 0;
        }
        .details {
            margin-top: 5px;
            margin-bottom: 10px;
        }
        .signature-section {
            display: flex;
            justify-content: space-around;
            font-size: 10px;
            margin-top: 15px;
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
        <img src="resources\img\logo.png" alt="Logo Empresa">
        <h1>Asociación mutual El Paraíso</h1>
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
        <div>
            <p>Firma de la Funeraria</p>

            <div class="signature-line"></div>
        </div>
        <div>
            <p>Firma del Reclamante</p>

            <div class="signature-line"></div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; {{ now()->year }} Asociación mutual El Paraíso. Todos los derechos reservados.</p>
    </div>
</body>
</html>
