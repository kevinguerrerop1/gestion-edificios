@extends('layouts.app')

@section('content')
    <div class="container py-4" style="max-width: 860px;">

        {{-- HEADER --}}
        <div class="d-flex align-items-center mb-4">
            <i class="bi bi-clipboard-plus fs-3 me-2 text-primary"></i>
            <div>
                <h4 class="mb-0 fw-bold">Nuevo Check-Out</h4>
                <small class="text-muted">Complete los datos para registrar un nuevo check-out</small>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('checkouts.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- SECCIÓN 1: DATOS GENERALES --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white fw-semibold">
                    <i class="bi bi-info-circle me-2"></i> Datos Generales
                </div>
                <div class="card-body">

                    <div class="row g-3">

                        {{-- EDIFICIO --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Edificio</label>
                            <select name="edificio_id" class="form-select">
                                <option value="">— Seleccione un edificio —</option>
                                @foreach ($edificios as $e)
                                    <option value="{{ $e->id }}"
                                        {{ old('edificio_id') == $e->id ? 'selected' : '' }}>
                                        {{ $e->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- TECNICO --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Técnico</label>
                            <select name="tecnico_id" class="form-select">
                                @foreach ($tecnicos as $t)
                                    <option value="{{ $t->id }}"
                                        {{ old('tecnico_id', 1) == $t->id ? 'selected' : '' }}>
                                        {{ $t->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- BLOQUE --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Bloque</label>
                            <input type="text" name="bloque" class="form-control"
                                placeholder="Ej: Bloque A" value="{{ old('bloque') }}">
                        </div>

                        {{-- FECHAS --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Fecha Inicio</label>
                            <input type="date" name="fecha_inicio" class="form-control"
                                value="{{ old('fecha_inicio') }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Fecha Término</label>
                            <input type="date" name="fecha_termino" class="form-control"
                                value="{{ old('fecha_termino') }}">
                        </div>

                        {{-- 🔥 NUEVO CAMPO --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Monto Neto</label>
                            <input type="number" name="monto_neto" step="1" min="0"
                                class="form-control @error('monto_neto') is-invalid @enderror"
                                placeholder="Ej: 150000"
                                value="{{ old('monto_neto') }}">

                            @error('monto_neto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                </div>
            </div>

            {{-- SECCIÓN DOCUMENTOS --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white fw-semibold">
                    <i class="bi bi-file-earmark-pdf me-2"></i> Documentos PDF
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">PDF Solicitud</label>
                            <input type="file" name="pdf_solicitud" class="form-control" accept=".pdf">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">PDF Entrega</label>
                            <input type="file" name="pdf_entrega" class="form-control" accept=".pdf">
                        </div>
                    </div>
                </div>
            </div>

            {{-- BOTONES --}}
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('checkouts.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-1"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-1"></i> Guardar Check-Out
                </button>
            </div>

        </form>

    </div>
@endsection
