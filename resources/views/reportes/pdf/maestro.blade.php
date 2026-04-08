<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte Maestro</title>

    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 11px;
        }

        h2 {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
        }

        th {
            background: #eee;
        }
    </style>
</head>

<body>

    <h2>Reporte Maestro de Gestiones</h2>

    <p>
        Fecha generación: {{ now()->format('d-m-Y H:i') }}
    </p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Edificio</th>
                <th>Estado</th>
                <th>Fecha creación</th>
            </tr>
        </thead>
        <tbody>

            @forelse($gestiones as $g)
                <tr>
                    <td>{{ $g->id }}</td>
                    <td>{{ $g->edificio->nombre ?? '-' }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $g->estado)) }}</td>
                    <td>{{ $g->created_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay registros</td>
                </tr>
            @endforelse

        </tbody>
    </table>

</body>

</html>
