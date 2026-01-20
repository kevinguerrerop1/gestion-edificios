@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>
            ⏰ Visitas atrasadas
            <span class="badge bg-danger">{{ $visitas->count() }}</span>
        </h4>

        <a href="{{ route('reportes.visitas-atrasadas.pdf') }}" class="btn btn-outline-danger">
            📄 Descargar PDF
        </a>
    </div>

    @if($visitas->isEmpty())
        <div class="alert alert-success">
            No existen visitas atrasadas 🎉
        </div>
    @else
        <div class="table-responsive shadow-sm">
            <table id="tabla-gestiones" class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID Gestión</th>
                        <th>Edificio</th>
                        <th>Departamento</th>
                        <th>Fecha visita</th>
                        <th>Hora</th>
                        <th>Días atraso</th>
                        <th>Contacto</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($visitas as $v)
                        <tr>
                            <td>#{{ $v->gestion->id }}</td>
                            <td>
                                {{ $v->gestion->edificio->nombre ?? '—' }}<br>
                                <small class="text-muted">
                                    {{ $v->gestion->edificio->direccion ?? '' }}
                                </small>
                            </td>
                            <td>{{ $v->gestion->departamento }}</td>
                            <td>{{ \Carbon\Carbon::parse($v->fecha_visita)->format('d-m-Y') }}</td>
                            <td>{{ $v->hora_visita }} hrs</td>
                            <td>
                                <span class="badge bg-danger">
                                    {{ \Carbon\Carbon::parse($v->fecha_visita)->diffInDays(now()) }} días
                                </span>
                            </td>
                            <td>
                                {{ $v->gestion->nombre_contacto }}<br>
                                <small>{{ $v->gestion->telefono_contacto }}</small>
                            </td>
                            <td>
                                <span class="badge bg-warning text-dark">
                                    {{ ucfirst(str_replace('_',' ', $v->estado)) }}
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
