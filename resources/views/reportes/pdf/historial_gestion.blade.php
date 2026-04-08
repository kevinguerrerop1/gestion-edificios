<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Historial de gestión</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 6px;
        }

        th {
            background: #f2f2f2;
        }
    </style>
</head>

<body>

    <h2>📜 Historial de gestión</h2>

    <p>
        <strong>Gestión:</strong> #{{ $gestion->id }}<br>
        <strong>Edificio:</strong> {{ $gestion->edificio->nombre ?? '-' }}<br>
        <strong>Estado actual:</strong> {{ ucfirst(str_replace('_', ' ', $gestion->estado)) }}
    </p>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Comentario</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visitas as $v)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($v->fecha_visita)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($v->hora_visita)->format('H:i') }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $v->estado)) }}</td>
                    <td>{{ $v->comentario ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
