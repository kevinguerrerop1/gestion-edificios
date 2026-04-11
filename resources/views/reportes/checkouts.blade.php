@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <h4>📦 Reporte Checkouts</h4>

        <form method="GET" class="row g-2 mb-4">

            <div class="col-md-3">
                <select name="tecnico_id" class="form-control">
                    <option value="">Todos los técnicos</option>
                    @foreach ($tecnicos as $t)
                        <option value="{{ $t->id }}">{{ $t->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select name="edificio_id" class="form-control">
                    <option value="">Todos los edificios</option>
                    @foreach ($edificios as $e)
                        <option value="{{ $e->id }}">{{ $e->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <input type="date" name="desde" class="form-control">
            </div>

            <div class="col-md-2">
                <input type="date" name="hasta" class="form-control">
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100">Filtrar</button>
            </div>

        </form>
        <div class="mb-3 d-flex gap-2">

            <a href="{{ request()->filled(['desde', 'hasta']) ? route('reportes.checkouts.pdf', request()->all()) : '#' }}"
                class="btn btn-danger {{ request()->filled(['desde', 'hasta']) ? '' : 'disabled' }}">
                📄 Exportar PDF
            </a>

            <a href="{{ request()->filled(['desde', 'hasta']) ? route('reportes.checkouts.excel', request()->all()) : '#' }}"
                class="btn btn-success {{ request()->filled(['desde', 'hasta']) ? '' : 'disabled' }}">
                📊 Exportar Excel
            </a>

        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Edificio</th>
                    <th>Técnico</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>OC</th>
                    <th>Factura</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($checkouts as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->edificio->nombre ?? '-' }}</td>
                        <td>{{ $c->tecnico->nombre ?? '-' }}</td>
                        <td>{{ $c->fecha_inicio }}</td>
                        <td>{{ $c->estado }}</td>
                        <td>{{ $c->nro_oc }}</td>
                        <td>{{ $c->nro_factura }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
