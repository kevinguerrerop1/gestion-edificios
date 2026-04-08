@extends('layouts.app')

@section('content')
    <div class="container">

        <h3 class="mb-4">📊 Reporte general de gestiones</h3>

        {{-- Filtros --}}
        <form method="GET" class="row g-3 mb-4">

            <div class="col-md-3">
                <label class="form-label">Desde</label>
                <input type="date" name="desde" value="{{ request('desde') }}" class="form-control" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Hasta</label>
                <input type="date" name="hasta" value="{{ request('hasta') }}" class="form-control" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Edificio</label>
                <select name="edificio_id" class="form-select">
                    <option value="">-- Todos los edificios --</option>

                    @foreach ($edificios as $e)
                        <option value="{{ $e->id }}" {{ request('edificio_id') == $e->id ? 'selected' : '' }}>
                            {{ $e->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-select">
                    <option value="">Todos</option>
                    @foreach (['pendiente', 'pagado', 'en_proceso', 'finalizada'] as $estado)
                        <option value="{{ $estado }}" @selected(request('estado') == $estado)>
                            {{ ucfirst(str_replace('_', ' ', $estado)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-12 text-end">
                <button class="btn btn-primary">
                    🔍 Filtrar
                </button>

                @if ($gestiones->count())
                    <a href="{{ route('reportes.maestro_pdf', request()->all()) }}" class="btn btn-danger">
                        📄 PDF
                    </a>
                @endif
            </div>

        </form>

        {{-- Resultados --}}
        @if ($gestiones->count())
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Edificio</th>
                            <th>Estado</th>
                            <th>Fecha creación</th>
                            <th>Última actualización</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($gestiones as $g)
                            <tr>
                                <td>{{ $g->id }}</td>
                                <td>{{ $g->edificio->nombre ?? '-' }}</td>
                                <td>
                                    <span
                                        class="badge
                                    @if ($g->estado === 'pendiente') bg-warning
                                    @elseif($g->estado === 'pagado') bg-success
                                    @elseif($g->estado === 'en_proceso') bg-info
                                    @elseif($g->estado === 'finalizada') bg-danger
                                    @else bg-secondary @endif">
                                        {{ ucfirst(str_replace('_', ' ', $g->estado)) }}
                                    </span>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($g->created_at)->format('d-m-Y') }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($g->updated_at)->format('d-m-Y H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        @else
            <div class="alert alert-info">
                No hay resultados para los filtros seleccionados.
            </div>
        @endif

    </div>
@endsection
