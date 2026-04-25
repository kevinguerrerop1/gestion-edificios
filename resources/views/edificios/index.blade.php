@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">🏢 Edificios</h3>

        <a href="{{ route('edificios.create') }}" class="btn btn-primary">
            ➕ Nuevo edificio
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-4">
        <table id="tabla" class="table table-striped table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Ubicación</th>
                    <th>Color</th>
                    <th>Solicitudes</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse($edificios as $edificio)
                    <tr>
                        <td class="text-center">{{ $edificio->id }}</td>

                        {{-- NOMBRE CON COLOR --}}
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span style="
                                    width:12px;
                                    height:12px;
                                    border-radius:50%;
                                    display:inline-block;
                                    background: {{ $edificio->color ?? '#6c757d' }};
                                "></span>

                                <strong>{{ $edificio->nombre }}</strong>
                            </div>
                        </td>

                        <td>{{ $edificio->direccion ?? '—' }}</td>

                        <td>
                            {{ $edificio->comuna ?? '—' }}
                        </td>

                        {{-- COLOR VISUAL --}}
                        <td class="text-center">
                            <div class="d-flex flex-column align-items-center gap-1">

                                <div style="
                                    width:30px;
                                    height:30px;
                                    border-radius:6px;
                                    background: {{ $edificio->color ?? '#6c757d' }};
                                    border:1px solid #ccc;
                                "></div>

                                <small class="text-muted">
                                    {{ $edificio->color ?? '#6c757d' }}
                                </small>

                            </div>
                        </td>

                        <td class="text-center">
                            <span class="badge bg-secondary">
                                {{ $edificio->gestiones_count ?? 0 }}
                            </span>
                        </td>

                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-1 flex-wrap">

                                <a href="{{ route('edificios.edit', $edificio->id) }}"
                                    class="btn btn-sm btn-outline-warning">
                                    ✏️
                                </a>

                                <a href="{{ route('gestiones.nueva', $edificio->id) }}"
                                    class="btn btn-sm btn-outline-success">
                                    ➕
                                </a>

                                <a href="{{ route('edificios.qr', $edificio->id) }}"
                                    class="btn btn-sm btn-outline-dark">
                                    📱
                                </a>

                                <a href="{{ route('edificios.qr.imprimir', $edificio->id) }}"
                                    class="btn btn-sm btn-danger" target="_blank">
                                    🖨
                                </a>

                                <a href="{{ route('gestiones.por_edificio', $edificio->id) }}"
                                    class="btn btn-sm btn-primary">
                                    👁
                                </a>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            No hay edificios registrados
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
