<h3>Reporte de Check-Outs</h3>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>#</th>
            <th>Edificio</th>
            <th>Técnico</th>
            <th>Inicio</th>
            <th>Estado</th>
            <th>OC</th>
            <th>Factura</th>
        </tr>
    </thead>
    <tbody>
        @foreach($checkouts as $c)
        <tr>
            <td>{{ $c->id }}</td>
            <td>{{ $c->edificio->nombre ?? '-' }}</td>
            <td>{{ $c->tecnico->nombre ?? '-' }}</td>
            <td>{{ $c->fecha_inicio }}</td>
            <td>{{ $c->estado }}</td>
            <td>{{ $c->nro_oc }}</td>
            <td>{{ $c->nro_factura }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
