<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel">

<head>
    <meta charset="UTF-8">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-family: Arial;
            font-size: 12px;
        }

        th {
            background: #007bff;
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 6px;
        }

        td {
            padding: 5px;
            text-align: center;
        }

        .titulo {
            background: #343a40;
            color: white;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }

        .total {
            font-weight: bold;
            background: #f2f2f2;
        }
    </style>
</head>

<body>

    <table border="1">

        <tr>
            <td colspan="7" class="titulo">
                REPORTE DE CHECKOUTS
            </td>
        </tr>

        <tr>
            <td colspan="7"></td>
        </tr>

        <tr>
            <td><strong>Desde</strong></td>
            <td>{{ request('desde') }}</td>
            <td><strong>Hasta</strong></td>
            <td>{{ request('hasta') }}</td>
        </tr>

        <tr>
            <td colspan="7"></td>
        </tr>

        <tr>
            <th>ID</th>
            <th>EDIFICIO</th>
            <th>TÉCNICO</th>
            <th>FECHA</th>
            <th>ESTADO</th>
            <th>OC</th>
            <th>FACTURA</th>
        </tr>

        @foreach ($checkouts as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->edificio->nombre ?? '-' }}</td>
                <td>{{ $c->tecnico->nombre ?? '-' }}</td>
                <td>{{ $c->fecha_inicio }}</td>
                <td>{{ strtoupper($c->estado) }}</td>
                <td>{{ $c->nro_oc }}</td>
                <td>{{ $c->nro_factura }}</td>
            </tr>
        @endforeach

        <tr class="total">
            <td colspan="6">TOTAL</td>
            <td>{{ $checkouts->count() }}</td>
        </tr>

    </table>

</body>

</html>
