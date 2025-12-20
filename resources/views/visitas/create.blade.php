@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Agendar visita para Gestión #{{ $gestion->id }}</h3>

    <form action="{{ route('visitas.store', $gestion->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Fecha visita</label>
            <input type="date" name="fecha_visita" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Hora visita</label>
            <input type="time" name="hora_visita" class="form-control" required>
        </div>

        <button class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
