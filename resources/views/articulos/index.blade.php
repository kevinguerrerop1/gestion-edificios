@extends('layouts.app')

@section('content')

<div class="container">

<h3>📦 Mantenedor de Artículos</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- CREAR --}}
<form method="POST" action="{{ route('articulos.store') }}" class="row mb-3">
@csrf

<div class="col-md-6">
    <input name="nombre" class="form-control" placeholder="Nombre del artículo" required>
</div>

<div class="col-md-2">
    <button class="btn btn-success w-100">➕ Agregar</button>
</div>

</form>

{{-- BUSCADOR --}}
<input type="text" id="buscador" class="form-control mb-3" placeholder="🔍 Buscar artículo...">

{{-- TABLA --}}
<table class="table table-bordered table-hover align-middle" id="tabla">
<thead class="table-light">
<tr>
<th>Nombre</th>
<th>Estado</th>
<th style="width: 300px;">Acciones</th>
</tr>
</thead>

<tbody id="tabla">
@foreach($articulos as $a)
<tr class="fila">

<td>{{ $a->nombre }}</td>

<td>
@if($a->activo)
<span class="badge bg-success">Activo</span>
@else
<span class="badge bg-secondary">Inactivo</span>
@endif
</td>

<td class="d-flex gap-1">

{{-- EDITAR --}}
<form method="POST" action="{{ route('articulos.update',$a->id) }}" class="d-flex gap-1">
@csrf
@method('PUT')

<input name="nombre" value="{{ $a->nombre }}" class="form-control form-control-sm" required>

<button class="btn btn-primary btn-sm">💾</button>
</form>

{{-- ACTIVAR/DESACTIVAR --}}
<form method="POST" action="{{ route('articulos.toggle',$a->id) }}">
@csrf
<button class="btn btn-warning btn-sm">
    🔄
</button>
</form>

{{-- ELIMINAR --}}
<form method="POST" action="{{ route('articulos.destroy',$a->id) }}"
      onsubmit="return confirm('¿Eliminar artículo?')">
@csrf
@method('DELETE')
<button class="btn btn-danger btn-sm">🗑</button>
</form>

</td>

</tr>
@endforeach
</tbody>
</table>

</div>

{{-- BUSCADOR JS --}}
<script>
document.getElementById('buscador').addEventListener('keyup', function(){
    let f = this.value.toLowerCase();

    document.querySelectorAll('.fila').forEach(tr=>{
        tr.style.display = tr.innerText.toLowerCase().includes(f) ? '' : 'none';
    });
});
</script>

@endsection
