@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-people-fill fs-3 text-primary"></i>
                <div>
                    <h4 class="mb-0 fw-bold">Mantenedor de Usuarios</h4>
                    <small class="text-muted">Control de acceso y asignación de roles</small>
                </div>
            </div>
            <a href="{{ route('usuarios.create') }}" class="btn btn-success">
                <i class="bi bi-person-plus-fill me-1"></i> Nuevo Usuario
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 5%;" class="text-center">#</th>
                                <th style="width: 30%;">Nombre</th>
                                <th style="width: 30%;">Correo Electrónico</th>
                                <th style="width: 15%;" class="text-center">Rol</th>
                                <th style="width: 20%;" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $u)
                                {{-- Ocultar cuenta master --}}
                                @if ($u->email === 'kevinguerrerop1@gmail.com')
                                    @continue
                                @endif
                                <tr>
                                    <td class="text-center fw-bold text-muted">{{ $u->id }}</td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $u->name }}</div>
                                        @if ($u->id === auth()->id())
                                            <span class="badge bg-secondary-subtle text-secondary"
                                                style="font-size: 10px;">Tu sesión actual</span>
                                        @endif
                                    </td>
                                    <td>{{ $u->email }}</td>
                                    <td class="text-center">
                                        @if ($u->rol === 'admin')
                                            <span class="badge bg-warning text-dark border px-2 py-1">
                                                <i class="bi bi-shield-check me-1"></i>Administrador
                                            </span>
                                        @else
                                            <span class="badge bg-info-subtle text-info border px-2 py-1">
                                                <i class="bi bi-person-badge me-1"></i>Supervisor(a)
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('usuarios.edit', $u->id) }}"
                                                class="btn btn-sm btn-outline-primary" title="Editar">
                                                <i class="bi bi-pencil-square"></i> Editar
                                            </a>

                                            @if ($u->id !== auth()->id())
                                                <form action="{{ route('usuarios.destroy', $u->id) }}" method="POST"
                                                    onsubmit="return confirm('¿Seguro que deseas eliminar permanentemente a este usuario?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
