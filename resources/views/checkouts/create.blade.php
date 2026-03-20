@extends('layouts.app')

@section('content')
<div class="container">

<h3>🛒 Nuevo Checkout</h3>

<form method="POST" action="{{ route('checkouts.store') }}" enctype="multipart/form-data">
@csrf

<select name="edificio_id" class="form-select mb-2">
@foreach($edificios as $e)
<option value="{{ $e->id }}">{{ $e->nombre }}</option>
@endforeach
</select>

<select name="tecnico_id" class="form-select mb-2">
@foreach($tecnicos as $t)
<option value="{{ $t->id }}">{{ $t->nombre }}</option>
@endforeach
</select>

<input type="text" name="bloque" class="form-control mb-2" placeholder="Bloque">

<div class="row mb-2">
<div class="col">
    <input type="date" name="fecha_inicio" class="form-control">
</div>
<div class="col">
    <input type="date" name="fecha_termino" class="form-control">
</div>
</div>

<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalArticulos">
Agregar artículos
</button>

<table class="table table-bordered">
<thead>
<tr>
<th>Artículo</th>
<th>Cantidad</th>
</tr>
</thead>
<tbody id="tablaArticulos">
<tr>
<td colspan="2" class="text-center text-muted">No hay artículos seleccionados</td>
</tr>
</tbody>
</table>

<div id="inputsArticulos"></div>

<input type="file" name="pdf_solicitud" class="form-control mb-2">
<input type="file" name="pdf_entrega" class="form-control mb-3">

<button class="btn btn-success">Guardar</button>

</form>

@include('checkouts.modal_articulos')

</div>
@endsection


{{-- 🔥 SCRIPT COMPLETO --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('btnGuardarArticulos')
        .addEventListener('click', function () {

            let articulosSeleccionados = [];

            document.querySelectorAll('.cantidad').forEach(input => {

                let cantidad = parseInt(input.value);

                if (cantidad > 0) {
                    articulosSeleccionados.push({
                        id: input.dataset.id,
                        nombre: input.dataset.nombre,
                        cantidad: cantidad
                    });
                }

            });

            renderTabla(articulosSeleccionados);
            generarInputs(articulosSeleccionados);

        });

});


// 🔥 TABLA
function renderTabla(articulos) {

    const tabla = document.getElementById('tablaArticulos');
    tabla.innerHTML = '';

    if (articulos.length === 0) {
        tabla.innerHTML = `
            <tr>
                <td colspan="2" class="text-center text-muted">
                    No hay artículos seleccionados
                </td>
            </tr>
        `;
        return;
    }

    articulos.forEach(a => {
        tabla.innerHTML += `
            <tr>
                <td>${a.nombre}</td>
                <td>${a.cantidad}</td>
            </tr>
        `;
    });

}


// 🔥 INPUTS PARA BACKEND
function generarInputs(articulos) {

    const contenedor = document.getElementById('inputsArticulos');
    contenedor.innerHTML = '';

    articulos.forEach((a, index) => {

        contenedor.innerHTML += `
            <input type="hidden" name="articulos[${index}][id]" value="${a.id}">
            <input type="hidden" name="articulos[${index}][cantidad]" value="${a.cantidad}">
        `;

    });

}
</script>
