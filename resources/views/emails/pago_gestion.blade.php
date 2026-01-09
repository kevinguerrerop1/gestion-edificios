<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, Helvetica, sans-serif; background-color:#f4f6f8; padding:20px;">

<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">

            <table width="600" cellpadding="0" cellspacing="0"
                   style="background:#ffffff; border-radius:8px; overflow:hidden;">

                <!-- HEADER -->
                <tr>
                    <td style="background:#1f4e78; padding:18px; text-align:center;
                               color:#ffffff; font-size:20px; font-weight:bold;">
                        Servicios Globales RV
                    </td>
                </tr>

                <!-- BODY -->
                <tr>
                    <td style="padding:25px; color:#333333; font-size:14px;">

                        <h2 style="color:#1f4e78; margin-top:0;">
                            Solicitud registrada correctamente
                        </h2>

                        <p>
                            Hola <strong>{{ $gestion->nombre_contacto }}</strong>,
                        </p>

                        <p>
                            Tu solicitud de mantenimiento fue registrada de forma correcta.
                        </p>

                        <hr style="border:none; border-top:1px solid #dddddd; margin:20px 0;">

                        <h3 style="color:#1f4e78;">Detalle de la solicitud</h3>
                        <ul>
                            <li><strong>Edificio:</strong> {{ $gestion->edificio->nombre }}</li>
                            <li><strong>Departamento:</strong> {{ $gestion->departamento }}</li>
                            <li><strong>Problema:</strong> {{ $gestion->titulo }}</li>
                        </ul>

                        <!-- FECHA Y HORA ESTIMADA -->
                        <div style="background:#eef3f8; border-left:5px solid #1f4e78;
                                    padding:15px; margin:20px 0;">
                            <p style="margin:0 0 6px 0; font-weight:bold; color:#1f4e78;">
                                Visita de servicio estimada
                            </p>

                            <p style="margin:0;">
                                Fecha:
                                <strong>
                                    {{ \Carbon\Carbon::parse($gestion->fecha_visita_estimada)->format('d-m-Y') }}
                                </strong><br>
                                Hora:
                                <strong>
                                    {{ $gestion->hora_visita_estimada }} hrs
                                </strong>
                            </p>

                            <p style="margin-top:8px; font-size:13px; color:#555;">
                                * Fecha y horario referenciales, sujetos a confirmacion
                                posterior al pago.
                            </p>
                        </div>

                        <hr style="border:none; border-top:1px solid #dddddd; margin:20px 0;">

                        <h3 style="color:#1f4e78;">Datos de pago</h3>
                        <ul>
                            <li><strong>Empresa:</strong> {{ $pago['empresa'] }}</li>
                            <li><strong>Banco:</strong> {{ $pago['banco'] }}</li>
                            <li><strong>Tipo de cuenta:</strong> {{ $pago['tipo_cuenta'] }}</li>
                            <li><strong>Numero de cuenta:</strong> {{ $pago['numero_cuenta'] }}</li>
                            <li><strong>RUT:</strong> {{ $pago['rut'] }}</li>
                            <li><strong>Monto:</strong> ${{ number_format($pago['monto_base'], 0, ',', '.') }}</li>
                            <li><strong>Correo para comprobante:</strong> {{ $pago['correo'] }}</li>
                        </ul>

                        <!-- IMPORTANTE -->
                        <div style="background:#eef3f8; border-left:5px solid #1f4e78;
                                    padding:15px; margin:25px 0;">
                            <p style="margin:0 0 8px 0; font-weight:bold; color:#1f4e78;">
                                IMPORTANTE
                            </p>

                            <p style="margin:0;">
                                Una vez realizada la transferencia, debes enviar el comprobante de pago al correo:
                            </p>

                            <p style="margin:8px 0; font-weight:bold; color:#1f4e78;">
                                {{ $pago['correo'] }}
                            </p>

                            <p style="margin:0;">
                                La visita de servicio sera agendada solo luego de recibir
                                y validar el comprobante de pago.
                            </p>
                        </div>

                        <!-- BOTON -->
                        <div style="text-align:center; margin:30px 0;">
                            <a href="mailto:{{ $pago['correo'] }}?subject=Comprobante%20de%20pago%20-%20Gestion%20%23{{ $gestion->id }}"
                               style="background:#1f4e78; color:#ffffff; padding:14px 28px;
                                      text-decoration:none; font-size:15px; font-weight:bold;
                                      border-radius:6px; display:inline-block;">
                                Enviar comprobante
                            </a>
                        </div>

                        <p>
                            Recuerda indicar el numero de gestion
                            <strong>#{{ $gestion->id }}</strong> como referencia del pago.
                        </p>

                        <p>
                            Gracias por confiar en <strong>Servicios Globales RV</strong>.
                        </p>

                    </td>
                </tr>

                <!-- FOOTER -->
                <tr>
                    <td style="background:#f0f2f5; padding:15px; text-align:center;
                               font-size:12px; color:#777777;">
                        Este es un correo generado automaticamente, por favor no responder.<br>
                        © {{ date('Y') }} Servicios Globales RV
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>
