@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <h4>📦 Reporte Checkouts</h4>

        <form method="GET" class="row g-2 mb-4">

            <div class="col-md-3">
                <select name="tecnico_id" class="form-control">
                    <option value="">Todos los técnicos</option>
                    @foreach ($tecnicos as $t)
                        <option value="{{ $t->id }}" {{ request('tecnico_id') == $t->id ? 'selected' : '' }}>
                            {{ $t->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select name="edificio_id" class="form-control">
                    <option value="">Todos los edificios</option>
                    @foreach ($edificios as $e)
                        <option value="{{ $e->id }}" {{ request('edificio_id') == $e->id ? 'selected' : '' }}>
                            {{ $e->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <input type="date" name="desde" value="{{ request('desde') }}" class="form-control">
            </div>

            <div class="col-md-2">
                <input type="date" name="hasta" value="{{ request('hasta') }}" class="form-control">
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100">Filtrar</button>
            </div>

        </form>

        {{-- EXPORT --}}
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

        {{-- TABLA --}}
        <table class="table table-bordered table-hover align-middle">

            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Edificio</th>
                    <th>Técnico</th>
                    <th>Dpto</th>
                    <th>Inicio</th>
                    <th>Término</th>
                    <th>Estado</th>
                    <th>OC</th>
                    <th>Factura</th>
                    <th>Monto</th>
                </tr>
            </thead>

            <tbody>

                @php $total = 0; @endphp

                @foreach ($checkouts as $c)
                    @php $total += $c->monto_neto ?? 0; @endphp

                    <tr>
                        <td class="text-center fw-bold">{{ $c->id }}</td>

                        <td>{{ $c->edificio->nombre ?? '-' }}</td>

                        <td>{{ $c->tecnico->nombre ?? '-' }}</td>

                        <td class="text-center">{{ $c->bloque ?? '-' }}</td>

                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($c->fecha_inicio)->format('d-m-Y') }}
                        </td>

                        <td class="text-center">
                            {{ $c->fecha_termino ? \Carbon\Carbon::parse($c->fecha_termino)->format('d-m-Y') : '-' }}
                        </td>

                        <td class="text-center">
                            <span
                                class="badge
                            @if ($c->estado == 'pendiente') bg-secondary
                            @elseif($c->estado == 'en_revision') bg-primary
                            @elseif($c->estado == 'con_reparos') bg-warning text-dark
                            @elseif($c->estado == 'finalizado') bg-success @endif">
                                {{ ucfirst(str_replace('_', ' ', $c->estado)) }}
                            </span>
                        </td>

                        <td class="text-center">{{ $c->nro_oc ?? '—' }}</td>

                        <td class="text-center">{{ $c->nro_factura ?? '—' }}</td>

                        <td class="text-end fw-bold text-success">
                            ${{ number_format($c->monto_neto ?? 0, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach

            </tbody>

            {{-- TOTAL --}}
            <tfoot>
                <tr class="table-light fw-bold">
                    <td colspan="9" class="text-end">TOTAL</td>
                    <td class="text-end text-success">
                        ${{ number_format($total, 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot>

        </table>

    </div>
@endsection
