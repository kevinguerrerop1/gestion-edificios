<!DOCTYPE html>
<html lang="es">
<body style="font-family: Arial, sans-serif;">

<h2>Solicitud registrada correctamente</h2>

<p>
Hola <strong>{{ $gestion->nombre_contacto }}</strong>,
</p>

<p>
Tu solicitud de mantención ha sido registrada con éxito.
</p>

<hr>

<h3>📌 Detalle de la solicitud</h3>
<ul>
    <li><strong>Edificio:</strong> {{ $gestion->edificio->nombre }}</li>
    <li><strong>Departamento:</strong> {{ $gestion->departamento }}</li>
    <li><strong>Problema:</strong> {{ $gestion->titulo }}</li>
</ul>

<hr>

<h3>💳 Información de pago</h3>
<ul>
    <li><strong>Empresa:</strong> {{ $pago['empresa'] }}</li>
    <li><strong>Banco:</strong> {{ $pago['banco'] }}</li>
    <li><strong>Tipo de cuenta:</strong> {{ $pago['tipo_cuenta'] }}</li>
    <li><strong>N° Cuenta:</strong> {{ $pago['numero_cuenta'] }}</li>
    <li><strong>RUT:</strong> {{ $pago['rut'] }}</li>
    <li><strong>Monto:</strong> ${{ number_format($pago['monto_base'], 0, ',', '.') }}</li>
    <li><strong>Correo para comprobante:</strong> {{ $pago['correo'] }}</li>
</ul>

<p>
📎 <strong>Importante:</strong> Indica el número de gestión
<strong>#{{ $gestion->id }}</strong> como referencia del pago.
</p>

<p>
Gracias por confiar en nosotros.
</p>

<hr>
<small>Este es un correo automático, no responder.</small>

</body>
</html>
