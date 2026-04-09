@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center">
                <i class="bi bi-clipboard-check fs-3 me-2 text-primary"></i>
                <div>
                    <h4 class="mb-0 fw-bold">Listado de Check-Outs</h4>
                    <small class="text-muted">Gestión de check-outs registrados</small>
                </div>
            </div>
            <a href="{{ route('checkouts.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i> Nuevo Check-Out
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-hover table-striped" id="tabla">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Edificio</th>
                    <th>Técnico</th>
                    <th>Dpto. Asig</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Término</th>
                    <th class="text-center">Artículos</th>
                    <th class="text-center">PDFs</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($checkouts as $c)
                    <tr>
                        <td>{{ $c->id }}</td>

                        <td>{{ $c->edificio->nombre ?? 'Sin edificio' }}</td>

                        <td>
                            <i class="bi bi-person me-1 text-muted"></i>
                            {{ $c->tecnico->nombre ?? 'Sin técnico' }}
                        </td>

                        <td>{{ $c->bloque }}</td>

                        <td>{{ \Carbon\Carbon::parse($c->fecha_inicio)->format('d-m-Y') }}</td>

                        <td>{{ \Carbon\Carbon::parse($c->fecha_termino)->format('d-m-Y') }}</td>

                        <td class="text-center">
                            <span class="badge bg-primary">
                                {{ $c->detalles->sum('cantidad') }}
                            </span>
                        </td>

                        <td class="text-center">

                            @if ($c->pdf_solicitud)
                                <a href="{{ asset('checkout/' . $c->pdf_solicitud) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-file-earmark-text"></i>
                                </a>
                            @endif

                            @if ($c->pdf_entrega)
                                <a href="{{ asset('checkout/' . $c->pdf_entrega) }}" target="_blank"
                                    class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-file-earmark-check"></i>
                                </a>
                            @endif

                            @if (!$c->pdf_solicitud && !$c->pdf_entrega)
                                <span class="text-muted small">
                                    <i class="bi bi-dash"></i>
                                </span>
                            @endif

                        </td>

                        <td>
                            @switch($c->estado)
                                @case('pendiente')
                                    <span class="badge bg-secondary">Pendiente</span>
                                @break

                                @case('en_revision')
                                    <span class="badge bg-primary">En revisión</span>
                                @break

                                @case('con_reparos')
                                    <span class="badge bg-warning text-dark">Con reparos</span>
                                @break

                                @case('finalizado')
                                    <span class="badge bg-success">Finalizado</span>
                                @break
                            @endswitch
                        </td>

                        <td class="text-center">
                            <a href="{{ route('checkouts.show', $c->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-eye me-1"></i> Ver
                            </a>
                            {{-- PENDIENTE → EN REVISION --}}
                            @if ($c->estado == 'pendiente')
                                <form method="POST" action="{{ route('checkouts.estado', $c->id) }}">
                                    @csrf
                                    <input type="hidden" name="estado" value="en_revision">
                                    <button class="btn btn-sm btn-primary">🔍 Revisar</button>
                                </form>
                            @endif

                            {{-- EN REVISION → CON REPAROS --}}
                            @if ($c->estado == 'en_revision')
                                <form method="POST" action="{{ route('checkouts.estado', $c->id) }}">
                                    @csrf
                                    <input type="hidden" name="estado" value="con_reparos">
                                    <button class="btn btn-sm btn-warning">⚠ Reparos</button>
                                </form>
                            @endif

                            {{-- CON REPAROS → FINALIZADO --}}
                            @if ($c->estado == 'con_reparos')
                                <form method="POST" action="{{ route('checkouts.estado', $c->id) }}">
                                    @csrf
                                    <input type="hidden" name="estado" value="finalizado">
                                    <button class="btn btn-sm btn-success">✔ Finalizar</button>
                                </form>
                            @endif

                            {{-- FINALIZADO --}}
                            @if ($c->estado == 'finalizado')
                                <span class="text-success fw-bold">✔ Finalizado</span>
                            @endif

                            <a href="{{ route('checkouts.historial', $c->id) }}" class="btn btn-sm btn-outline-primary">
                                💬 Historial
                            </a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#tabla').DataTable({
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                language: {
                    lengthMenu: "Mostrar _MENU_ registros",
                    zeroRecords: "No se encontraron resultados",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "Mostrando 0 a 0 de 0 registros",
                    infoFiltered: "(filtrado de _MAX_ registros totales)",
                    search: "Buscar:",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "→",
                        previous: "←"
                    }
                }
            });
        });
    </script>
@endsection
