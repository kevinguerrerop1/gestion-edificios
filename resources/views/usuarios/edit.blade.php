@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0 fw-bold">Editar Usuario: {{ $usuario->name }}</h4>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary btn-sm">
                        ← Volver
                    </a>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label fw-semibold small">Nombre y Apellido</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $usuario->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold small">Correo Electrónico</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $usuario->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold small">Rol en el Sistema</label>
                                <select name="rol" class="form-select @error('rol') is-invalid @enderror" required>
                                    <option value="supervisor"
                                        {{ old('rol', $usuario->rol ?? '') == 'supervisor' ? 'selected' : '' }}>
                                        Supervisor(a) (Solo visualiza datos operativos y sube Check-Out Terreno)
                                    </option>
                                    <option value="admin"
                                        {{ old('rol', $usuario->rol ?? '') == 'admin' ? 'selected' : '' }}>
                                        Administrador (Control total, finanzas, facturas y usuarios)
                                    </option>
                                </select>
                                @error('rol')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <hr class="my-4">
                            <small class="text-muted d-block mb-3">Si no deseas cambiar la contraseña, deja estos dos campos
                                vacíos.</small>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Nueva Contraseña</label>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Confirmar Contraseña</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                                <i class="bi bi-save me-1"></i> Actualizar Usuario
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
