<!DOCTYPE html>
<html lang="es">
<body style="font-family: Arial, Helvetica, sans-serif; background-color:#f4f6f8; padding:20px;">

<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">

            <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.08);">

                <!-- HEADER / LOGO -->
                <tr>
                    <td style="background:#1f4e78; padding:20px; text-align:center;">
                        <!-- ESPACIO PARA LOGO -->
                        <div style="color:#ffffff; font-size:22px; font-weight:bold;">
                            Servicios Globales RV
                        </div>

                        <!--img src="{{ secure_url('images/logo-servicios-globales-rv.png') }}"
                            alt="Servicios Globales RV"
                            style="max-height:60px; display:block; margin:0 auto;"-->

                    </td>
                </tr>

                <!-- BODY -->
                <tr>
                    <td style="padding:25px; color:#333333;">

                        <h2 style="color:#1f4e78; margin-top:0;">
                            Solicitud registrada correctamente
                        </h2>

                        <p>
                            Hola <strong>{{ $gestion->nombre_contacto }}</strong>,
                        </p>

                        <p>
                            Tu solicitud de mantención ha sido registrada con éxito.
                        </p>

                        <hr style="border:none; border-top:1px solid #dddddd; margin:20px 0;">

                        <h3 style="color:#1f4e78;">📌 Detalle de la solicitud</h3>
                        <ul>
                            <li><strong>Edificio:</strong> {{ $gestion->edificio->nombre }}</li>
                            <li><strong>Departamento:</strong> {{ $gestion->departamento }}</li>
                            <li><strong>Problema:</strong> {{ $gestion->titulo }}</li>
                        </ul>

                        <hr style="border:none; border-top:1px solid #dddddd; margin:20px 0;">

                        <h3 style="color:#1f4e78;">💳 Información de pago</h3>
                        <ul>
                            <li><strong>Empresa:</strong> {{ $pago['empresa'] }}</li>
                            <li><strong>Banco:</strong> {{ $pago['banco'] }}</li>
                            <li><strong>Tipo de cuenta:</strong> {{ $pago['tipo_cuenta'] }}</li>
                            <li><strong>N° Cuenta:</strong> {{ $pago['numero_cuenta'] }}</li>
                            <li><strong>RUT:</strong> {{ $pago['rut'] }}</li>
                            <li><strong>Monto:</strong> ${{ number_format($pago['monto_base'], 0, ',', '.') }}</li>
                            <li><strong>Correo para comprobante:</strong> {{ $pago['correo'] }}</li>
                        </ul>

                        <!-- BLOQUE IMPORTANTE -->
                        <div style="background:#e9f1f8; border-left:5px solid #1f4e78; padding:15px; margin:25px 0; border-radius:4px;">
                            <p style="margin:0 0 8px 0; font-weight:bold; color:#1f4e78;">
                                📌 IMPORTANTE
                            </p>
                            <p style="margin:0;">
                                Una vez realizada la transferencia, debes enviar el <strong>comprobante de pago</strong> al correo:
                            </p>
                            <p style="font-size:16px; font-weight:bold; margin:8px 0; color:#1f4e78;">
                                📧 {{ $pago['correo'] }}
                            </p>
                            <p style="margin:0;">
                                <strong>La visita técnica será agendada únicamente después de recibir y validar el comprobante de pago.</strong>
                            </p>
                        </div>
                        <!-- BOTÓN ENVIAR COMPROBANTE -->
                        <div style="text-align:center; margin:30px 0;">
                            <a href="mailto:{{ $pago['correo'] }}?subject=Comprobante%20de%20pago%20-%20Gesti%C3%B3n%20%23{{ $gestion->id }}"
                            style="
                                background:#1f4e78;
                                color:#ffffff;
                                padding:14px 28px;
                                text-decoration:none;
                                font-size:16px;
                                font-weight:bold;
                                border-radius:6px;
                                display:inline-block;
                            ">
                                📤 Enviar comprobante
                            </a>
                        </div>

                        <p>
                            📎 Recuerda indicar el número de gestión <strong>#{{ $gestion->id }}</strong> como referencia del pago.
                        </p>

                        <p>
                            Gracias por confiar en <strong>Servicios Globales RV</strong>.
                        </p>

                    </td>
                </tr>

                <!-- FOOTER -->
                <tr>
                    <td style="background:#f0f2f5; padding:15px; text-align:center; font-size:12px; color:#777777;">
                        Este es un correo automático, por favor no responder.<br>
                        © {{ date('Y') }} Servicios Globales RV
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>
