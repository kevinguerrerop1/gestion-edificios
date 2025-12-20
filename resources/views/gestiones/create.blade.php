@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Nueva Solicitud</h2>

    <form action="{{ route('gestiones.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Departamento</label>
            <input type="text" name="departamento" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Título</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" rows="4" required></textarea>
        </div>

        <button class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
