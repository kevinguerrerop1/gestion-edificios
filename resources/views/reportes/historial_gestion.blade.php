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
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.5s ease forwards;
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

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="container">

        <h3 class="mb-4">📜 Reporte — Historial de gestión</h3>

        {{-- Buscador --}}
        <form method="GET" class="row g-3 mb-4">

            <div class="col-md-8">
                <label class="form-label">Buscar gestión</label>
                <select id="gestion_search" name="gestion_id" class="form-select" required>
                    @if ($gestion)
                        <option value="{{ $gestion->id }}" selected>
                            Gestión #{{ $gestion->id }}
                            — {{ $gestion->edificio->nombre ?? 'Sin edificio' }}
                        </option>
                    @endif
                </select>
            </div>

            <div class="col-md-2 align-self-end">
                <button class="btn btn-primary w-100">
                    🔍 Buscar
                </button>
            </div>

            @if ($gestion)
                <div class="col-md-2 align-self-end">
                    <a href="{{ route('reportes.historial_gestion_pdf', $gestion->id) }}" class="btn btn-danger w-100">
                        📄 PDF
                    </a>
                </div>
            @endif

        </form>

        {{-- Timeline --}}
        @if ($gestion)
            <h5 class="mb-4">
                Gestión #{{ $gestion->id }}
                <small class="text-muted">
                    ({{ ucfirst(str_replace('_', ' ', $gestion->estado)) }})
                </small>
            </h5>

            <div class="timeline">

                @forelse($visitas as $v)
                    <div class="timeline-item">

                        <div
                            class="timeline-dot
                        @if ($v->estado === 'pendiente') bg-warning
                        @elseif($v->estado === 'pagado') bg-success
                        @elseif($v->estado === 'en_proceso') bg-info
                        @elseif($v->estado === 'realizada') bg-success
                        @elseif($v->estado === 'finalizada') bg-danger
                        @else bg-secondary @endif">
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

                                @if ($v->comentario)
                                    <p class="mt-2 mb-0 text-muted">
                                        📝 {{ $v->comentario }}
                                    </p>
                                @endif

                            </div>
                        </div>

                    </div>
                @empty
                    <div class="alert alert-info">
                        No hay registros para esta gestión.
                    </div>
                @endforelse

            </div>
        @endif

    </div>

    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#gestion_search').select2({
                placeholder: 'Buscar por ID o edificio...',
                minimumInputLength: 1,
                ajax: {
                    url: '{{ route('reportes.buscar_gestion') }}',
                    dataType: 'json',
                    delay: 300,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    }
                },
                width: '100%'
            });
        });
    </script>

@endsection
