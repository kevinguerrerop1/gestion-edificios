@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">
        📋 Solicitudes sin visita agendada
        <span class="badge bg-secondary">{{ $gestiones->count() }}</span>
    </h4>
    @if($gestiones->isEmpty())
        <div class="alert alert-success">
            No existen solicitudes pendientes de agendamiento 🎉
        </div>
    @else
        <div class="table-responsive shadow-sm">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Edificio</th>
                        <th>Departamento</th>
                        <th>Contacto</th>
                        <th>Teléfono</th>
                        <th>Fecha solicitud</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gestiones as $g)
                        <tr>
                            <td>#{{ $g->id }}</td>
                            <td>
                                {{ $g->edificio->nombre ?? '—' }}<br>
                                <small class="text-muted">
                                    {{ $g->edificio->direccion ?? '' }}
                                </small>
                            </td>
                            <td>{{ $g->departamento }}</td>
                            <td>{{ $g->nombre_contacto }}</td>
                            <td>{{ $g->telefono_contacto }}</td>
                            <td>{{ $g->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                <span class="badge bg-warning text-dark">
                                    Pendiente
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
