@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Bienvenido</h3>
                        <p class="text-muted small mb-0">Ingrese sus credenciales para acceder</p>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label small text-muted">Correo electrónico</label>
                            <input type="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="usuario@empresa.cl"
                                    required autofocus>
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
                        {{-- Remember --}}
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label small" for="remember">
                                    Recordarme
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="small text-decoration-none" href="{{ route('password.request') }}">
                                    ¿Olvidó su contraseña?
                                </a>
                            @endif
                        </div>
                        {{-- Button --}}
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Entrar
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
