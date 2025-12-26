@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold">Crear cuenta</h3>
                            <p class="text-muted small mb-0">Complete los datos para registrarse</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            {{-- Nombre --}}
                            <div class="mb-3">
                                <label class="form-label small text-muted">Nombre</label>
                                <input type="text"
                                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                                        name="name"
                                        value="{{ old('name') }}"
                                        placeholder="Nombre completo"
                                        required
                                        autofocus>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="mb-3">
                                <label class="form-label small text-muted">Correo electrónico</label>
                                <input type="email"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="usuario@empresa.cl"
                                        required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="mb-3">
                                <label class="form-label small text-muted">Contraseña</label>
                                <input type="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        name="password"
                                        placeholder="••••••••"
                                        required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Confirmar Password --}}
                            <div class="mb-4">
                                <label class="form-label small text-muted">Confirmar contraseña</label>
                                <input type="password"
                                        class="form-control form-control-lg"
                                        name="password_confirmation"
                                        placeholder="••••••••"
                                        required>
                            </div>

                            {{-- Botón --}}
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Registrarse
                                </button>
                            </div>
                        </form>

                        <p class="text-center text-muted small mt-3">
                            © {{ date('Y') }} Empresa / Sistema Interno
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
