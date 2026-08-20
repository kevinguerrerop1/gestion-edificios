<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cotización {{ $cotizacion->numero_cotizacion }}</title>
    <style>
        @page {
            margin: 20px 30px 20px 30px;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 10px;
            color: #222;
            line-height: 1.25;
            margin: 0;
            padding: 0;
        }

        /* Colores corporativos */
        .color-blue-dark {
            color: #1E3050;
        }

        .bg-blue-dark {
            background-color: #1E3050;
            color: #ffffff;
        }

        /* 1. Header */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        .header-table td {
            vertical-align: middle;
        }

        .company-info-table {
            border-left: 2px solid #1E3050;
            padding-left: 12px;
        }

        .company-title {
            font-size: 14px;
            font-weight: bold;
            color: #1E3050;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .company-details {
            font-size: 9px;
            color: #333;
            line-height: 1.4;
        }

        /* Bloque Cotización */
        .box-cotizacion {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        .box-cotizacion .header-cot {
            background-color: #1E3050;
            color: #ffffff;
            font-weight: bold;
            font-size: 11px;
            padding: 4px 0;
            letter-spacing: 1px;
        }

        .box-cotizacion .num-cot {
            font-size: 11px;
            font-weight: bold;
            color: #1E3050;
            padding: 6px 0;
        }

        .box-cotizacion .header-fecha {
            background-color: #EAEFF5;
            color: #1E3050;
            font-weight: bold;
            font-size: 9px;
            padding: 3px 0;
        }

        .box-cotizacion .val-fecha {
            font-size: 10px;
            padding: 4px 0;
        }

        /* 2. Secciones con barra azul */
        .section-header {
            background-color: #1E3050;
            color: #ffffff;
            font-size: 9.5px;
            font-weight: bold;
            padding: 4px 8px;
            letter-spacing: 0.5px;
        }

        /* Datos del Cliente */
        .client-container {
            width: 100%;
            margin-bottom: 12px;
        }

        .client-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
        }

        .client-table td {
            padding: 2.5px 6px;
            font-size: 9.5px;
        }

        .client-label {
            font-weight: bold;
            color: #222;
            width: 15%;
        }

        .client-val {
            color: #444;
        }

        /* 3. Tabla de Ítems */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        .items-table th {
            background-color: #1E3050;
            color: #ffffff;
            font-size: 8.5px;
            font-weight: bold;
            padding: 5px 4px;
            text-align: center;
            border: 1px solid #1E3050;
        }

        .items-table td {
            border: 1px solid #D9D9D9;
            padding: 4px 6px;
            font-size: 9px;
            height: 16px;
        }

        /* 4. Totales */
        .totals-table {
            width: 40%;
            float: right;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        .totals-table td {
            border: 1px solid #D9D9D9;
            padding: 4px 8px;
            font-size: 9.5px;
        }

        .totals-table .total-row td {
            background-color: #1E3050;
            color: #ffffff;
            font-weight: bold;
            border-color: #1E3050;
        }

        /* 5. Observaciones */
        .obs-container {
            clear: both;
            width: 100%;
            margin-bottom: 10px;
        }

        .obs-box {
            border: 1px solid #D9D9D9;
            border-top: none;
            padding: 6px 8px;
            font-size: 8.5px;
            color: #333;
            min-height: 38px;
        }

        /* 6. Garantías / Iconos */
        .features-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
            margin-bottom: 8px;
        }

        .features-table td.feature-col {
            width: 25%;
            vertical-align: top;
            padding: 4px 6px;
            border-right: 1px solid #1E3050;
        }

        .features-table td.feature-col:last-child {
            border-right: none;
        }

        .feature-icon {
            width: 36px;
            height: 36px;
            vertical-align: top;
        }

        .feature-title {
            font-size: 8px;
            font-weight: bold;
            color: #1E3050;
            margin-bottom: 2px;
        }

        .feature-desc {
            font-size: 7px;
            color: #666;
            line-height: 1.1;
        }

        /* 7. Footer Bar */
        .footer-bar {
            background-color: #1E3050;
            color: #ffffff;
            text-align: center;
            font-size: 8.5px;
            font-weight: bold;
            padding: 5px 0;
            letter-spacing: 0.3px;
        }
    </style>
</head>

