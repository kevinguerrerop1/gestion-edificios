<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans;
            text-align: center;
        }
        img {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h2>QR Edificio</h2>

    <p><strong>{{ $edificio->nombre }}</strong></p>

    <img src="data:image/png;base64,{{ $qr }}" width="250">

    <p>Escanee para crear una nueva solicitud</p>

</body>
</html>
