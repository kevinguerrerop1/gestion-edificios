<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Reporte Checkouts</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #333;
        }

        .header {
            width: 100%;
            margin-bottom: 15px;
        }

        .logo {
            width: 120px;
        }

        .title {
            text-align: right;
        }

        .title h2 {
            margin: 0;
            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background: #007bff;
            color: white;
            padding: 6px;
            font-size: 11px;
        }

        td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: center;
        }

        .monto {
            text-align: right;
            font-weight: bold;
            color: green;
        }

        .total {
            font-weight: bold;
            background: #f2f2f2;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <table class="header">
        <tr>
            <td>
                <img src="{{ public_path('logo/logo.png') }}" class="logo">
            </td>
            <td class="title">
                <h2>REPORTE CHECKOUTS</h2>
                <div>{{ request('desde') }} / {{ request('hasta') }}</div>
            </td>
        </tr>
    </table>

    {{-- TABLA --}}
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Edificio</th>
                <th>Técnico</th>
                <th>Dpto</th>
                <th>Inicio</th>
                <th>Término</th>
                <th>Estado</th>
                <th>OC</th>
                <th>Factura</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>

            @php $total = 0; @endphp

            @foreach ($checkouts as $c)
                @php $total += $c->monto_neto ?? 0; @endphp

                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->edificio->nombre ?? '-' }}</td>
                    <td>{{ $c->tecnico->nombre ?? '-' }}</td>
                    <td>{{ $c->bloque }}</td>
                    <td>{{ \Carbon\Carbon::parse($c->fecha_inicio)->format('d-m-Y') }}</td>
                    <td>{{ $c->fecha_termino ? \Carbon\Carbon::parse($c->fecha_termino)->format('d-m-Y') : '-' }}</td>
                    <td>{{ strtoupper($c->estado) }}</td>
                    <td>{{ $c->nro_oc ?? '-' }}</td>
                    <td>{{ $c->nro_factura ?? '-' }}</td>
                    <td class="monto">
                        ${{ number_format($c->monto_neto ?? 0, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach

            {{-- TOTAL --}}
            <tr class="total">
                <td colspan="9">TOTAL</td>
                <td class="monto">
                    ${{ number_format($total, 0, ',', '.') }}
                </td>
            </tr>

        </tbody>
    </table>

</body>

</html>
