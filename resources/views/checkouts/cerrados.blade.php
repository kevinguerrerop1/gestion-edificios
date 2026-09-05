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

    {{-- Contenedor centrado y proporcionado --}}
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
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('checkouts.index') ? 'active' : '' }}"
                    href="{{ route('checkouts.index', request()->only('edificio_id')) }}">
                    🔄 En proceso
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('checkouts.cerrados') ? 'active' : '' }}"
                    href="{{ route('checkouts.cerrados', request()->only('edificio_id')) }}">
                    ✔ Cerrados
                </a>
            </li>
        </ul>

        {{-- 📅 FILTRO POR MES --}}
        <div class="mb-3">
            <div class="filtro-scroll">
                <a href="{{ request()->fullUrlWithQuery(['mes' => null]) }}"
                    class="btn btn-sm me-2 flex-shrink-0 {{ request('mes') ? 'btn-outline-dark' : 'btn-dark' }}">
                    📅 Todos
                </a>

                @php
                    $meses = [
                        1 => 'Enero',
                        2 => 'Febrero',
                        3 => 'Marzo',
                        4 => 'Abril',
                        5 => 'Mayo',
                        6 => 'Junio',
                        7 => 'Julio',
                        8 => 'Agosto',
                        9 => 'Septiembre',
                        10 => 'Octubre',
                        11 => 'Noviembre',
                        12 => 'Diciembre',
                    ];
                @endphp

                @foreach ($meses as $numero => $nombre)
                    @php $activo = $mesSeleccionado == $numero; @endphp
                    <a href="{{ request()->fullUrlWithQuery(['mes' => $numero]) }}" class="btn btn-sm me-2 flex-shrink-0"
                        style="background-color: {{ $activo ? '#198754' : 'transparent' }}; border: 2px solid #198754; color: {{ $activo ? '#fff' : '#198754' }}; border-radius: 25px;">
                        {{ $nombre }}
                    </a>
                @endforeach
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- FILTRO POR EDIFICIO --}}
        <div class="mb-3">
            <div class="mb-2">
                <input type="text" id="buscadorEdificio" class="form-control form-control-sm"
                    placeholder="🔍 Buscar edificio...">
            </div>

            <div class="filtro-scroll" id="listaEdificios">
                <div class="mb-3">
                    <div class="d-flex overflow-auto pb-2" id="scrollEdificios">
                        {{-- BOTÓN TODOS CUADRADO IGUAL AL DE MESES --}}
                        <a href="{{ request()->fullUrlWithQuery(['edificio_id' => null]) }}"
                            class="btn btn-sm me-2 flex-shrink-0 {{ request('edificio_id') ? 'btn-outline-dark' : 'btn-dark' }}">
                            Todos
                        </a>

                        {{-- CHIPS DE EDIFICIOS --}}
                        @foreach ($edificios as $e)
                            @php
                                $activo = request('edificio_id') == $e->id;
                                $color = $e->color ?? '#6c757d';

                                // Cálculo de contraste de luminosidad (YIQ) para color de texto
                                $hex = ltrim($color, '#');
                                if (strlen($hex) == 3) {
                                    $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
                                }
                                $r = hexdec(substr($hex, 0, 2));
                                $g = hexdec(substr($hex, 2, 2));
                                $b = hexdec(substr($hex, 4, 2));
                                $yiq = ($r * 299 + $g * 587 + $b * 114) / 1000;

                                $textColor = $yiq >= 150 ? '#111827' : '#ffffff';
                            @endphp

                            <a href="{{ request()->fullUrlWithQuery(['edificio_id' => $e->id]) }}"
                                class="btn btn-sm me-2 flex-shrink-0 {{ $activo ? 'activo' : '' }}"
                                style="
                            background-color: {{ $color }};
                            border: 2px solid {{ $activo ? '#000000' : $color }};
                            color: {{ $textColor }};
                            border-radius: 20px;
                            font-weight: {{ $activo ? 'bold' : '500' }};
                            box-shadow: {{ $activo ? '0 0 0 3px rgba(0,0,0,0.25), 0 2px 4px rgba(0,0,0,0.15)' : '0 1px 3px rgba(0,0,0,0.1)' }};
                            opacity: {{ request('edificio_id') && !$activo ? '0.55' : '1' }};
                            transition: all 0.2s ease;
                        ">
                                {{ $e->nombre }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- TABLA CON ANCHOS CONTROLADOS --}}
        <table class="table table-bordered table-hover align-middle w-100" id="tabla">
            <thead class="table-dark text-center">
                <tr>
                    <th style="width: 4%;">#</th>
                    <th style="width: 14%;">Edificio</th>
                    <th style="width: 13%;">Técnico</th>
                    <th style="width: 5%;">Dpto.</th>
                    <th style="width: 8%;">Inicio</th>
                    <th style="width: 8%;">Término</th>
                    <th style="width: 8%;">Monto Neto</th>
                    <th style="width: 8%;">Terreno</th>
                    <th style="width: 5%;">PDF</th>
                    <th style="width: 10%;">Estado</th>
                    <th style="width: 10%;">Observaciones</th>
                    <th style="width: 7%;">Factura</th>
                    <th style="width: 8%;">Acciones</th>
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
                        <td class="text-center">{{ \Carbon\Carbon::parse($c->fecha_inicio)->format('d-m-Y') }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($c->fecha_termino)->format('d-m-Y') }}</td>
                        <td class="text-end fw-semibold text-success">
                            {{ $c->monto_neto ? '$' . number_format($c->monto_neto, 0, ',', '.') : '—' }}
                        </td>

                        {{-- COLUMNA REEMPLAZADA: PDF TERRENO --}}
                        <td class="text-center">
                            @if ($c->pdf_terreno)
                                <a href="{{ asset('checkout/' . $c->pdf_terreno) }}" target="_blank"
                                    class="btn btn-sm btn-outline-warning py-0 px-2 fw-semibold text-dark"
                                    style="font-size: 11px;" title="Ver Check-Out Terreno">
                                    📋 Terreno
                                </a>
                            @else
                                <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2 text-nowrap"
                                    style="font-size: 11px;" data-bs-toggle="modal"
                                    data-bs-target="#modalTerreno{{ $c->id }}" title="Subir Check-Out Terreno">
                                    ➕ Terreno
                                </button>
                            @endif
                        </td>

                        {{-- PDFS CHECKOUT --}}
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

                        {{-- ESTADO --}}
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
                                    <option value="pendiente" {{ $c->estado == 'pendiente' ? 'selected' : '' }}>Pendiente
                                    </option>
                                    <option value="en_revision" {{ $c->estado == 'en_revision' ? 'selected' : '' }}>En
                                        revisión</option>
                                    <option value="con_reparos" {{ $c->estado == 'con_reparos' ? 'selected' : '' }}>Con
                                        reparos</option>
                                    <option value="finalizado" {{ $c->estado == 'finalizado' ? 'selected' : '' }}>
                                        Finalizado</option>
                                </select>
                            </form>
                        </td>

                        {{-- OBSERVACIONES --}}
                        <td>
                            @php $ultimaObs = $c->observaciones->sortByDesc('created_at')->first(); @endphp
                            @if ($ultimaObs)
                                <div class="small">
                                    <div class="fw-semibold text-truncate" style="max-width: 140px;"
                                        title="{{ $ultimaObs->observacion }}">
                                        {{ $ultimaObs->observacion }}
                                    </div>
                                    <div class="text-muted" style="font-size: 11px;">
                                        📅 {{ \Carbon\Carbon::parse($ultimaObs->created_at)->format('d-m-Y') }}
                                    </div>
                                </div>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        {{-- FACTURA --}}
                        <td class="text-center">
                            @if ($c->nro_factura)
                                <div class="fw-semibold small">{{ $c->nro_factura }}</div>
                            @endif
                            @if ($c->pdf_factura)
                                <a href="{{ asset('checkout/' . $c->pdf_factura) }}" target="_blank"
                                    class="btn btn-sm btn-outline-success mt-1 w-100 py-0" style="font-size: 11px;">
                                    🧾 Factura
                                </a>
                            @endif
                            @if (!$c->nro_factura && !$c->pdf_factura)
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        {{-- ACCIONES --}}
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                    data-bs-toggle="dropdown">
                                    Acciones
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('checkouts.show', $c->id) }}">👁 Ver</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('checkouts.edit', $c->id) }}">✏️
                                            Editar</a></li>
                                    <li><a class="dropdown-item" href="{{ route('checkouts.historial', $c->id) }}">💬
                                            Historial</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    {{-- BOTÓN AGREGADO EN ACCIONES: CHECK-OUT TERRENO --}}
                                    <li>
                                        <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#modalTerreno{{ $c->id }}">
                                            📋 Check-Out Terreno
                                        </button>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('checkouts.cotizaciones.create', $c->id) }}">➕ Nueva
                                            Cotización</a></li>
                                    <li><button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#modalCotizaciones{{ $c->id }}">📑 Ver Cotizaciones
                                            ({{ $c->cotizaciones ? $c->cotizaciones->count() : 0 }})
                                        </button></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#modalDocs{{ $c->id }}">📄 OC/Factura</button></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="{{ route('checkouts.destroy', $c->id) }}" method="POST"
                                            onsubmit="return confirm('¿Seguro que deseas eliminar este checkout?')">
                                            @csrf @method('DELETE')
                                            <button class="dropdown-item text-danger">🗑 Eliminar</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- MODALES FUERA DE LA TABLA --}}
    @foreach ($checkouts as $c)
        {{-- MODAL CHECK-OUT TERRENO --}}
        <div class="modal fade" id="modalTerreno{{ $c->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('checkouts.subirTerreno', $c->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-white">
                            <h5 class="modal-title fs-6">
                                📋 Check-Out Terreno - #{{ $c->id }} ({{ $c->edificio->nombre ?? '-' }} - Dpto.
                                {{ $c->bloque }})
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Cerrar"></button>
                        </div>

                        <div class="modal-body">
                            @if ($c->pdf_terreno)
                                <div
                                    class="alert alert-success d-flex justify-content-between align-items-center py-2 mb-3">
                                    <div>
                                        <i class="bi bi-file-earmark-pdf-fill me-1"></i>
                                        <strong>Documento cargado</strong>
                                    </div>
                                    <a href="{{ asset('checkout/' . $c->pdf_terreno) }}" target="_blank"
                                        class="btn btn-sm btn-success">
                                        👁️ Ver PDF actual
                                    </a>
                                </div>
                                <label class="form-label small fw-semibold">Reemplazar documento (PDF):</label>
                            @else
                                <label class="form-label small fw-semibold">Seleccionar documento Check-Out Terreno
                                    (PDF)
                                    :</label>
                            @endif

                            <input type="file" name="pdf_terreno" class="form-control" accept="application/pdf"
                                required>
                            <small class="text-muted" style="font-size: 11px;">Solo archivos en formato PDF (máx.
                                20MB).</small>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm"
                                data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary btn-sm">
                                💾 {{ $c->pdf_terreno ? 'Actualizar Documento' : 'Subir Documento' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- MODAL COTIZACIONES --}}
        <div class="modal fade" id="modalCotizaciones{{ $c->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title">
                            📑 Cotizaciones - Check-Out #{{ $c->id }} ({{ $c->edificio->nombre ?? '-' }} - Dpto.
                            {{ $c->bloque }})
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Listado de cotizaciones asociadas a este check-out</span>
                            <a href="{{ route('checkouts.cotizaciones.create', $c->id) }}"
                                class="btn btn-sm btn-success">
                                ➕ Emitir Nueva Cotización
                            </a>
                        </div>

                        @if ($c->cotizaciones && $c->cotizaciones->count() > 0)
                            <div class="accordion" id="accordionCotizaciones{{ $c->id }}">
                                @foreach ($c->cotizaciones as $index => $cot)
                                    <div class="accordion-item mb-2 border shadow-sm">
                                        <h2 class="accordion-header" id="headingCot{{ $cot->id }}">
                                            <button
                                                class="accordion-button {{ $loop->first ? '' : 'collapsed' }} bg-light"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseCot{{ $cot->id }}">
                                                <div class="d-flex justify-content-between align-items-center w-100 me-3">
                                                    <div>
                                                        <strong class="text-primary fs-6">Cotización:
                                                            {{ $cot->numero_cotizacion }}</strong>
                                                        <span class="text-muted ms-2 small">📅 Fecha:
                                                            {{ \Carbon\Carbon::parse($cot->fecha)->format('d-m-Y') }}</span>
                                                    </div>
                                                    <div>
                                                        <span
                                                            class="badge {{ $cot->estado == 'autorizada' ? 'bg-success' : 'bg-warning text-dark' }} me-2">
                                                            {{ ucfirst($cot->estado) }}
                                                        </span>
                                                        <strong
                                                            class="text-success">${{ number_format($cot->total, 0, ',', '.') }}</strong>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseCot{{ $cot->id }}"
                                            class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                            data-bs-parent="#accordionCotizaciones{{ $c->id }}">
                                            <div class="accordion-body">
                                                <div class="row g-2 mb-3 bg-light p-2 rounded small">
                                                    <div class="col-md-3"><strong>Cliente:</strong>
                                                        {{ $cot->cliente_nombre ?? ($c->edificio->nombre ?? '-') }}</div>
                                                    <div class="col-md-3"><strong>Contacto:</strong>
                                                        {{ $cot->contacto ?? 'Sr.(a)' }}</div>
                                                    <div class="col-md-3"><strong>Teléfono:</strong>
                                                        {{ $cot->telefono ?? '-' }}</div>
                                                    <div class="col-md-3"><strong>Email:</strong> {{ $cot->email ?? '-' }}
                                                    </div>
                                                </div>

                                                <div class="table-responsive mb-3">
                                                    <table class="table table-sm table-bordered align-middle">
                                                        <thead class="table-secondary text-center">
                                                            <tr>
                                                                <th style="width: 5%;">#</th>
                                                                <th style="width: 55%;">Detalle del Servicio</th>
                                                                <th style="width: 15%;">Valor Unitario</th>
                                                                <th style="width: 10%;">Unidades</th>
                                                                <th style="width: 15%;">Total Línea</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($cot->detalles as $idx => $d)
                                                                <tr>
                                                                    <td class="text-center">{{ $idx + 1 }}</td>
                                                                    <td>{{ $d->detalle_servicio }}</td>
                                                                    <td class="text-end">
                                                                        ${{ number_format($d->valor_unitario, 0, ',', '.') }}
                                                                    </td>
                                                                    <td class="text-center">{{ $d->unidades }}</td>
                                                                    <td class="text-end fw-bold">
                                                                        ${{ number_format($d->total_linea, 0, ',', '.') }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="4" class="text-end fw-bold">Subtotal:</td>
                                                                <td class="text-end fw-bold">
                                                                    ${{ number_format($cot->subtotal, 0, ',', '.') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" class="text-end fw-bold">IVA (19%):
                                                                </td>
                                                                <td class="text-end fw-bold text-danger">
                                                                    ${{ number_format($cot->iva, 0, ',', '.') }}</td>
                                                            </tr>
                                                            <tr class="table-light">
                                                                <td colspan="4" class="text-end fw-bold fs-6">TOTAL:
                                                                </td>
                                                                <td class="text-end fw-bold fs-6 text-success">
                                                                    ${{ number_format($cot->total, 0, ',', '.') }}</td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>

                                                <div
                                                    class="d-flex justify-content-between align-items-center pt-2 border-top">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="small fw-bold">Cambiar Estado:</span>
                                                        <form method="POST"
                                                            action="{{ route('checkouts.cotizaciones.estado', $cot->id) }}"
                                                            class="d-inline">
                                                            @csrf
                                                            <select name="estado"
                                                                class="form-select form-select-sm {{ $cot->estado == 'autorizada' ? 'border-success text-success fw-bold' : 'border-warning text-dark' }}"
                                                                onchange="this.form.submit()">
                                                                <option value="pendiente"
                                                                    {{ $cot->estado == 'pendiente' ? 'selected' : '' }}>
                                                                    Pendiente</option>
                                                                <option value="autorizada"
                                                                    {{ $cot->estado == 'autorizada' ? 'selected' : '' }}>
                                                                    Autorizada</option>
                                                            </select>
                                                        </form>
                                                    </div>

                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('checkouts.cotizaciones.pdf', $cot->id) }}"
                                                            class="btn btn-sm btn-danger">
                                                            📄 Descargar PDF
                                                        </a>
                                                        <form
                                                            action="{{ route('checkouts.cotizaciones.destroy', $cot->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('¿Deseas eliminar permanentemente esta cotización?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-outline-danger"
                                                                title="Eliminar">🗑 Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-light text-center border py-4 text-muted">
                                No existen cotizaciones registradas para este Check-Out.
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL OC / FACTURA --}}
        <div class="modal fade" id="modalDocs{{ $c->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('checkouts.documentos', $c->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-white">
                            <h5 class="modal-title">📄 OC / Factura - Check-Out #{{ $c->id }}</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">N° OC</label>
                                <input type="text" name="nro_oc" class="form-control" value="{{ $c->nro_oc }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">PDF OC</label>
                                <input type="file" name="pdf_oc" class="form-control">
                                @if ($c->pdf_oc)
                                    <a href="{{ asset('checkout/' . $c->pdf_oc) }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary mt-2 w-100">
                                        Ver OC actual
                                    </a>
                                @endif
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label class="form-label">N° Factura</label>
                                <input type="text" name="nro_factura" class="form-control"
                                    value="{{ $c->nro_factura }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">PDF Factura</label>
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
                            <button class="btn btn-success w-100">💾 Guardar Documentos</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <script>
        document.getElementById('buscadorEdificio').addEventListener('keyup', function() {
            let filtro = this.value.toLowerCase().trim();
            document.querySelectorAll('#listaEdificios .chip').forEach(el => {
                let nombre = el.dataset.nombre || '';
                if (filtro === '') {
                    el.style.display = 'flex';
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
