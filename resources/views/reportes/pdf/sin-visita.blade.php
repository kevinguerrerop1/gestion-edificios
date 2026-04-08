<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Solicitudes sin visita agendada</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
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
            background: #1f4e78;
            color: white;
            padding: 6px;
            font-size: 11px;
        }

        td {
            border: 1px solid #ddd;
            padding: 6px;
            font-size: 11px;
        }

        .small {
            font-size: 10px;
            color: #555;
        }
    </style>
</head>

<body>

    <h2>Solicitudes sin visita agendada</h2>

    <p class="small">
        Fecha de generación: {{ now()->format('d-m-Y H:i') }} hrs
    </p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Edificio</th>
                <th>Departamento</th>
                <th>Contacto</th>
                <th>Teléfono</th>
                <th>Fecha solicitud</th>
                <th>Días sin agendar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gestiones as $g)
                <tr>
                    <td>#{{ $g->id }}</td>
                    <td>
                        {{ $g->edificio->nombre ?? '—' }}<br>
                        <span class="small">
                            {{ $g->edificio->direccion ?? '' }}
                        </span>
                    </td>
                    <td>{{ $g->departamento }}</td>
                    <td>{{ $g->nombre_contacto }}</td>
                    <td>{{ $g->telefono_contacto }}</td>
                    <td>{{ $g->created_at->format('d-m-Y') }}</td>
                    <td>
                        {{ $g->created_at->diffInDays(now()) }} días
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
