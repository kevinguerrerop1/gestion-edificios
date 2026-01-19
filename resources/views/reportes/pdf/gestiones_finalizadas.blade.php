<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        h1 {
            color: #1f4e78;
            margin-bottom: 5px;
        }

        .sub {
            margin-bottom: 20px;
            font-size: 11px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #1f4e78;
            color: #fff;
            padding: 8px;
            font-size: 11px;
        }

        td {
            border-bottom: 1px solid #ddd;
            padding: 6px;
        }

        .footer {
            margin-top: 25px;
            font-size: 10px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>
    <h1>Gestiones Finalizadas</h1>
    <div class="sub">
        <strong>Edificio:</strong> {{ $edificio->nombre }}<br>
        <strong>Direccion:</strong> {{ $edificio->direccion }}<br>
        <strong>Periodo:</strong>
        {{ \Carbon\Carbon::parse($desde)->format('d-m-Y') }}
        al
        {{ \Carbon\Carbon::parse($hasta)->format('d-m-Y') }}
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Departamento</th>
                <th>Contacto</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gestiones as $g)
                <tr>
                    <td>{{ $g->id }}</td>
                    <td>{{ $g->departamento }}</td>
                    <td>{{ $g->nombre_contacto }}</td>
                    <td>{{ $g->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        Reporte generado el {{ now()->format('d-m-Y H:i') }}<br>
        Servicios Globales RV
    </div>
</body>
</html>
