@extends('layouts.app')

@section('content')

<style>
    .timeline {
        position: relative;
        margin-left: 20px;
    }

    .timeline::before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 9px;
        width: 2px;
        background: #dee2e6;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 30px;
    }

    .timeline-dot {
        position: absolute;
        left: 0;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        top: 15px;
    }

    .timeline-content {
        margin-left: 40px;
    }
</style>
<div class="container">

    <h3 class="mb-3">
        📜 Historial de visitas — Gestión #{{ $gestion->id }}
    </h3>

    {{-- Botón nueva visita --}}
    <a href="{{ route('visitas.create', $gestion->id) }}"
       class="btn btn-success mb-3">
        ➕ Nueva visita
    </a>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-4">
    <h4 class="mb-4">📌 Línea de tiempo</h4>

    <div class="timeline">

        @forelse($visitas as $v)
            <div class="timeline-item">

                <div class="timeline-dot
                    @if($v->estado === 'pendiente') bg-warning
                    @elseif($v->estado === 'pagado') bg-success
                    @elseif($v->estado === 'en_proceso') bg-info
                    @elseif($v->estado === 'realizada') bg-success
                    @elseif($v->estado === 'finalizada') bg-danger
                    @else bg-secondary
                    @endif">
                </div>

                <div class="timeline-content card shadow-sm">
                    <div class="card-body py-3">

                        <div class="d-flex justify-content-between">
                            <strong>
                                {{ ucfirst(str_replace('_', ' ', $v->estado)) }}
                            </strong>
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($v->fecha_visita)->format('d-m-Y') }}
                                · {{ \Carbon\Carbon::parse($v->hora_visita)->format('H:i') }}
                            </small>
                        </div>

                        @if(!empty($v->comentario))
                            <p class="mt-2 mb-0 text-muted">
                                📝 {{ $v->comentario }}
                            </p>
                        @endif

                    </div>
                </div>

            </div>
        @empty
            <div class="alert alert-info">
                No hay registros en la línea de tiempo aún.
            </div>
        @endforelse

    </div>
</div>


</div>
@endsection
