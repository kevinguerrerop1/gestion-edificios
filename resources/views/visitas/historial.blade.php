@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Historial de visitas — Gestión #{{ $gestion->id }}</h3>

    <a href="{{ route('visitas.create', $gestion->id) }}" class="btn btn-success mb-3">
        + Nueva visita
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visitas as $v)
            <tr>
                <td>{{ $v->fecha_visita }}</td>
                <td>{{ $v->hora_visita }}</td>
                <td>{{ $v->estado }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
