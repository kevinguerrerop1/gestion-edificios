@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h4 class="mb-4">📊 Centro de Reportes</h4>
        <div class="row g-4">
            @foreach ($reportes as $reporte)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100 border-0">
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title">
                                {{ $reporte['titulo'] }}
                            </h6>
                            <p class="card-text text-muted small flex-grow-1">
                                {{ $reporte['descripcion'] }}
                            </p>
                            @if ($reporte['requiere_fechas'])
                                <form method="GET" action="{{ $reporte['ruta'] }}">
                                    <div class="mb-2">
                                        <input type="date" name="desde" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="mb-2">
                                        <input type="date" name="hasta" class="form-control form-control-sm" required>
                                    </div>
                                    <button class="btn btn-outline-primary btn-sm w-100">
                                        Generar reporte
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
@endsection
