@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">🏢 Crear nuevo edificio</h5>
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

                    <form action="{{ route('edificios.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nombre del edificio</label>
                            <input
                                type="text"
                                name="nombre"
                                class="form-control"
                                placeholder="Ej: Edificio Central"
                                value="{{ old('nombre') }}"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dirección</label>
                            <input
                                type="text"
                                name="direccion"
                                class="form-control"
                                placeholder="Ej: Av. Principal 123"
                                value="{{ old('direccion') }}"
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Comuna</label>
                            <input
                                type="text"
                                name="comuna"
                                class="form-control"
                                placeholder="Ej: Ñuñoa"
                                value="{{ old('comuna') }}"
                            >
                        </div>


                        <div class="d-flex justify-content-between">
                            <a href="{{ route('edificios.index') }}" class="btn btn-secondary">
                                ← Volver
                            </a>

                            <button class="btn btn-success">
                                💾 Guardar edificio
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
