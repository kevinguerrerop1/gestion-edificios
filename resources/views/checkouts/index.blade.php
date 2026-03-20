@extends('layouts.app')

@section('content')
<div class="container">

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">📦 Listado de Checkouts</h3>

    {{-- 🔥 BOTÓN NUEVO --}}
    <a href="{{ route('checkouts.create') }}" class="btn btn-success">
        ➕ Nuevo Checkout
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped" id="tabla">
<thead class="table-dark">
<tr>
    <th>#</th>
    <th>Edificio</th>
    <th>Bloque</th>
    <th>Fecha Inicio</th>
    <th>Fecha Término</th>
    <th>Total Artículos</th>
    <th>Acciones</th>
</tr>
</thead>

<tbody>
@foreach($checkouts as $c)
<tr>
    <td>{{ $c->id }}</td>

    <td>
        {{ $c->edificio->nombre ?? 'Sin edificio' }}
    </td>

    <td>{{ $c->bloque }}</td>

    <td>
        {{ \Carbon\Carbon::parse($c->fecha_inicio)->format('d-m-Y') }}
    </td>

    <td>
        {{ \Carbon\Carbon::parse($c->fecha_termino)->format('d-m-Y') }}
    </td>

    <td>
        {{ $c->detalles->sum('cantidad') }}
    </td>

    <td>
        <a href="{{ route('checkouts.show', $c->id) }}" class="btn btn-primary btn-sm">
            👁 Ver detalle
        </a>
    </td>

</tr>
@endforeach
</tbody>

</table>

</div>
@endsection


@section('scripts')
<script>
$(document).ready(function() {
    $('#tabla').DataTable({ // 🔥 OJO aquí corregí el ID
        responsive: true,
        autoWidth: false,
        pageLength: 10,
        language: {
            lengthMenu: "Mostrar _MENU_ registros",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "→",
                previous: "←"
            }
        }
    });
});
</script>
@endsection
