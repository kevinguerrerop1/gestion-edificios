<h2>Visita Agendada</h2>

<p>Hola {{ $gestion->nombre_contacto ?? 'Usuario' }},</p>

<p>Tu visita fue programada con éxito.</p>

<p><strong>Departamento:</strong> {{ $gestion->departamento }}</p>
<p><strong>Título:</strong> {{ $gestion->titulo }}</p>
<p><strong>Fecha de visita:</strong> {{ $fecha }}</p>
<p><strong>Hora de visita:</strong> {{ $hora }}</p>

<p>Un técnico asistirá en ese horario.</p>

<p>Gracias por usar nuestro sistema.</p>
