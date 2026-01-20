@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">
            📋 Solicitudes sin visita agendada
            <span class="badge bg-secondary">{{ $gestiones->count() }}</span>
        </h4>
    </div>
    <div class="mb-3 text-end">
        <a href="{{ route('reportes.sin-visita.pdf') }}"
            class="btn btn-outline-danger">
            📄 Descargar PDF
        </a>
    </div>

    @if($gestiones->isEmpty())
        <div class="alert alert-success">
            No existen solicitudes pendientes de agendamiento 🎉
        </div>
    @else
        <div class="table-responsive shadow-sm">
            <table id="tabla-gestiones" class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Edificio</th>
                        <th>Departamento</th>
                        <th>Contacto</th>
                        <th>Teléfono</th>
                        <th>Fecha solicitud</th>
                        <th>Días sin agendar</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gestiones as $g)
                        <tr>
                            <td>#{{ $g->id }}</td>
                            <td>
                                {{ $g->edificio->nombre ?? '—' }}<br>
                                <small class="text-muted">
                                    {{ $g->edificio->direccion ?? '' }}
                                </small>
                            </td>
                            <td>{{ $g->departamento }}</td>
                            <td>{{ $g->nombre_contacto }}</td>
                            <td>{{ $g->telefono_contacto }}</td>
                            <td>{{ $g->created_at->format('d-m-Y') }}</td>
                            <td>
                                <span class="badge bg-danger">
                                    {{ $g->created_at->diffInDays(now()) }} días
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgendarVisita" data-gestion="{{ $g->id }}">
                                    📅 Agendar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

{{-- MODAL --}}
<div class="modal fade" id="modalAgendarVisita" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="formAgendarVisita" action="{{ route('visitas.store', 0) }}" method="POST">
                @csrf
                <div class="modal-header" style="background:#1f4e78;">
                    <h5 class="modal-title text-white">📅 Agendar visita</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted small mb-3">
                        La visita se agendará desde el día siguiente.
                    </p>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" name="fecha_visita" class="form-control" min="{{ now()->addDay()->format('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hora</label>
                        <select name="hora_visita" class="form-select" required>
                            <option value="">Seleccione horario</option>
                            @for ($h = 9; $h <= 18; $h++)
                                <option value="{{ sprintf('%02d:00', $h) }}">
                                    {{ sprintf('%02d:00', $h) }} hrs
                                </option>
                            @endfor
                        </select>
                        <small class="text-muted">
                            Horario disponible: 09:00 a 18:00 hrs
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="btn btn-success">
                        💾 Guardar visita
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
    document.getElementById('modalAgendarVisita').addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget;
        let gestionId = button.getAttribute('data-gestion');
        let form = document.getElementById('formAgendarVisita');
        form.action = "{{ route('visitas.store', ':id') }}".replace(':id', gestionId);
    });
</script>

@endsection
