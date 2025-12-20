@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Peticiones de Arreglos</h2>

    <a href="{{ route('gestiones.create') }}" class="btn btn-primary mb-3">Nueva petición</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Departamento</th>
                <th>Título</th>
                <th>Estado</th>
                <th>F. Creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gestiones as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->departamento }}</td>
                <td>{{ $p->titulo }}</td>
                <td>{{ $p->estado }}</td>
                <td>{{\Carbon\Carbon::parse($p->created_at)->format('d-m-Y H:i:s')}}</td>

                <td><a href="{{ url('gestiones/'.$p->id.'/edit') }}" class="btn btn-warning btn-sm">Editar</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $gestiones->links() }}
</div>
@endsection
