@extends('layouts.app')

@section('content')
    <div class="container">

        <h3 class="mb-3">👨‍🔧 Mantenedor de Técnicos</h3>

        {{-- MENSAJE --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- CREAR --}}
        <form method="POST" action="{{ route('tecnicos.store') }}" class="row g-2 mb-3">
            @csrf

            <div class="col-md-3">
                <input name="nombre" class="form-control" placeholder="Nombre del técnico" required>
            </div>

            <div class="col-md-3">
                <input name="email" class="form-control" placeholder="Email (opcional)">
            </div>

            <div class="col-md-2">
                <input name="rut" class="form-control" placeholder="RUT" required>
            </div>

            <div class="col-md-2">
                <input name="telefono" class="form-control" placeholder="Teléfono">
            </div>

            <div class="col-md-2">
                <button class="btn btn-success w-100">➕ Agregar</button>
            </div>

        </form>

        {{-- BUSCADOR --}}
        <input type="text" id="buscador" class="form-control mb-3" placeholder="🔍 Buscar técnico...">

        {{-- TABLA --}}
        <table class="table table-bordered table-hover align-middle" id="tabla">
            <thead class="table-light">
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>RUT</th>
                    <th>Teléfono</th>
                    <th>Estado</th>
                    <th style="width: 250px;">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($tecnicos as $t)
                    <tr class="fila">

                        <td>{{ $t->nombre }}</td>

                        <td>{{ $t->email ?? '-' }}</td>

                        <td>{{ $t->rut }}</td>

                        <td>{{ $t->telefono ?? '-' }}</td>

                        <td>
                            @if ($t->activo)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-secondary">Inactivo</span>
                            @endif
                        </td>

                        <td class="d-flex gap-1">

                            {{-- CAMBIAR ESTADO --}}
                            <form method="POST" action="{{ route('tecnicos.toggle', $t->id) }}">
                                @csrf
                                <button class="btn btn-warning btn-sm">🔄</button>
                            </form>

                            {{-- ELIMINAR --}}
                            <form method="POST" action="{{ route('tecnicos.destroy', $t->id) }}"
                                onsubmit="return confirm('¿Eliminar técnico?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">🗑</button>
                            </form>

                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    {{-- BUSCADOR JS --}}
    <script>
        document.getElementById('buscador').addEventListener('keyup', function() {
            let f = this.value.toLowerCase();

            document.querySelectorAll('.fila').forEach(tr => {
                tr.style.display = tr.innerText.toLowerCase().includes(f) ? '' : 'none';
            });
        });
    </script>
@endsection
