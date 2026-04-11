@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <h4 class="mb-4 fw-bold">📊 Centro de Reportes</h4>

        {{-- 🟢 CHECKOUTS --}}
        <div class="mb-5">
            <h5 class="fw-semibold text-success mb-3">
                📦 Checkouts
            </h5>

            <div class="row g-4">
                @foreach ($reportesCheckouts as $reporte)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm h-100 border-0">

                            <div class="card-body d-flex flex-column">

                                <h6 class="fw-bold">
                                    {{ $reporte['titulo'] }}
                                </h6>

                                <p class="text-muted small flex-grow-1">
                                    {{ $reporte['descripcion'] }}
                                </p>

                                @if ($reporte['requiere_fechas'])
                                    <form method="GET" action="{{ $reporte['ruta'] }}">

                                        <div class="mb-2">
                                            <input type="date" name="desde" class="form-control form-control-sm"
                                                required>
                                        </div>

                                        <div class="mb-2">
                                            <input type="date" name="hasta" class="form-control form-control-sm"
                                                required>
                                        </div>

                                        {{-- ⚠️ MENSAJE --}}
                                        <div class="alert alert-warning py-1 px-2 small">
                                            ⚠️ El archivo Excel puede mostrar una advertencia al abrirse.
                                        </div>

                                        <button class="btn btn-outline-success btn-sm w-100">
                                            Generar reporte
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ $reporte['ruta'] }}" class="btn btn-outline-success btn-sm w-100">
                                        Ver reporte
                                    </a>
                                @endif

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- 🔵 MANTENEDOR TERMOS --}}
        <div>
            <h5 class="fw-semibold text-primary mb-3">
                🔧 Mantenedor de Termos
            </h5>

            <div class="row g-4">
                @foreach ($reportesTermos as $reporte)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm h-100 border-0 hover-shadow">

                            <div class="card-body d-flex flex-column">

                                <h6 class="fw-bold">
                                    {{ $reporte['titulo'] }}
                                </h6>

                                <p class="text-muted small flex-grow-1">
                                    {{ $reporte['descripcion'] }}
                                </p>

                                @if ($reporte['requiere_fechas'])
                                    <form method="GET" action="{{ $reporte['ruta'] }}">
                                        <div class="mb-2">
                                            <input type="date" name="desde" class="form-control form-control-sm"
                                                required>
                                        </div>

                                        <div class="mb-2">
                                            <input type="date" name="hasta" class="form-control form-control-sm"
                                                required>
                                        </div>

                                        <button class="btn btn-outline-primary btn-sm w-100">
                                            Generar
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ $reporte['ruta'] }}" class="btn btn-outline-primary btn-sm w-100">
                                        Ver reporte
                                    </a>
                                @endif

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
