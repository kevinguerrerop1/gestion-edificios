<h4 class="mb-3">
    🏢 {{ $edificio->nombre }} <br>
    <small class="text-muted">
        {{ $edificio->direccion }} – {{ $edificio->comuna }}
    </small>
</h4>
<table id="tabla-gestiones" class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Departamento</th>
            <th>Edificio</th>
            <th>Título</th>
            <th>Nombre Contacto</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($gestiones as $g)
        <tr>
            <td>{{ $g->id }}</td>
            <td>{{ $g->departamento }}</td>
            <td>
                <strong>{{ $g->edificio->nombre ?? 'Sin edificio' }}</strong><br>
                    <small class="text-muted">
                        {{ $g->edificio->direccion ?? '' }}
                    </small>
            </td>
            <td>{{ $g->titulo }}</td>
            <td>{{ $g->nombre_contacto }}</td>
            <td>{{ $g->telefono_contacto }}</td>
            <td>{{ $g->email_contacto }}</td>
            <td>{{\Carbon\Carbon::parse($g->created_at)->format('d-m-Y H:i:s')}}</td>
            <td>
                <span class="badge
                    @if($g->estado == 'pendiente') bg-warning text-dark
                                    @elseif($g->estado == 'en_proceso') bg-info text-dark
                                    @elseif($g->estado == 'realizada') bg-success
                                    @else bg-secondary @endif">
                                    {{ ucfirst(str_replace('_', ' ', $g->estado)) }}
                                </span>
                            </td>

                            <td><a href="{{ route('visitas.historial', $g->id) }}" class="btn btn-warning btn-sm">Visitas</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
