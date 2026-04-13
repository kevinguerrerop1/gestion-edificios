@extends('layouts.app')

@section('content')
    <div class="container py-4" style="max-width: 900px;">

        {{-- 🔥 HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded-3 shadow-sm">
            <div class="d-flex align-items-center">
                <i class="bi bi-pencil-square fs-3 me-3 text-warning"></i>
                <div>
                    <h4 class="mb-0 fw-bold">Editar Check-Out #{{ $checkout->id }}</h4>
                    <small class="text-muted">Actualiza la información del registro</small>
                </div>
            </div>

            <span class="badge bg-warning text-dark px-3 py-2">
                ✏️ Edición
            </span>
        </div>

        <form method="POST" action="{{ route('checkouts.update', $checkout->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- 🔹 DATOS --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-light border-bottom fw-bold">
                    📋 Datos Generales
                </div>

                <div class="card-body">
                    <div class="row g-3">

                        {{-- EDIFICIO --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Edificio</label>
                            <select name="edificio_id" class="form-select shadow-sm" required>
                                @foreach ($edificios as $e)
                                    <option value="{{ $e->id }}"
                                        {{ $checkout->edificio_id == $e->id ? 'selected' : '' }}>
                                        {{ $e->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- TECNICO --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Técnico</label>
                            <select name="tecnico_id" class="form-select shadow-sm" required>
                                @foreach ($tecnicos as $t)
                                    <option value="{{ $t->id }}"
                                        {{ $checkout->tecnico_id == $t->id ? 'selected' : '' }}>
                                        {{ $t->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- BLOQUE --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Depto / Bloque</label>
                            <input type="text" name="bloque" class="form-control shadow-sm"
                                value="{{ $checkout->bloque }}">
                        </div>

                        {{-- FECHAS --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Fecha Inicio</label>
                            <input type="date" name="fecha_inicio" class="form-control shadow-sm"
                                value="{{ $checkout->fecha_inicio }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Fecha Término</label>
                            <input type="date" name="fecha_termino" class="form-control shadow-sm"
                                value="{{ $checkout->fecha_termino }}">
                        </div>

                        {{-- 💰 MONTO --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Monto Neto (CLP)</label>
                            <input type="number" name="monto_neto" class="form-control shadow-sm"
                                value="{{ $checkout->monto_neto }}" placeholder="Ej: 150000">
                        </div>

                    </div>
                </div>
            </div>

            {{-- 🔹 DOCUMENTOS --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-light border-bottom fw-bold">
                    📄 Documentos PDF
                </div>

                <div class="card-body">
                    <div class="row g-3">

                        {{-- SOLICITUD --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">PDF Solicitud</label>

                            @if ($checkout->pdf_solicitud)
                                <a href="{{ asset('checkout/' . $checkout->pdf_solicitud) }}" target="_blank"
                                    class="btn btn-light border w-100 mb-2">
                                    📄 Ver PDF actual
                                </a>
                            @endif

                            <input type="file" name="pdf_solicitud" class="form-control shadow-sm">
                        </div>

                        {{-- ENTREGA --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">PDF Entrega</label>

                            @if ($checkout->pdf_entrega)
                                <a href="{{ asset('checkout/' . $checkout->pdf_entrega) }}" target="_blank"
                                    class="btn btn-light border w-100 mb-2">
                                    📄 Ver PDF actual
                                </a>
                            @endif

                            <input type="file" name="pdf_entrega" class="form-control shadow-sm">
                        </div>

                    </div>
                </div>
            </div>

            {{-- 🔹 BOTONES --}}
            <div class="d-flex justify-content-between">

                <a href="{{ route('checkouts.index') }}" class="btn btn-light border px-4">
                    ← Volver
                </a>

                <button class="btn btn-warning px-4 shadow-sm">
                    💾 Guardar cambios
                </button>

            </div>

        </form>

    </div>
@endsection
