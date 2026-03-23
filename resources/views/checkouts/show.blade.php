@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width: 860px;">

    {{-- HEADER --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center">
            <i class="bi bi-clipboard-check fs-3 me-2 text-primary"></i>
            <div>
                <h4 class="mb-0 fw-bold">Check-Out #{{ $checkout->id }}</h4>
                <small class="text-muted">Detalle completo del check-out</small>
            </div>
        </div>
        <a href="{{ route('checkouts.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Volver
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- INFO GENERAL --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white fw-semibold">
            <i class="bi bi-info-circle me-2"></i> Información General
        </div>
        <div class="card-body">
            <div class="row g-3">

                <div class="col-md-4">
                    <label class="text-muted small">Edificio</label>
                    <p class="fw-semibold mb-0">
                        <i class="bi bi-building me-1 text-primary"></i>
                        {{ $checkout->edificio->nombre ?? 'Sin edificio' }}
                    </p>
                </div>

                <div class="col-md-4">
                    <label class="text-muted small">Técnico</label>
                    <form method="POST" action="{{ route('checkouts.update', $checkout->id) }}" class="d-flex gap-2 mt-1">
                        @csrf
                        @method('PUT')
                        <select name="tecnico_id" class="form-select form-select-sm">
                            @foreach($tecnicos as $t)
                                <option value="{{ $t->id }}" {{ $checkout->tecnico_id == $t->id ? 'selected' : '' }}>
                                    {{ $t->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm" title="Guardar técnico">
                            <i class="bi bi-check-lg"></i>
                        </button>
                    </form>
                </div>

                <div class="col-md-4">
                    <label class="text-muted small">Bloque</label>
                    <p class="fw-semibold mb-0">
                        <i class="bi bi-geo-alt me-1 text-primary"></i>
                        {{ $checkout->bloque }}
                    </p>
                </div>

                <div class="col-md-6">
                    <label class="text-muted small">Fecha Inicio</label>
                    <p class="fw-semibold mb-0">
                        <i class="bi bi-calendar-event me-1 text-primary"></i>
                        {{ \Carbon\Carbon::parse($checkout->fecha_inicio)->format('d-m-Y') }}
                    </p>
                </div>

                <div class="col-md-6">
                    <label class="text-muted small">Fecha Término</label>
                    <p class="fw-semibold mb-0">
                        <i class="bi bi-calendar-check me-1 text-primary"></i>
                        {{ \Carbon\Carbon::parse($checkout->fecha_termino)->format('d-m-Y') }}
                    </p>
                </div>

            </div>
        </div>
    </div>

    {{-- ARTÍCULOS --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white fw-semibold">
            <i class="bi bi-box-seam me-2"></i> Artículos Utilizados
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Artículo</th>
                        <th class="text-center" style="width: 120px;">Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($checkout->detalles as $d)
                        <tr>
                            <td>{{ $d->articulo->nombre ?? 'N/A' }}</td>
                            <td class="text-center">{{ $d->cantidad }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted py-3">
                                <i class="bi bi-inbox me-1"></i> No hay artículos registrados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- AGREGAR ARTÍCULOS --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white fw-semibold">
            <i class="bi bi-plus-circle me-2"></i> Agregar Más Artículos
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('checkouts.agregarArticulos', $checkout->id) }}">
                @csrf

                <button type="button" class="btn btn-outline-primary mb-3"
                        data-bs-toggle="modal" data-bs-target="#modalArticulos">
                    <i class="bi bi-tags me-1"></i> Seleccionar artículos
                </button>

                <div id="tablaArticulosNuevos" class="mb-3"></div>
                <div id="inputsArticulosNuevos"></div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-1"></i> Guardar artículos
                </button>

            </form>
        </div>
    </div>

    {{-- DOCUMENTOS --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white fw-semibold">
            <i class="bi bi-file-earmark-pdf me-2"></i> Documentos
        </div>
        <div class="card-body d-flex gap-3">

            @if($checkout->pdf_solicitud)
                <a href="{{ asset('checkout/'.$checkout->pdf_solicitud) }}" target="_blank"
                   class="btn btn-outline-primary">
                    <i class="bi bi-file-earmark-text me-1"></i> Ver Solicitud
                </a>
            @else
                <span class="text-muted"><i class="bi bi-file-earmark-x me-1"></i> Sin PDF de solicitud</span>
            @endif

            @if($checkout->pdf_entrega)
                <a href="{{ asset('checkout/'.$checkout->pdf_entrega) }}" target="_blank"
                   class="btn btn-outline-success">
                    <i class="bi bi-file-earmark-check me-1"></i> Ver Entrega
                </a>
            @else
                <span class="text-muted"><i class="bi bi-file-earmark-x me-1"></i> Sin PDF de entrega</span>
            @endif

        </div>
    </div>

</div>

@include('checkouts.modal_articulos')
@endsection


<script>
document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('btnGuardarArticulos')
        .addEventListener('click', function () {

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

function renderTabla(articulos) {
    const tabla = document.getElementById('tablaArticulosNuevos');
    tabla.innerHTML = '';

    if (articulos.length === 0) return;

    let html = `<table class="table table-bordered table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>Artículo</th>
                            <th class="text-center" style="width:120px">Cantidad</th>
                        </tr>
                    </thead><tbody>`;

    articulos.forEach(a => {
        html += `<tr><td>${a.nombre}</td><td class="text-center">${a.cantidad}</td></tr>`;
    });

    html += '</tbody></table>';
    tabla.innerHTML = html;
}

function generarInputs(articulos) {
    const contenedor = document.getElementById('inputsArticulosNuevos');
    contenedor.innerHTML = '';

    articulos.forEach((a, index) => {
        contenedor.innerHTML += `
            <input type="hidden" name="articulos[${index}][id]" value="${a.id}">
            <input type="hidden" name="articulos[${index}][cantidad]" value="${a.cantidad}">`;
    });
}
</script>

