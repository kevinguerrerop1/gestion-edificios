@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    QR – {{ $edificio->nombre }}
                </div>

                <div class="card-body">

                    <p class="mb-3">
                        Escanee este código para ingresar una solicitud de mantención.
                    </p>

                    {{-- QR --}}
                    <div class="mb-3">
                        {!! $qrSvg !!}
                    </div>

                    <p class="text-muted small">
                        URL asociada:<br>
                        <code>{{ $url }}</code>
                    </p>

                    <div class="d-grid gap-2 mt-3">
                        <a
                            href="data:image/svg+xml;base64,{{ base64_encode($qrSvg) }}"
                            download="qr-edificio-{{ $edificio->id }}.svg"
                            class="btn btn-success"
                        >
                            ⬇ Descargar QR
                        </a>

                        <button onclick="window.print()" class="btn btn-primary">
                            🖨 Imprimir
                        </button>

                        <a href="{{ route('edificios.index') }}" class="btn btn-secondary">
                            ← Volver
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
