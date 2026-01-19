@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">
        📄 Gestiones finalizadas por edificio
    </h4>
    <form method="GET" action="{{ route('reportes.gestiones_finalizadas') }}">
        @if(request()->filled(['edificio_id','desde','hasta']))
            <div class="mb-3 text-end">
                <a href="{{ route('reportes.gestiones_finalizadas.pdf', request()->all()) }}"class="btn btn-outline-danger">
                    📄 Descargar PDF
                </a>
            </div>
        @endif
        <!-- FILTROS -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Edificio</label>
                        <select name="edificio_id" class="form-select" required>
                            <option value="">Seleccione edificio</option>
                            @foreach($edificios as $edificio)
                                <option value="{{ $edificio->id }}"
                                    {{ request('edificio_id') == $edificio->id ? 'selected' : '' }}>
                                    {{ $edificio->nombre }} – {{ $edificio->direccion }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Desde</label>
                        <input type="date" name="desde" class="form-control"value="{{ request('desde') }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Hasta</label>
                        <input type="date" name="hasta" class="form-control"value="{{ request('hasta') }}" required>
                    </div>
                    <div class="col-md-2 d-grid">
                        <button class="btn btn-primary">
                            Generar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- RESULTADO -->
    @if($gestiones->count())
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <strong>
                    {{ $edificioSeleccionado->nombre }}
                </strong>
                <span class="text-muted small">
                    ({{ $gestiones->count() }} gestiones)
                </span>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Departamento</th>
                            <th>Contacto</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gestiones as $g)
                            <tr>
                                <td>{{ $g->id }}</td>
                                <td>{{ $g->departamento }}</td>
                                <td>{{ $g->nombre_contacto }}</td>
                                <td>
                                    {{ $g->created_at->format('d-m-Y H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @elseif(request()->all())
        <div class="alert alert-warning">
            No se encontraron gestiones finalizadas para los filtros seleccionados.
        </div>
    @endif
</div>
@endsection
