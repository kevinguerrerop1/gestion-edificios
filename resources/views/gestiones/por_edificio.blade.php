@extends('layouts.app')

@section('content')
    <div class="container">

        <a href="{{ route('edificios.index') }}" class="btn btn-secondary mb-3">
            ⬅ Volver
        </a>

        @include('gestiones.partials.listado', [
            'edificio' => $edificio,
            'gestiones' => $gestiones,
        ])

    </div>
@endsection
