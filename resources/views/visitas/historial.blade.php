@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Historial de visitas — Gestión #{{ $gestion->id }}</h3>
    <a href="{{ route('visitas.create', $gestion->id) }}" class="btn btn-success mb-3"> + Nueva visita </a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="container mt-4">
        <h4 class="mb-4">📜 Historial de visitas</h4>
        <div class="list-group">
            @forelse($visitas as $v)
                <div class="list-group-item list-group-item-action mb-2 rounded shadow-sm">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                            📅 {{ \Carbon\Carbon::parse($v->fecha_visita)->format('d-m-Y') }}
                        </h5>
                        <small class="text-muted">
                            🕒 {{ \Carbon\Carbon::parse($v->hora_visita)->format('H:i') }}
                        </small>
                    </div>
                    <p class="mb-1">
                        Estado:
                        <span class="badge
                            @if($v->estado == 'pendiente') bg-warning text-dark
                            @elseif($v->estado == 'realizada') bg-success
                            @else bg-secondary @endif">
                            {{ ucfirst($v->estado) }}
                        </span>
                    </p>
                </div>
            @empty
                <div class="alert alert-info">
                    No hay visitas registradas aún.
                </div>
            @endforelse
        </div>
    </div>
    @if($gestion->estado !== 'finalizada')
        <form method="POST" action="{{ route('gestiones.finalizar', $gestion->id) }}" class="mt-4 p-3 border rounded bg-light">
            @csrf
            <h5 class="mb-3">🔒 Finalizar servicio</h5>
            <div class="mb-3">
                <label class="form-label">Comentario de cierre</label>
                <textarea name="comentario" class="form-control" rows="3" required></textarea>
            </div>
            <button class="btn btn-danger">
                Finalizar servicio
            </button>
        </form>
    @endif
</div>
@endsection
