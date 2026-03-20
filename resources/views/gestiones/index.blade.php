@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">
            Listado de Solicitudes
            <a href="{{ route('gestiones.create') }}" class="btn btn-success float-end">
                Nueva Solicitud
            </a>
        </h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="container mt-4">
            <table id="tabla" class="table table-striped table-hover">
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
                                    @elseif ($g->estado == 'pagado') bg-success
                                    @else bg-secondary @endif">
                                    {{ ucfirst(str_replace('_', ' ', $g->estado)) }}
                                </span>
                            </td>
                            <td>
                                {{-- BOTÓN AGENDAR VISITA (solo si está PAGADO) --}}
                                @if($g->estado === 'pagado')
                                    <button class="btn btn-primary btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalAgendarVisita"
                                            data-gestion-id="{{ $g->id }}">
                                        📅 Agendar
                                    </button>
                                @endif
                                {{-- BOTÓN CONFIRMAR PAGO (solo si está PENDIENTE) --}}
                                @if($g->estado === 'pendiente')
                                    <form action="{{ route('gestiones.pagar', $g->id) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('¿Confirmar que el pago fue corroborado?')">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> Confirmar pago
                                        </button>
                                    </form>
                                @endif
                                {{-- BOTÓN FINALIZAR GESTION (solo si esta en proceso)--}}

                                @if($g->estado === 'en_proceso')
                                    <button class="btn btn-danger btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalFinalizarServicio"
                                            data-gestion-id="{{ $g->id }}">
                                        🔒 Finalizar
                                    </button>
                                @endif


                                <a href="{{ route('visitas.historial', $g->id) }}" class="btn btn-warning btn-sm">Historial</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- MODAL AGENDAR VISITA -->
    <div class="modal fade" id="modalAgendarVisita" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form id="formAgendarVisita"
                    action="{{ route('visitas.store', 0) }}"
                    method="POST">
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
                            <input type="date"
                                name="fecha_visita"
                                class="form-control"
                                min="{{ now()->addDay()->format('Y-m-d') }}"
                                required>
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
                        <button type="submit" class="btn btn-success">
                            💾 Guardar visita
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- MODAL FINALIZAR VISITA -->
    <div class="modal fade" id="modalFinalizarServicio" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form id="formFinalizarServicio"
                    method="POST"
                    action="{{ route('gestiones.finalizar', 0) }}">
                    @csrf

                    <div class="modal-header" style="background:#dc3545;">
                        <h5 class="modal-title text-white">
                            🔒 Finalizar servicio
                        </h5>
                        <button type="button"
                                class="btn-close btn-close-white"
                                data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted small mb-3">
                            Esta acción cerrará definitivamente la gestión.
                        </p>

                        <div class="mb-3">
                            <label class="form-label">Comentario de cierre</label>
                            <textarea name="comentario"
                                    class="form-control"
                                    rows="4"
                                    required></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit"
                                class="btn btn-danger">
                            🔒 Finalizar servicio
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

<script>
    //Modal para agendar
    document.addEventListener('DOMContentLoaded', function () {

        const modal = document.getElementById('modalAgendarVisita');
        const form  = document.getElementById('formAgendarVisita');

        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const gestionId = button.getAttribute('data-gestion-id');

            // Reemplaza el 0 por el ID real
            form.action = form.action.replace('/0', '/' + gestionId);
        });

    });

    //Modal para finalizar
    document.addEventListener('DOMContentLoaded', function () {

        const modal = document.getElementById('modalFinalizarServicio');
        const form  = document.getElementById('formFinalizarServicio');

        if (!modal || !form) return;

        modal.addEventListener('show.bs.modal', function (event) {
            const button   = event.relatedTarget;
            const gestionId = button.getAttribute('data-gestion-id');

            form.action = form.action.replace('/0', '/' + gestionId);
        });

    });

</script>
@endsection
