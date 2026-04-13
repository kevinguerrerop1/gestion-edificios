@extends('layouts.app')

@section('content')
    <div class="container py-4" style="max-width: 900px;">

        {{-- HEADER --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <i class="bi bi-clipboard-check fs-3 me-2 text-primary"></i>
                <div>
                    <h4 class="mb-0 fw-bold">Check-Out #{{ $checkout->id }}</h4>
                    <small class="text-muted">Detalle completo del check-out</small>
                </div>
            </div>
            <a href="{{ route('checkouts.pdf', $checkout->id) }}" class="btn btn-danger">
                📄 Descargar PDF
            </a>
            <a href="{{ route('checkouts.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        {{-- ALERT --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- INFO GENERAL --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white fw-semibold">
                📋 Información General
            </div>

            <div class="card-body">
                <div class="row g-4">

                    <div class="col-md-4">
                        <small class="text-muted">Edificio</small>
                        <div class="fw-bold">{{ $checkout->edificio->nombre ?? '-' }}</div>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted">Técnico</small>
                        <div class="fw-bold">{{ $checkout->tecnico->nombre ?? 'Sin asignar' }}</div>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted">Bloque / Dpto</small>
                        <div class="fw-bold">{{ $checkout->bloque }}</div>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted">Fecha Inicio</small>
                        <div class="fw-bold">
                            {{ \Carbon\Carbon::parse($checkout->fecha_inicio)->format('d-m-Y') }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted">Fecha Término</small>
                        <div class="fw-bold">
                            {{ $checkout->fecha_termino ? \Carbon\Carbon::parse($checkout->fecha_termino)->format('d-m-Y') : '-' }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted">Estado</small>
                        <div>
                            <span class="badge bg-secondary">
                                {{ strtoupper($checkout->estado) }}
                            </span>
                        </div>
                    </div>

                    {{-- 💰 MONTO --}}
                    <div class="col-md-6">
                        <small class="text-muted">Monto Neto</small>
                        <div class="fw-bold fs-5 text-success">
                            $ {{ number_format($checkout->monto_neto, 0, ',', '.') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- DOCUMENTOS --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white fw-semibold">
                📄 Documentos
            </div>

            <div class="card-body">

                <div class="row g-3">

                    {{-- SOLICITUD --}}
                    <div class="col-md-6">
                        <small class="text-muted">PDF Solicitud</small><br>

                        @if ($checkout->pdf_solicitud)
                            <a href="{{ asset('checkout/' . $checkout->pdf_solicitud) }}" target="_blank"
                                class="btn btn-outline-primary w-100 mt-1">
                                📄 Ver Solicitud
                            </a>
                        @else
                            <div class="text-muted mt-1">No disponible</div>
                        @endif
                    </div>

                    {{-- ENTREGA --}}
                    <div class="col-md-6">
                        <small class="text-muted">PDF Entrega</small><br>

                        @if ($checkout->pdf_entrega)
                            <a href="{{ asset('checkout/' . $checkout->pdf_entrega) }}" target="_blank"
                                class="btn btn-outline-success w-100 mt-1">
                                📄 Ver Entrega
                            </a>
                        @else
                            <div class="text-muted mt-1">No disponible</div>
                        @endif
                    </div>

                </div>

                <hr>

                <div class="row g-3">

                    {{-- OC --}}
                    <div class="col-md-6">
                        <small class="text-muted">Orden de Compra</small>

                        <div class="fw-semibold">
                            {{ $checkout->nro_oc ?? '—' }}
                        </div>

                        @if ($checkout->pdf_oc)
                            <a href="{{ asset('checkout/' . $checkout->pdf_oc) }}" target="_blank"
                                class="btn btn-outline-primary w-100 mt-2">
                                📄 Ver OC
                            </a>
                        @endif
                    </div>

                    {{-- FACTURA --}}
                    <div class="col-md-6">
                        <small class="text-muted">Factura</small>

                        <div class="fw-semibold">
                            {{ $checkout->nro_factura ?? '—' }}
                        </div>

                        @if ($checkout->pdf_factura)
                            <a href="{{ asset('checkout/' . $checkout->pdf_factura) }}" target="_blank"
                                class="btn btn-outline-success w-100 mt-2">
                                🧾 Ver Factura
                            </a>
                        @endif
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
