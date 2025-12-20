@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">📅 Agendar visita</h5>
                </div>

                <div class="card-body">
                    <p class="mb-3">
                        Asociado a la Gestión
                        <span class="fw-bold text-primary">#{{ $gestion->id }}</span>
                    </p>

                    <form action="{{ route('visitas.store', $gestion->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Fecha de visita</label>
                            <input type="date" name="fecha_visita" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Hora de visita</label>
                            <input type="time" name="hora_visita" class="form-control" required>
                        </div>

                        <button class="btn btn-success w-100">
                            💾 Guardar Visita
                        </button>
                    </form>
                </div>
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('gestiones.index') }}" class="btn btn-outline-secondary btn-sm">
                    ⬅ Volver al listado
                </a>
            </div>

        </div>
    </div>
</div>

@endsection
