@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">

                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-shield-lock-fill fs-3 text-primary me-2"></i>
                    <div>
                        <h4 class="mb-0 fw-bold">Seguridad de la Cuenta</h4>
                        <small class="text-muted">Actualiza tu contraseña de acceso</small>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success d-flex align-items-center gap-2 alert-dismissible fade show"
                        role="alert">
                        <i class="bi bi-check-circle-fill"></i>
                        <div>{{ session('success') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('usuarios.password.update') }}">
                            @csrf
                            @method('PUT')

                            {{-- Clave actual --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">Contraseña Actual</label>
                                <input type="password" name="current_password"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    placeholder="••••••••" required autofocus>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-3 text-muted">

                            {{-- Nueva clave --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">Nueva Contraseña</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Mínimo 6 caracteres" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Confirmación nueva clave --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold small">Confirmar Nueva Contraseña</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Repite la nueva contraseña" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                                <i class="bi bi-key-fill me-1"></i> Actualizar Contraseña
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
