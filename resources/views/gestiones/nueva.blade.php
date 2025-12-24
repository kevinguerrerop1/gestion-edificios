@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="container mt-4">
                        <div class="row justify-content-center">
                            <div class="col-md-7">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-success text-white text-center">
                                        <h4 class="mb-0">🛠 Nueva Solicitud de Arreglo</h4>
                                    </div>
                                    @if(session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif
                                    <div class="card-body">
                                        <p class="text-muted text-center">
                                            Por favor completa la información y nos pondremos en contacto.
                                        </p>
                                        <form action="{{ route('gestiones.nuevastore') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label">Departamento</label>
                                                <input type="text" name="departamento" class="form-control"
                                                        placeholder="Ej: Torre B, Dpto 302" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Título del problema</label>
                                                <input type="text" name="titulo" class="form-control"
                                                        placeholder="Ej: Fuga de agua" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nombre de contacto</label>
                                                <input type="text" name="nombre_contacto" class="form-control"
                                                        placeholder="Tu nombre completo" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Teléfono</label>
                                                <input type="tel" name="telefono_contacto" class="form-control"
                                                        placeholder="Ej: +569 1234 5678" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Correo</label>
                                                <input type="email" name="email_contacto" class="form-control"
                                                        placeholder="Ej: correo@ejemplo.com" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Descripción del problema</label>
                                                <textarea name="descripcion" rows="4" class="form-control"
                                                        placeholder="Describe el inconveniente brevemente" required></textarea>
                                            </div>
                                            <button class="btn btn-success w-100">
                                                📩 Enviar solicitud
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <p class="text-center mt-3 text-muted" style="font-size: 0.9rem;">
                                    🏢 Servicio interno del edificio
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center small py-2">
                        Sistema de Mantenciones – Edificio
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
