@extends('layouts.app')

@section('content')
    <div class="container py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center">
                <i class="bi bi-trash fs-3 me-2 text-dark"></i>
                <div>
                    <h4 class="mb-0 fw-bold">Papelera de Check-Outs</h4>
                    <small class="text-muted">Registros eliminados (puedes restaurarlos)</small>
                </div>
            </div>

            <a href="{{ route('checkouts.index') }}" class="btn btn-outline-secondary">
                ← Volver
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">

                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>#</th>
                            <th>Edificio</th>
                            <th>Técnico</th>
                            <th>Bloque</th>
                            <th>Monto</th>
                            <th>Eliminado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($checkouts as $c)
                            <tr>
                                <td class="text-center fw-bold">{{ $c->id }}</td>

                                <td>{{ $c->edificio->nombre ?? '-' }}</td>

                                <td>{{ $c->tecnico->nombre ?? '-' }}</td>

                                <td class="text-center">{{ $c->bloque }}</td>

                                <td class="text-end">
                                    ${{ number_format($c->monto_neto, 0, ',', '.') }}
                                </td>

                                <td class="text-center text-muted">
                                    {{ $c->deleted_at->format('d-m-Y H:i') }}
                                </td>

                                <td>
                                    <div class="d-flex flex-column gap-1">

                                        {{-- RESTAURAR --}}
                                        <form method="POST" action="{{ route('checkouts.restaurar', $c->id) }}">
                                            @csrf
                                            <button class="btn btn-sm btn-success w-100">
                                                ♻️ Restaurar
                                            </button>
                                        </form>

                                        {{-- ELIMINAR DEFINITIVO --}}
                                        <form method="POST" action="{{ route('checkouts.forceDelete', $c->id) }}"
                                            onsubmit="return confirm('Esto eliminará el registro PERMANENTEMENTE')">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-sm btn-danger w-100">
                                                ❌ Eliminar definitivo
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    🗂 No hay registros en la papelera
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>
        </div>

    </div>
@endsection
