@extends('layouts.app')

@section('content')
    <style>
        /* Línea de tiempo vertical */
        .timeline-feed {
            position: relative;
            padding-left: 1.5rem;
        }

        .timeline-feed::before {
            content: '';
            position: absolute;
            left: 0.45rem;
            top: 0.5rem;
            bottom: 0.5rem;
            width: 2px;
            background: #e9ecef;
        }

        .timeline-entry {
            position: relative;
            margin-bottom: 1.25rem;
        }

        .timeline-icon {
            position: absolute;
            left: -1.5rem;
            top: 0.25rem;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #0d6efd;
            border: 2px solid #ffffff;
            box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.25);
        }

        .info-row {
            border-bottom: 1px dashed #e9ecef;
            padding: 0.75rem 0;
        }

        .info-row:last-child {
            border-bottom: none;
        }
    </style>

    <div class="container py-4">

        {{-- NAVEGACIÓN Y TÍTULO --}}
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
            <div>
                <span class="badge bg-primary-subtle text-primary fw-bold px-2 py-1 mb-1">Check-Out
                    #{{ $checkout->id }}</span>
                <h3 class="fw-bold mb-0 text-dark">Historial & Observaciones</h3>
            </div>
            <a href="{{ route('checkouts.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                ← Volver al listado
            </a>
        </div>

        <div class="row g-4">

            {{-- COLUMNA IZQUIERDA: RESUMEN DEL CHECKOUT --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 20px;">
                    <div
                        class="card-header bg-dark text-white fw-semibold py-3 d-flex align-items-center justify-content-between rounded-top-4">
                        <span>📌 Información del Registro</span>
                    </div>

                    <div class="card-body p-3">
                        <div class="info-row d-flex justify-content-between align-items-center">
                            <span class="text-muted small">🏢 Edificio</span>
                            <span class="fw-bold text-dark">{{ $checkout->edificio->nombre ?? '-' }}</span>
                        </div>

                        <div class="info-row d-flex justify-content-between align-items-center">
                            <span class="text-muted small">👷 Técnico</span>
                            <span class="fw-semibold text-dark">{{ $checkout->tecnico->nombre ?? '-' }}</span>
                        </div>

                        <div class="info-row d-flex justify-content-between align-items-center">
                            <span class="text-muted small">🚪 Departamento / Bloque</span>
                            <span class="badge bg-light text-dark border px-2 py-1">{{ $checkout->bloque }}</span>
                        </div>

                        <div class="info-row d-flex justify-content-between align-items-center">
                            <span class="text-muted small">📅 Fecha Inicio</span>
                            <span class="fw-medium text-secondary">
                                {{ $checkout->fecha_inicio ? \Carbon\Carbon::parse($checkout->fecha_inicio)->format('d-m-Y') : '-' }}
                            </span>
                        </div>

                        <div class="info-row d-flex justify-content-between align-items-center">
                            <span class="text-muted small">🏷️ Estado</span>
                            <div>
                                @switch($checkout->estado)
                                    @case('pendiente')
                                        <span class="badge bg-secondary px-3 py-1">Pendiente</span>
                                    @break

                                    @case('en_revision')
                                        <span class="badge bg-primary px-3 py-1">En revisión</span>
                                    @break

                                    @case('con_reparos')
                                        <span class="badge bg-warning text-dark px-3 py-1">Con reparos</span>
                                    @break

                                    @case('finalizado')
                                        <span class="badge bg-success px-3 py-1">Finalizado</span>
                                    @break
                                @endswitch
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- COLUMNA DERECHA: SECCIÓN DE OBSERVACIONES --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="mb-0 fw-bold text-dark">💬 Observaciones Registradas</h5>
                        <span
                            class="badge bg-light text-secondary border rounded-pill">{{ $checkout->observaciones->count() }}
                            notas</span>
                    </div>

                    {{-- FORMULARIO DE NUEVA OBSERVACIÓN --}}
                    <form method="POST" action="{{ route('checkouts.observaciones', $checkout->id) }}" class="mb-4">
                        @csrf
                        <div class="bg-light p-3 rounded-3 border">
                            <label class="form-label small fw-semibold text-secondary mb-2">Agregar nueva nota u
                                observación:</label>
                            <div class="input-group">
                                <input type="text" name="observacion"
                                    class="form-control border-secondary-subtle bg-white"
                                    placeholder="Escribe un comentario..." required>
                                <button class="btn btn-primary fw-semibold px-4" type="submit">
                                    ➕ Publicar
                                </button>
                            </div>
                        </div>
                    </form>

                    <hr class="text-muted opacity-25 mb-4">

                    {{-- FEED EN TIMELINE --}}
                    <div class="timeline-feed">
                        @forelse($checkout->observaciones as $o)
                            <div class="timeline-entry">
                                <div class="timeline-icon"></div>
                                <div class="bg-white p-3 rounded-3 border shadow-2xs">
                                    <p class="mb-2 text-dark fs-6" style="white-space: pre-line;">{{ $o->observacion }}</p>
                                    <div class="text-muted small text-end" style="font-size: 11px;">
                                        📅 {{ $o->created_at->format('d-m-Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5 text-muted">
                                <span>Sin observaciones registradas en este check-out.</span>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>

        </div>

    </div>
@endsection
