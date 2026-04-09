@extends('layouts.app')

@section('content')

<div class="container">

    <h4 class="mb-4">📋 Historial Check-Out #{{ $checkout->id }}</h4>

    {{-- DATOS DEL CHECKOUT --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            Información general
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-md-3">
                    <strong>Edificio:</strong><br>
                    {{ $checkout->edificio->nombre ?? '-' }}
                </div>

                <div class="col-md-3">
                    <strong>Técnico:</strong><br>
                    {{ $checkout->tecnico->nombre ?? '-' }}
                </div>

                <div class="col-md-2">
                    <strong>Bloque:</strong><br>
                    {{ $checkout->bloque }}
                </div>

                <div class="col-md-2">
                    <strong>Inicio:</strong><br>
                    {{ $checkout->fecha_inicio ?? '-' }}
                </div>

                <div class="col-md-2">
                    <strong>Estado:</strong><br>

                    @switch($checkout->estado)
                        @case('pendiente')
                            <span class="badge bg-secondary">Pendiente</span>
                        @break

                        @case('en_revision')
                            <span class="badge bg-primary">En revisión</span>
                        @break

                        @case('con_reparos')
                            <span class="badge bg-warning text-dark">Con reparos</span>
                        @break

                        @case('finalizado')
                            <span class="badge bg-success">Finalizado</span>
                        @break
                    @endswitch

                </div>

            </div>
        </div>
    </div>

    {{-- OBSERVACIONES --}}
    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">
            💬 Observaciones
        </div>

        <div class="card-body">

            {{-- LISTADO --}}
            <div style="max-height: 300px; overflow-y:auto;" class="mb-3">

                @forelse($checkout->observaciones as $o)
                    <div class="border rounded p-2 mb-2">

                        <div>
                            📝 {{ $o->observacion }}
                        </div>

                        <small class="text-muted">
                            {{ $o->created_at->format('d-m-Y H:i') }}
                        </small>

                    </div>
                @empty
                    <div class="text-muted">
                        Sin observaciones
                    </div>
                @endforelse

            </div>

            {{-- FORMULARIO --}}
            <form method="POST" action="{{ route('checkouts.observaciones', $checkout->id) }}">
                @csrf

                <div class="input-group">
                    <input type="text" name="observacion"
                        class="form-control"
                        placeholder="Escribe una observación..." required>

                    <button class="btn btn-primary">
                        ➕ Agregar
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
