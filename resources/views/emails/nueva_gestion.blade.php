<h2>Nueva Solicitud</h2>

<p><strong>Departamento:</strong> {{ $gestion->departamento }}</p>
<p><strong>Titulo:</strong> {{ $gestion->titulo }}</p>
<p><strong>Contacto:</strong> {{ $gestion->nombre_contacto }} - {{ $gestion->telefono_contacto }}</p>
<p><strong>Email:</strong> {{ $gestion->email_contacto }}</p>

<p><strong>Descripcion:</strong></p>
<p>{{ $gestion->descripcion }}</p>

<hr>

<p><strong>Estado inicial:</strong> Pendiente</p>

<p>
Este es un correo automatico generado por el Sistema de Mantenciones del edificio.
</p>