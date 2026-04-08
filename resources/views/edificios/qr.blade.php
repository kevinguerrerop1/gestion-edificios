@extends('layouts.app')

@section('content')
    <style>
        .bg-brand {
            background-color: #1f4e78 !important;
        }

        .btn-brand {
            background-color: #1f4e78;
            border-color: #1f4e78;
            color: #fff;
        }

        .btn-brand:hover {
            background-color: #163a59;
            border-color: #163a59;
            color: #fff;
        }
    </style>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">

                <div class="card shadow border-0">
                    <div class="card-header bg-brand text-white fw-semibold">
                        <i class="bi bi-qr-code me-2"></i>
                        QR – {{ $edificio->nombre }}
                    </div>

                    <div class="card-body">

                        <p class="mb-3 text-muted">
                            Escanee este código para ingresar una solicitud de mantención.
                        </p>

                        {{-- QR --}}
                        <div class="mb-4">
                            {!! $qrSvg !!}
                        </div>

                        <p class="text-muted small">
                            URL asociada:<br>
                            <code>{{ $url }}</code>
                        </p>

                        <div class="d-grid gap-2 mt-4">

                            <a href="data:image/svg+xml;base64,{{ base64_encode($qrSvg) }}"
                                download="qr-edificio-{{ $edificio->id }}.svg" class="btn btn-success">
                                <i class="bi bi-download me-1"></i> Descargar QR
                            </a>

                            <button onclick="window.print()" class="btn btn-brand">
                                <i class="bi bi-printer me-1"></i> Imprimir
                            </button>

                            <a href="{{ route('edificios.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Volver
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
