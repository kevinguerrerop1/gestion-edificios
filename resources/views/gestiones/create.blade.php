@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h4 class="mb-0">
                            🛠 Nueva Solicitud de Arreglo
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('gestiones.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">🏢 Departamento</label>
                                <input type="text" name="departamento" class="form-control" placeholder="Ej: 502B" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">📌 Título del problema</label>
                                <input type="text" name="titulo" class="form-control" placeholder="Ej: Fuga de agua en el baño" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">👤 Nombre de contacto</label>
                                    <input type="text" name="nombre_contacto" class="form-control" placeholder="Nombre completo" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">📱 Teléfono</label>
                                    <input type="text" name="telefono_contacto" class="form-control" placeholder="+56 9 XXXXXXXX" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">📩 Correo electrónico</label>
                                <input type="email" name="email_contacto" class="form-control" placeholder="correo@ejemplo.com" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">📝 Descripción del problema</label>
                                <textarea name="descripcion" class="form-control" rows="4" placeholder="Describe el problema con detalle..." required></textarea>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-success btn-lg px-5">
                                    Guardar Solicitud
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-muted text-center small py-2">
                        Sistema de Mantenciones – Edificio
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