<body>

    <!-- 1. ENCABEZADO -->
    <table class="header-table">
        <tr>
            <td style="width: 22%; text-align: left;">
                @if (file_exists(public_path('img/logo-rv.jpeg')))
                    <img src="{{ public_path('img/logo-rv.jpeg') }}" style="width: 110px; height: auto;" alt="Logo">
                @endif
            </td>
            <td style="width: 50%;">
                <div class="company-info-table">
                    <div class="company-title">SERVICIOS GLOBALES RV LTDA.</div>
                    <div class="company-details">
                        <strong>RUT:</strong> 78.201.133-2<br>
                        <strong>Dirección:</strong> Comandante Whiteside N°4903, Oficina 506, San Miguel<br>
                        <strong>Tel:</strong> [+56 9 9491 0577] &nbsp;|&nbsp; <strong>Email:</strong>
                        [contacto@serviciosglobalesrv.cl]
                    </div>
                </div>
            </td>
            <td style="width: 28%; vertical-align: top;">
                <table class="box-cotizacion">
                    <tr>
                        <td class="header-cot">COTIZACIÓN</td>
                    </tr>
                    <tr>
                        <td class="num-cot">{{ $cotizacion->numero_cotizacion }}</td>
                    </tr>
                    <tr>
                        <td class="header-fecha">FECHA</td>
                    </tr>
                    <tr>
                        <td class="val-fecha">{{ \Carbon\Carbon::parse($cotizacion->fecha)->format('d-m-Y') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- 2. DATOS DEL CLIENTE -->
    <div class="client-container">
        <div class="section-header">DATOS DEL CLIENTE</div>
        <table class="client-table">
            <tr>
                <td class="client-label">Cliente</td>
                <td class="client-val" colspan="3">
                    {{ $cotizacion->cliente_nombre ?? ($cotizacion->checkout->edificio->nombre ?? '') }}</td>
            </tr>
            <tr>
                <td class="client-label">Contacto</td>
                <td class="client-val" colspan="3">{{ $cotizacion->contacto ?? 'Sr.(a)' }}</td>
            </tr>
            <tr>
                <td class="client-label">Email</td>
                <td class="client-val" colspan="3">{{ $cotizacion->email ?? '' }}</td>
            </tr>
            <tr>
                <td class="client-label">Teléfono</td>
                <td class="client-val" colspan="3">{{ $cotizacion->telefono ?? '+56 9' }}</td>
            </tr>
            <tr>
                <td class="client-label">Departamento</td>
                <td class="client-val" colspan="3">
                    {{ $cotizacion->departamento ?? ($cotizacion->checkout->bloque ?? '') }}</td>
            </tr>
        </table>
    </div>

    <!-- 3. TABLA DE ÍTEMS -->
    @php
        $detalles = $cotizacion->detalles;
        $totalFilas = max(10, count($detalles));
    @endphp

    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 8%;">N°</th>
                <th style="width: 52%;">DETALLE DEL SERVICIO</th>
                <th style="width: 15%;">VALOR UNITARIO</th>
                <th style="width: 10%;">UNIDADES</th>
                <th style="width: 15%;">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < $totalFilas; $i++)
                @php $item = $detalles[$i] ?? null; @endphp
                <tr>
                    <td style="text-align: center;">{{ $i + 1 }}</td>
                    <td>{{ $item ? $item->detalle_servicio : '' }}</td>
                    <td style="text-align: right;">
                        {{ $item ? '$' . number_format($item->valor_unitario, 0, ',', '.') : '' }}
                    </td>
                    <td style="text-align: center;">
                        {{ $item ? $item->unidades : '' }}
                    </td>
                    <td style="text-align: right;">
                        {{ $item ? '$' . number_format($item->total_linea, 0, ',', '.') : '$0' }}
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>

    <!-- 4. TOTALES -->
    <table class="totals-table">
        <tr>
            <td style="font-weight: bold; width: 50%;">SUBTOTAL</td>
            <td style="text-align: right; width: 50%;">${{ number_format($cotizacion->subtotal, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">IVA 19%</td>
            <td style="text-align: right;">${{ number_format($cotizacion->iva, 0, ',', '.') }}</td>
        </tr>
        <tr class="total-row">
            <td>TOTAL</td>
            <td style="text-align: right;">${{ number_format($cotizacion->total, 0, ',', '.') }}</td>
        </tr>
    </table>

    <!-- 5. OBSERVACIONES -->
    <div class="obs-container">
        <div class="section-header">OBSERVACIONES</div>
        <div class="obs-box">
            {{ $cotizacion->observaciones ?? 'Se encuentran contemplados en los servicios detallados a continuación, personal, mantención e instalación de termo y cualquier otro requerido y necesario para el cumplimiento total del servicio.' }}
        </div>
    </div>

    <!-- 6. TARJETAS DE GARANTÍA CON ICONOS -->
    <table class="features-table">
        <tr>
            {{-- Personal Calificado --}}
            <td class="feature-col">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 40px; vertical-align: top;">
                            @if (file_exists(public_path('img/icon-user.png')))
                                <img src="{{ public_path('img/icon-user.png') }}" class="feature-icon" alt="">
                            @endif
                        </td>
                        <td style="vertical-align: top; padding-left: 4px;">
                            <div class="feature-title">PERSONAL CALIFICADO</div>
                            <div class="feature-desc">Personal capacitado para cada servicio.</div>
                        </td>
                    </tr>
                </table>
            </td>

            {{-- Compromiso --}}
            <td class="feature-col">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 40px; vertical-align: top;">
                            @if (file_exists(public_path('img/award-solid.png')))
                                <img src="{{ public_path('img/award-solid.png') }}" class="feature-icon"
                                    alt="">
                            @endif
                        </td>
                        <td style="vertical-align: top; padding-left: 4px;">
                            <div class="feature-title">COMPROMISO</div>
                            <div class="feature-desc">Compromiso con la calidad.</div>
                        </td>
                    </tr>
                </table>
            </td>

            {{-- Confianza --}}
            <td class="feature-col">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 40px; vertical-align: top;">
                            @if (file_exists(public_path('img/check-solid.png')))
                                <img src="{{ public_path('img/check-solid.png') }}" class="feature-icon"
                                    alt="">
                            @endif
                        </td>
                        <td style="vertical-align: top; padding-left: 4px;">
                            <div class="feature-title">CONFIANZA</div>
                            <div class="feature-desc">Seguridad y transparencia en cada servicio.</div>
                        </td>
                    </tr>
                </table>
            </td>

            {{-- Atención Personalizada --}}
            <td class="feature-col">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 40px; vertical-align: top;">
                            @if (file_exists(public_path('img/handshake-solid.png')))
                                <img src="{{ public_path('img/handshake-solid.png') }}" class="feature-icon"
                                    alt="">
                            @endif
                        </td>
                        <td style="vertical-align: top; padding-left: 4px;">
                            <div class="feature-title">ATENCIÓN PERSONALIZADA</div>
                            <div class="feature-desc">Soluciones adaptadas a cada cliente.</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- 7. BARRA INFERIOR DE AGRADECIMIENTO -->
    <div class="footer-bar">
        Agradecemos su preferencia y quedamos atentos a cualquier consulta.
    </div>

</body>

</html>
