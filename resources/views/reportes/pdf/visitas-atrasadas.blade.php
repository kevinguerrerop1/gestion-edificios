<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Visitas atrasadas</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #b02a37;
            color: white;
            padding: 6px;
        }

        td {
            border: 1px solid #ddd;
            padding: 6px;
        }

        .small {
            font-size: 10px;
            color: #555;
        }
    </style>
</head>

<body>

    <h2>⏰ Reporte de visitas atrasadas</h2>

    <p class="small">
        Generado el {{ now()->format('d-m-Y H:i') }} hrs
    </p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Edificio</th>
                <th>Depto</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Días atraso</th>
                <th>Contacto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visitas as $v)
                <tr>
                    <td>#{{ $v->gestion->id }}</td>
                    <td>
                        {{ $v->gestion->edificio->nombre ?? '—' }}<br>
                        <span class="small">
                            {{ $v->gestion->edificio->direccion ?? '' }}
                        </span>
                    </td>
                    <td>{{ $v->gestion->departamento }}</td>
                    <td>{{ \Carbon\Carbon::parse($v->fecha_visita)->format('d-m-Y') }}</td>
                    <td>{{ $v->hora_visita }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($v->fecha_visita)->diffInDays(now()) }}
                    </td>
                    <td>
                        {{ $v->gestion->nombre_contacto }}<br>
                        <span class="small">
                            {{ $v->gestion->telefono_contacto }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
