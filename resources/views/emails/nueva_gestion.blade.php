<h2 style="color:#1f4e78;">🛠 Nueva Solicitud de Mantención</h2>

<p>
    Se ha registrado una nueva solicitud en el sistema con el siguiente detalle:
</p>

<hr>

<h3>📌 Información de la solicitud</h3>

<p><strong>Edificio:</strong> {{ $gestion->edificio->nombre }}</p>
<p><strong>Dirección:</strong> {{ $gestion->edificio->direccion }} – {{ $gestion->edificio->comuna }}</p>
<p><strong>Departamento:</strong> {{ $gestion->departamento }}</p>
<p><strong>Trabajo solicitado:</strong> {{ $gestion->titulo }}</p>

<hr>

<h3>👤 Datos de contacto</h3>

<p><strong>Nombre:</strong> {{ $gestion->nombre_contacto }}</p>
<p><strong>Teléfono:</strong> {{ $gestion->telefono_contacto }}</p>
<p><strong>Email:</strong> {{ $gestion->email_contacto }}</p>

<hr>

<h3>📝 Descripción del problema</h3>

<p style="background:#f4f6f8; padding:12px; border-left:4px solid #1f4e78;">
    {{ $gestion->descripcion }}
</p>

<hr>

<h3>📅 Programación inicial</h3>

<ul>
    <li><strong>Estado inicial:</strong> Pendiente</li>
    <li>
        <strong>Visita estimada:</strong>
        {{ \Carbon\Carbon::parse($gestion->fecha_visita_estimada)->format('d-m-Y') }}
        a las {{ $gestion->hora_visita_estimada }} hrs
    </li>
</ul>

<p style="font-size:13px; color:#555;">
    * La fecha y hora indicadas son referenciales y pueden ser ajustadas según disponibilidad.
</p>

<hr>

<h3>🆔 Identificación de la gestión</h3>

<p>
    <strong>N° Gestión:</strong> #{{ $gestion->id }}<br>
    <strong>Fecha de creación:</strong> {{ $gestion->created_at->format('d-m-Y H:i') }}
</p>

<hr>

<p style="font-size:12px; color:#777;">
    Este es un correo automático generado por el
    <strong>Sistema de Mantenciones del Edificio</strong>.<br>
    Por favor no responder a este mensaje.
</p>
