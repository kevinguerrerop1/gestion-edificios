<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cotización {{ $cotizacion->numero_cotizacion }}</title>
    <style>
        @page {
            margin: 25px 30px;
        }

        body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.3;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .header-table td {
            vertical-align: top;
        }

        .company-title {
            font-size: 13px;
            font-weight: bold;
            color: #0b3c5d;
        }

        .box-cotizacion {
            border: 2px solid #0b3c5d;
            text-align: center;
            padding: 8px;
            background-color: #f4f8fb;
        }

        .box-cotizacion .num {
            font-size: 13px;
            font-weight: bold;
            color: #d9534f;
        }

        .client-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .client-table th {
            background-color: #0b3c5d;
            color: #fff;
            text-align: left;
            padding: 4px 8px;
            font-size: 11px;
        }

        .client-table td {
            border: 1px solid #ddd;
            padding: 4px 8px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        .items-table th {
            background-color: #0b3c5d;
            color: #fff;
            padding: 6px;
            font-size: 10px;
            text-align: center;
            border: 1px solid #0b3c5d;
        }

        .items-table td {
            border: 1px solid #ccc;
            padding: 5px;
            font-size: 10px;
        }

        .totals-table {
            width: 38%;
            float: right;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .totals-table td {
            border: 1px solid #ccc;
            padding: 4px 8px;
            font-size: 10px;
        }

        .observations {
            clear: both;
            border: 1px solid #ddd;
            padding: 8px;
            background-color: #fafafa;
            margin-top: 10px;
            margin-bottom: 15px;
        }

        .badges-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            text-align: center;
        }

        .badges-table td {
            padding: 6px;
            border: 1px solid #e0e0e0;
            background: #fdfdfd;
            width: 25%;
        }

        .badge-title {
            font-weight: bold;
            color: #0b3c5d;
            font-size: 9.5px;
        }

        .badge-desc {
            font-size: 8px;
            color: #666;
        }
    </style>
</head>

<body>

    <!-- Encabezado -->
    <table class="header-table">
        <tr>
            <td style="width: 20%;">
                <img src="{{ public_path('img/logo-rv.jpeg') }}" style="max-width: 85px; height: auto;" alt="Logo">
            </td>
            <td style="width: 50%;">
                <div class="company-title">SERVICIOS GLOBALES RV LTDA.</div>
                <div><strong>RUT:</strong> 78.201.133-2</div>
                <div><strong>Dirección:</strong> Comandante Whiteside N°4903, Oficina 506, San Miguel</div>
                <div><strong>Tel:</strong> +56 9 9491 0577 | <strong>Email:</strong> contacto@serviciosglobalesrv.cl
                </div>
            </td>
            <td style="width: 30%;">
                <div class="box-cotizacion">
                    <div style="font-weight: bold;">COTIZACIÓN</div>
                    <div class="num">{{ $cotizacion->numero_cotizacion }}</div>
                    <div style="margin-top: 4px;"><strong>FECHA:</strong>
                        {{ \Carbon\Carbon::parse($cotizacion->fecha)->format('d-m-Y') }}</div>
                </div>
            </td>
        </tr>
    </table>

    <!-- Datos del Cliente -->
    <table class="client-table">
        <tr>
            <th colspan="4">DATOS DEL CLIENTE</th>
        </tr>
        <tr>
            <td style="width: 15%; font-weight: bold;">Cliente:</td>
            <td style="width: 45%;">
                {{ $cotizacion->cliente_nombre ?? ($cotizacion->checkout->edificio->nombre ?? '-') }}</td>
            <td style="width: 15%; font-weight: bold;">Departamento:</td>
            <td style="width: 25%;">{{ $cotizacion->departamento ?? ($cotizacion->checkout->bloque ?? '-') }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Contacto:</td>
            <td>{{ $cotizacion->contacto ?? 'Sr.(a)' }}</td>
            <td style="font-weight: bold;">Teléfono:</td>
            <td>{{ $cotizacion->telefono ?? '+56 9' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Email:</td>
            <td colspan="3">{{ $cotizacion->email ?? '-' }}</td>
        </tr>
    </table>

    <!-- Tabla de Ítems -->
    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 5%;">N°</th>
                <th style="width: 55%;">DETALLE DEL SERVICIO</th>
                <th style="width: 15%;">VALOR UNITARIO</th>
                <th style="width: 10%;">UNIDADES</th>
                <th style="width: 15%;">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cotizacion->detalles as $idx => $item)
                <tr>
                    <td style="text-align: center;">{{ $idx + 1 }}</td>
                    <td>{{ $item->detalle_servicio }}</td>
                    <td style="text-align: right;">${{ number_format($item->valor_unitario, 0, ',', '.') }}</td>
                    <td style="text-align: center;">{{ $item->unidades }}</td>
                    <td style="text-align: right; font-weight: bold;">
                        ${{ number_format($item->total_linea, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Totales -->
    <table class="totals-table">
        <tr>
            <td style="font-weight: bold; background-color: #f2f2f2;">SUBTOTAL</td>
            <td style="text-align: right; font-weight: bold;">${{ number_format($cotizacion->subtotal, 0, ',', '.') }}
            </td>
        </tr>
        <tr>
            <td style="font-weight: bold; background-color: #f2f2f2;">IVA 19%</td>
            <td style="text-align: right; font-weight: bold;">${{ number_format($cotizacion->iva, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold; background-color: #0b3c5d; color: #fff;">TOTAL</td>
            <td style="text-align: right; font-weight: bold; background-color: #0b3c5d; color: #fff;">
                ${{ number_format($cotizacion->total, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    <!-- Observaciones -->
    <div class="observations">
        <strong style="color: #0b3c5d;">OBSERVACIONES</strong><br>
        <span style="font-size: 9px;">{{ $cotizacion->observaciones }}</span>
    </div>

    <!-- Sellos / Garantía -->
    <table class="badges-table">
        <tr>
            <td>
                <div class="badge-title">PERSONAL CALIFICADO</div>
                <div class="badge-desc">Personal capacitado para cada servicio.</div>
            </td>
            <td>
                <div class="badge-title">COMPROMISO</div>
                <div class="badge-desc">Compromiso con la calidad.</div>
            </td>
            <td>
                <div class="badge-title">CONFIANZA</div>
                <div class="badge-desc">Seguridad y transparencia en cada servicio.</div>
            </td>
            <td>
                <div class="badge-title">ATENCIÓN PERSONALIZADA</div>
                <div class="badge-desc">Soluciones adaptadas a cada cliente.</div>
            </td>
        </tr>
    </table>

    <div style="text-align: center; margin-top: 10px; font-size: 8.5px; color: #777;">
        Agradecemos su preferencia y quedamos atentos a cualquier consulta.
    </div>

</body>

</html>
