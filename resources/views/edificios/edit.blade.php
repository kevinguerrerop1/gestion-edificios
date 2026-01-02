@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">✏️ Editar edificio</h5>
                </div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('edificios.update', $edificio->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nombre del edificio</label>
                            <input
                                type="text"
                                name="nombre"
                                class="form-control"
                                value="{{ old('nombre', $edificio->nombre) }}"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dirección</label>
                            <input
                                type="text"
                                name="direccion"
                                class="form-control"
                                value="{{ old('direccion', $edificio->direccion) }}"
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ciudad</label>
                            <input
                                type="text"
                                name="ciudad"
                                class="form-control"
                                value="{{ old('ciudad', $edificio->ciudad) }}"
                            >
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('edificios.index') }}" class="btn btn-secondary">
                                ← Cancelar
                            </a>

                            <button class="btn btn-warning">
                                💾 Actualizar edificio
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
