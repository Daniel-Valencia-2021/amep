<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Desembolso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: auto;
        }
        .header, .footer {
            text-align: center;
        }
        .signature-section {
            margin-top: 50px;
        }
        .signature {
            margin-top: 50px;
            text-align: center;
        }
        .signature-line {
            margin-top: 60px;
            border-top: 1px solid #000;
        }
        .signature-label {
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Comprobante de Desembolso</h1>
        </div>

        <p><strong>Fallecido:</strong> {{ $muerto->nombre }}</p>
        <p><strong>Reclamante:</strong> {{ $desembolso->nombre_reclamante }} {{ $desembolso->apellidos_reclamante }}</p>
        <p><strong>Cédula del Reclamante:</strong> {{ $desembolso->cedula_reclamante }}</p>
        <p><strong>Teléfono del Reclamante:</strong> {{ $desembolso->telefono_reclamante }}</p>
        <p><strong>Parentesco con el Fallecido:</strong> {{ $desembolso->parentesco }}</p>
        <p><strong>Valor del Desembolso:</strong> ${{ number_format($desembolso->valor_desembolso, 2) }}</p>
        <p><strong>Fecha del Desembolso:</strong> {{ \Carbon\Carbon::parse($desembolso->fecha_desembolso)->format('d/m/Y') }}</p>

        <div class="signature-section">
            <div class="signature">
                <div class="signature-line"></div>
                <div class="signature-label">Firma de la Funeraria</div>
            </div>

            <div class="signature">
                <div class="signature-line"></div>
                <div class="signature-label">Firma del Reclamante</div>
            </div>
        </div>
    </div>
</body>
</html>
