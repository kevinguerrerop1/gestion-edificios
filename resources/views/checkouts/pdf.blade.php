<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Check-Out #{{ $checkout->id }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
        }

        .box {
            border: 1px solid #ddd;
            padding: 12px;
            margin-bottom: 15px;
        }

        .row {
            margin-bottom: 8px;
        }

        .label {
            font-weight: bold;
            color: #555;
        }

        .monto {
            font-size: 18px;
            font-weight: bold;
            color: green;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 30px;
            color: #888;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="title">REPORTE CHECK-OUT</div>
        <div>#{{ $checkout->id }}</div>
    </div>

    <div class="box">
        <div class="row">
            <span class="label">Edificio:</span>
            {{ $checkout->edificio->nombre ?? '-' }}
        </div>

        <div class="row">
            <span class="label">Técnico:</span>
            {{ $checkout->tecnico->nombre ?? 'Sin asignar' }}
        </div>

        <div class="row">
            <span class="label">Bloque:</span>
            {{ $checkout->bloque }}
        </div>

        <div class="row">
            <span class="label">Fecha Inicio:</span>
            {{ \Carbon\Carbon::parse($checkout->fecha_inicio)->format('d-m-Y') }}
        </div>

        <div class="row">
            <span class="label">Fecha Término:</span>
            {{ $checkout->fecha_termino ? \Carbon\Carbon::parse($checkout->fecha_termino)->format('d-m-Y') : '-' }}
        </div>

        <div class="row">
            <span class="label">Estado:</span>
            {{ strtoupper($checkout->estado) }}
        </div>
    </div>

    <div class="box">
        <div class="label">Monto Neto</div>
        <div class="monto">
            $ {{ number_format($checkout->monto_neto, 0, ',', '.') }}
        </div>
    </div>

    <div class="box">
        <div class="label">Documentos</div>

        <div class="row">
            <span class="label">OC:</span>
            {{ $checkout->nro_oc ?? '—' }}
        </div>

        <div class="row">
            <span class="label">Factura:</span>
            {{ $checkout->nro_factura ?? '—' }}
        </div>
    </div>

    <div class="footer">
        Generado el {{ now()->format('d-m-Y H:i') }}
    </div>

</body>

</html>
