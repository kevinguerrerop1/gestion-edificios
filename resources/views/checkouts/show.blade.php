@extends('layouts.app')

@section('content')
<div class="container">

<h3>📦 Detalle del Checkout #{{ $checkout->id }}</h3>

<a href="{{ route('checkouts.index') }}" class="btn btn-secondary mb-3">
    ⬅ Volver
</a>

{{-- INFO GENERAL --}}
<div class="card mb-3 shadow-sm">
    <div class="card-body">

        <div class="row">
            <div class="col-md-4">
                <strong>🏢 Edificio:</strong><br>
                {{ $checkout->edificio->nombre ?? 'Sin edificio' }}
            </div>

            <div class="col-md-4">
                <strong>👨‍🔧 Técnico:</strong><br>
                {{ $checkout->tecnico->nombre ?? 'Sin técnico' }}
            </div>

            <div class="col-md-4">
                <strong>🏷 Bloque:</strong><br>
                {{ $checkout->bloque }}
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-6">
                <strong>📅 Fecha inicio:</strong><br>
                {{ \Carbon\Carbon::parse($checkout->fecha_inicio)->format('d-m-Y') }}
            </div>

            <div class="col-md-6">
                <strong>📅 Fecha término:</strong><br>
                {{ \Carbon\Carbon::parse($checkout->fecha_termino)->format('d-m-Y') }}
            </div>
        </div>

    </div>
</div>


{{-- ARTÍCULOS --}}
<div class="card mb-3 shadow-sm">
    <div class="card-header bg-primary text-white">
        📦 Artículos utilizados
    </div>

    <div class="card-body p-0">

        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>Artículo</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @forelse($checkout->detalles as $d)
                <tr>
                    <td>{{ $d->articulo->nombre ?? 'N/A' }}</td>
                    <td>{{ $d->cantidad }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="text-center text-muted">
                        No hay artículos registrados
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>


{{-- PDFS --}}
<div class="card shadow-sm">
    <div class="card-header bg-secondary text-white">
        📄 Documentos
    </div>

    <div class="card-body">

        @if($checkout->pdf_solicitud)
            <a href="{{ asset('checkout/'.$checkout->pdf_solicitud) }}" target="_blank" class="btn btn-outline-primary me-2">
                📄 Ver Solicitud
            </a>
        @endif

        @if($checkout->pdf_entrega)
            <a href="{{ asset('checkout/'.$checkout->pdf_entrega) }}" target="_blank" class="btn btn-outline-success">
                📄 Ver Entrega
            </a>
        @endif

    </div>
</div>

</div>
@endsection
