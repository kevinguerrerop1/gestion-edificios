<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel">

<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: Arial;
            font-size: 12px;
            margin: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
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

        .total {
            font-weight: bold;
            background: #f2f2f2;
        }

        .header td {
            border: none;
        }
    </style>
</head>

<body>

    {{-- 🔥 HEADER CON LOGO BASE64 --}}
    <table class="header" border="0" style="margin-bottom:15px;">
        <tr>
            <td style="text-align:right; font-size:12px;">
                <strong>REPORTE DE CHECKOUTS</strong><br>
                Fecha: {{ date('d-m-Y') }}<br>
                Desde: {{ request('desde') }}<br>
                Hasta: {{ request('hasta') }}
            </td>

        </tr>
    </table>

    {{-- 🔥 TABLA --}}
    <table border="1">

        <tr>
            <th>ID</th>
            <th>EDIFICIO</th>
            <th>TÉCNICO</th>
            <th>DPTO</th>
            <th>FECHA</th>
            <th>ESTADO</th>
            <th>MONTO NETO</th>
            <th>OC</th>
            <th>FACTURA</th>
        </tr>

        @foreach ($checkouts as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->edificio->nombre ?? '-' }}</td>
                <td>{{ $c->tecnico->nombre ?? '-' }}</td>
                <td>{{ $c->bloque ?? '-' }}</td>
                <td>{{ $c->fecha_inicio }}</td>
                <td>{{ strtoupper($c->estado) }}</td>

                <td>
                    @if ($c->monto_neto)
                        ${{ number_format($c->monto_neto, 0, ',', '.') }}
                    @else
                        -
                    @endif
                </td>

                <td>{{ $c->nro_oc }}</td>
                <td>{{ $c->nro_factura }}</td>
            </tr>
        @endforeach

        {{-- TOTAL --}}
        <tr class="total">
            <td colspan="6">TOTAL</td>
            <td>
                ${{ number_format($checkouts->sum('monto_neto'), 0, ',', '.') }}
            </td>
            <td colspan="2">
                {{ $checkouts->count() }} registros
            </td>
        </tr>

    </table>

</body>

</html>
