@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Estado</h2>

    <form action="{{ route('gestiones.update', $gestione->id) }}" method="POST">
        @csrf
        @method('PUT')

        <p><strong>Departamento:</strong> {{ $gestione->departamento }}</p>
        <p><strong>Título:</strong> {{ $gestione->titulo }}</p>

        <label>Estado</label>
        <select name="estado" class="form-control">
            <option value="pendiente"  {{ old('estado', $gestione->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="en_proceso" {{ old('estado', $gestione->estado) == 'en_proceso' ? 'selected' : '' }}>En proceso</option>
            <option value="resuelto"   {{ old('estado', $gestione->estado) == 'resuelto' ? 'selected' : '' }}>Resuelto</option>
        </select>
        <button class="btn btn-primary mt-3">Actualizar</button>
    </form>
</div>
@endsection
