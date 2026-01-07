<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 40px;
            color: #333;
        }

        .card {
            max-width: 440px;
            margin: auto;
            background: #ffffff;
            border-radius: 10px;
            border: 2px solid #1f4e78;
            padding: 30px;
            text-align: center;
        }

        .logo {
            margin-bottom: 15px;
        }

        .logo img {
            max-height: 110px;
            width: auto;
        }

        h2 {
            color: #1f4e78;
            margin-bottom: 8px;
        }

        .edificio {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .ubicacion {
            font-size: 13px;
            color: #555;
            margin-bottom: 20px;
        }

        .qr-box {
            border: 3px solid #1f4e78;
            padding: 15px;
            border-radius: 8px;
            display: inline-block;
            background: #fff;
        }

        .qr-box img {
            width: 250px;
            height: auto;
        }

        .info {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        .footer {
            margin-top: 25px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="card">

        <!-- LOGO (editar ruta aquí) -->
        <div class="logo">
            <img src="{{ public_path('img/logo.png') }}" alt="Logo">
        </div>

        <h2>Acceso a Mantención</h2>

        <div class="edificio">
            {{ $edificio->nombre }}
        </div>

        <div class="ubicacion">
            {{ $edificio->direccion }}<br>
            {{ $edificio->comuna }}
        </div>

        <div class="qr-box">
            <img src="data:image/png;base64,{{ $qr }}">
        </div>

        <div class="info">
            Escanee este código QR para ingresar<br>
            una nueva solicitud de mantención.
        </div>

        <div class="footer">
            Servicios Globales RV<br>
            Gestión de edificios
        </div>

    </div>

</body>
</html>
