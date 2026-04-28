@extends('layouts.app')

@section('content')
    <style>
        .filtro-scroll {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding-bottom: 6px;
            scroll-behavior: smooth;
        }

        .filtro-scroll::-webkit-scrollbar {
            height: 5px;
        }

        .filtro-scroll::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }

        .chip {
            flex: 0 0 auto;
            padding: 7px 14px;
            border-radius: 25px;
            border: 1px solid #ddd;
            background: #f8f9fa;
            text-decoration: none;
            font-size: 13px;
            color: #333;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: all 0.2s ease;
        }

        .chip:hover {
            background: #e9ecef;
            transform: translateY(-1px);
        }

        .chip.active {
            background: #0d6efd;
            color: white;
            border-color: #0d6efd;
        }

        .chip .badge {
            font-size: 10px;
            padding: 3px 6px;
        }
    </style>
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

        <ul class="nav nav-tabs mb-3">
            {{-- EN PROCESO --}}
            <a class="nav-link {{ request()->routeIs('checkouts.index') ? 'active' : '' }}"
                href="{{ route('checkouts.index', request()->only('edificio_id')) }}">
                🔄 En proceso
            </a>

            {{-- CERRADOS --}}
            <a class="nav-link {{ request()->routeIs('checkouts.cerrados') ? 'active' : '' }}"
                href="{{ route('checkouts.cerrados', request()->only('edificio_id')) }}">
                ✔ Cerrados
            </a>
        </ul>

        @if (session('success'))
            <div class="alert alert-success d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
            </div>
        @endif
        {{-- FILTRO POR EDIFICIO --}}
        @php
            $route = Route::currentRouteName();
        @endphp

        <div class="mb-3">

            {{-- 🔍 BUSCADOR --}}
            <div class="mb-2">
                <input type="text" id="buscadorEdificio" class="form-control form-control-sm"
                    placeholder="🔍 Buscar edificio...">
            </div>

            {{-- 🎯 CHIPS --}}
            <div class="filtro-scroll" id="listaEdificios">

                <div class="mb-3">
                    <div class="d-flex overflow-auto pb-2" id="scrollEdificios">

                        {{-- TODOS --}}
                        <a href="{{ request()->fullUrlWithQuery(['edificio_id' => null]) }}"
                            class="btn btn-sm me-2 flex-shrink-0 {{ request('edificio_id') ? 'btn-outline-secondary' : 'btn-dark' }}">
                            Todos
                        </a>

                        {{-- EDIFICIOS --}}
                        @foreach ($edificios as $e)
                            @php
                                $activo = request('edificio_id') == $e->id;
                                $color = $e->color ?? '#6c757d';
                            @endphp

                            <a href="{{ request()->fullUrlWithQuery(['edificio_id' => $e->id]) }}"
                                class="btn btn-sm me-2 flex-shrink-0 {{ $activo ? 'activo' : '' }}"
                                style="background-color: {{ $activo ? $color : 'transparent' }};border: 2px solid {{ $color }};color: {{ $activo ? '#fff' : $color }};">
                                {{ $e->nombre }}
                            </a>
                        @endforeach

                    </div>
                </div>

            </div>

        </div>

        <table class="table table-bordered table-hover align-middle" id="tabla">
            <thead class="table-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Edificio</th>
                    <th>Técnico</th>
                    <th>Dpto.</th>
                    <th>Inicio</th>
                    <th>Término</th>
                    <th>Monto Neto</th>
                    <th>PDF</th>
                    <th>Estado</th>
                    <th>OC</th>
                    <th>Factura</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($checkouts as $c)
                    <tr>
                        <td class="text-center fw-bold">{{ $c->id }}</td>

                        <td>{{ $c->edificio->nombre ?? '-' }}</td>

                        <td>
                            <i class="bi bi-person text-muted"></i>
                            {{ $c->tecnico->nombre ?? '-' }}
                        </td>

                        <td class="text-center">{{ $c->bloque }}</td>

                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($c->fecha_inicio)->format('d-m-Y') }}
                        </td>

                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($c->fecha_termino)->format('d-m-Y') }}
                        </td>

                        <td class="text-end fw-semibold text-success">
                            @if ($c->monto_neto)
                                ${{ number_format($c->monto_neto, 0, ',', '.') }}
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        {{-- PDFS --}}
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                @if ($c->pdf_solicitud)
                                    <a href="{{ asset('checkout/' . $c->pdf_solicitud) }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary" title="Solicitud">
                                        📄
                                    </a>
                                @endif

                                @if ($c->pdf_entrega)
                                    <a href="{{ asset('checkout/' . $c->pdf_entrega) }}" target="_blank"
                                        class="btn btn-sm btn-outline-success" title="Entrega">
                                        📄
                                    </a>
                                @endif

                                @if (!$c->pdf_solicitud && !$c->pdf_entrega)
                                    <span class="text-muted">—</span>
                                @endif
                            </div>
                        </td>

                        {{-- ESTADO EDITABLE LIBRE --}}
                        <td class="text-center">

                            @php
                                switch ($c->estado) {
                                    case 'pendiente':
                                        $color = 'secondary';
                                        break;
                                    case 'en_revision':
                                        $color = 'primary';
                                        break;
                                    case 'con_reparos':
                                        $color = 'warning';
                                        break;
                                    case 'finalizado':
                                        $color = 'success';
                                        break;
                                    default:
                                        $color = 'secondary';
                                        break;
                                }
                            @endphp

                            <form method="POST" action="{{ route('checkouts.estado', $c->id) }}">
                                @csrf

                                <select name="estado"
                                    class="form-select form-select-sm text-center border-{{ $color }} text-{{ $color }}"
                                    onchange="this.form.submit()">

                                    <option value="pendiente" {{ $c->estado == 'pendiente' ? 'selected' : '' }}>
                                        Pendiente
                                    </option>

                                    <option value="en_revision" {{ $c->estado == 'en_revision' ? 'selected' : '' }}>
                                        En revisión
                                    </option>

                                    <option value="con_reparos" {{ $c->estado == 'con_reparos' ? 'selected' : '' }}>
                                        Con reparos
                                    </option>

                                    <option value="finalizado" {{ $c->estado == 'finalizado' ? 'selected' : '' }}>
                                        Finalizado
                                    </option>

                                </select>

                            </form>

                        </td>
                        {{-- 🔵 OC --}}
                        <td class="text-center">

                            @if ($c->nro_oc)
                                <div class="fw-semibold">{{ $c->nro_oc }}</div>
                            @endif

                            @if ($c->pdf_oc)
                                <a href="{{ asset('checkout/' . $c->pdf_oc) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary mt-1 w-100">
                                    📄 Ver OC
                                </a>
                            @endif

                            @if (!$c->nro_oc && !$c->pdf_oc)
                                <span class="text-muted">—</span>
                            @endif

                        </td>

                        {{-- 🟢 FACTURA --}}
                        <td class="text-center">

                            @if ($c->nro_factura)
                                <div class="fw-semibold">{{ $c->nro_factura }}</div>
                            @endif

                            @if ($c->pdf_factura)
                                <a href="{{ asset('checkout/' . $c->pdf_factura) }}" target="_blank"
                                    class="btn btn-sm btn-outline-success mt-1 w-100">
                                    🧾 Ver Factura
                                </a>
                            @endif

                            @if (!$c->nro_factura && !$c->pdf_factura)
                                <span class="text-muted">—</span>
                            @endif

                        </td>
                        {{-- ACCIONES --}}
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                    Acciones
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('checkouts.show', $c->id) }}">👁 Ver</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('checkouts.edit', $c->id) }}">✏️ Editar</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('checkouts.historial', $c->id) }}">💬
                                            Historial</a></li>
                                    <li><button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#modalDocs{{ $c->id }}">📄 OC/Factura</button></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="{{ route('checkouts.destroy', $c->id) }}" method="POST"
                                            onsubmit="return confirm('¿Seguro?')">
                                            @csrf @method('DELETE')
                                            <button class="dropdown-item text-danger">🗑 Eliminar</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <div class="modal fade" id="modalDocs{{ $c->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="card border-0 bg-light mb-3">
                                <div class="card-body py-2">

                                    <div class="d-flex justify-content-between small">
                                        <span><strong>#{{ $c->id }}</strong></span>
                                        <span class="text-muted">{{ $c->edificio->nombre ?? '-' }}</span>
                                    </div>

                                    <div class="small text-muted">
                                        👨‍🔧 {{ $c->tecnico->nombre ?? '-' }} |
                                        📍 {{ $c->bloque }} |
                                        📅 {{ \Carbon\Carbon::parse($c->fecha_inicio)->format('d-m-Y') }}
                                    </div>

                                </div>
                            </div>
                            <form method="POST" action="{{ route('checkouts.documentos', $c->id) }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="modal-content">

                                    <div class="modal-header bg-dark text-white">
                                        <h5 class="modal-title">📄 OC / Factura</h5>
                                        <button type="button" class="btn-close btn-close-white"
                                            data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">

                                        {{-- OC --}}
                                        <div class="mb-3">
                                            <label>N° OC</label>
                                            <input type="text" name="nro_oc" class="form-control"
                                                value="{{ $c->nro_oc }}">
                                        </div>

                                        <div class="mb-3">
                                            <label>PDF OC</label>
                                            <input type="file" name="pdf_oc" class="form-control">

                                            @if ($c->pdf_oc)
                                                <a href="{{ asset('checkout/' . $c->pdf_oc) }}" target="_blank"
                                                    class="btn btn-sm btn-outline-primary mt-2 w-100">
                                                    Ver OC actual
                                                </a>
                                            @endif
                                        </div>

                                        <hr>

                                        {{-- FACTURA --}}
                                        <div class="mb-3">
                                            <label>N° Factura</label>
                                            <input type="text" name="nro_factura" class="form-control"
                                                value="{{ $c->nro_factura }}">
                                        </div>

                                        <div class="mb-3">
                                            <label>PDF Factura</label>
                                            <input type="file" name="pdf_factura" class="form-control">

                                            @if ($c->pdf_factura)
                                                <a href="{{ asset('checkout/' . $c->pdf_factura) }}" target="_blank"
                                                    class="btn btn-sm btn-outline-success mt-2 w-100">
                                                    Ver Factura actual
                                                </a>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-success w-100">
                                            💾 Guardar
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        document.getElementById('buscadorEdificio').addEventListener('keyup', function() {

            let filtro = this.value.toLowerCase().trim();

            document.querySelectorAll('#listaEdificios .chip').forEach(el => {

                let nombre = el.dataset.nombre || '';

                if (filtro === '') {
                    el.style.display = 'flex'; // 👈 mantener layout
                    return;
                }

                if (nombre.includes(filtro)) {
                    el.style.display = 'flex';
                } else {
                    el.style.display = 'none';
                }

            });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const activo = document.querySelector('#scrollEdificios .activo');

            if (activo) {
                activo.scrollIntoView({
                    behavior: 'auto',
                    inline: 'center',
                    block: 'nearest'
                });
            }

        });
    </script>
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
