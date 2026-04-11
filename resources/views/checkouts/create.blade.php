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
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Edificio</label>
                            <select name="edificio_id" class="form-select @error('edificio_id') is-invalid @enderror">
                                <option value="">— Seleccione un edificio —</option>
                                @foreach ($edificios as $e)
                                    <option value="{{ $e->id }}"
                                        {{ old('edificio_id') == $e->id ? 'selected' : '' }}>
                                        {{ $e->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('edificio_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

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
                            @error('tecnico_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Bloque</label>
                            <input type="text" name="bloque" class="form-control @error('bloque') is-invalid @enderror"
                                placeholder="Ej: Bloque A" value="{{ old('bloque') }}">
                            @error('bloque')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

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
                    </div>

                </div>
            </div>

            {{-- SECCIÓN 2: ARTÍCULOS --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white fw-semibold">
                    <i class="bi bi-tags me-2"></i> Artículos
                </div>
                <div class="card-body">

                    <button type="button" class="btn btn-outline-primary mb-3" data-bs-toggle="modal"
                        data-bs-target="#modalArticulos">
                        <i class="bi bi-plus-circle me-1"></i> Agregar artículos
                    </button>

                    <table class="table table-bordered table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>Artículo</th>
                                <th class="text-center" style="width: 120px;">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody id="tablaArticulos">
                            <tr>
                                <td colspan="2" class="text-center text-muted py-3">
                                    <i class="bi bi-inbox me-1"></i> No hay artículos seleccionados
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div id="inputsArticulos"></div>

                </div>
            </div>

            {{-- SECCIÓN 3: DOCUMENTOS --}}
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

        @include('checkouts.modal_articulos')

    </div>
@endsection

{{-- 🔥 SCRIPT COMPLETO --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('btnGuardarArticulos')
            .addEventListener('click', function() {

                let articulosSeleccionados = [];

                document.querySelectorAll('.cantidad').forEach(input => {

                    let cantidad = parseInt(input.value);

                    if (cantidad > 0) {
                        articulosSeleccionados.push({
                            id: input.dataset.id,
                            nombre: input.dataset.nombre,
                            cantidad: cantidad
                        });
                    }

                });

                renderTabla(articulosSeleccionados);
                generarInputs(articulosSeleccionados);

            });

    });


    // 🔥 TABLA
    function renderTabla(articulos) {

        const tabla = document.getElementById('tablaArticulos');
        tabla.innerHTML = '';

        if (articulos.length === 0) {
            tabla.innerHTML = `
            <tr>
                <td colspan="2" class="text-center text-muted">
                    No hay artículos seleccionados
                </td>
            </tr>
        `;
            return;
        }

        articulos.forEach(a => {
            tabla.innerHTML += `
            <tr>
                <td>${a.nombre}</td>
                <td>${a.cantidad}</td>
            </tr>
        `;
        });

    }


    // 🔥 INPUTS PARA BACKEND
    function generarInputs(articulos) {

        const contenedor = document.getElementById('inputsArticulos');
        contenedor.innerHTML = '';

        articulos.forEach((a, index) => {

            contenedor.innerHTML += `
            <input type="hidden" name="articulos[${index}][id]" value="${a.id}">
            <input type="hidden" name="articulos[${index}][cantidad]" value="${a.cantidad}">
        `;

        });

    }
</script>
