@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">🏢 Edificios</h3>

        <a href="{{ route('edificios.create') }}" class="btn btn-primary">
            ➕ Nuevo edificio
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-4">
            <table id="tabla" class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Ubicacion</th>
                        <th>Solicitudes</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($edificios as $edificio)
                        <tr>
                            <td>{{ $edificio->id }}</td>

                            <td>
                                <strong>{{ $edificio->nombre }}</strong>
                            </td>

                            <td>{{ $edificio->direccion ?? '—' }}</td>

                            <td>
                                {{ $edificio->comuna ?? '—' }}
                            </td>

                            <td>
                                <span class="badge bg-secondary">
                                    {{ $edificio->gestiones_count ?? 0 }}
                                </span>
                            </td>

                            <td class="text-end">
                                <!--a href="{{ route('edificios.show', $edificio->id) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    Ver
                                </a-->

                                <!--a href="{{ route('edificios.edit', $edificio->id) }}"
                                    class="btn btn-sm btn-outline-warning">
                                    Editar
                                </a-->

                                <a href="{{ route('gestiones.nueva', $edificio->id) }}"
                                    class="btn btn-sm btn-outline-success">
                                    Solicitud
                                </a>

                                <a href="{{ route('edificios.qr', $edificio->id) }}"
                                    class="btn btn-sm btn-outline-dark">
                                    📱 QR
                                </a>

                                <a href="{{ route('edificios.qr.imprimir', $edificio->id) }}"
                                    class="btn btn-sm btn-danger"
                                    target="_blank">
                                    🖨 Imprimir QR
                                </a>
                                <a href="{{ route('gestiones.por_edificio', $edificio->id) }}"
                                    class="btn btn-primary btn-sm">
                                    🏢 Ver edificio
                                </a>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No hay edificios registrados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection


