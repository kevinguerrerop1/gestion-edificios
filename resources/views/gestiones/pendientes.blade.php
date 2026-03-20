@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">
            Listado de Solicitudes En Proceso
            <a href="{{ route('gestiones.create') }}" class="btn btn-success float-end">
                Nueva Solicitud
            </a>
        </h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="container mt-4">
            <table id="tabla" class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Departamento</th>
                        <th>Edificio</th>
                        <th>Título</th>
                        <th>Nombre Contacto</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gestiones as $g)
                        <tr>
                            <td>{{ $g->id }}</td>
                            <td>{{ $g->departamento }}</td>
                            <td>
                                <strong>{{ $g->edificio->nombre ?? 'Sin edificio' }}</strong><br>
                                <small class="text-muted">
                                    {{ $g->edificio->direccion ?? '' }}
                                </small>
                            </td>
                            <td>{{ $g->titulo }}</td>
                            <td>{{ $g->nombre_contacto }}</td>
                            <td>{{ $g->telefono_contacto }}</td>
                            <td>{{ $g->email_contacto }}</td>
                            <td>{{\Carbon\Carbon::parse($g->created_at)->format('d-m-Y H:i:s')}}</td>
                            <td><a href="{{ route('visitas.historial', $g->id) }}" class="btn btn-warning btn-sm">Visitas</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
