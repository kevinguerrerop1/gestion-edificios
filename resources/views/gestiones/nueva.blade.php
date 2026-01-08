@extends('layouts.app')

@php
    $hideNavbar = true;
@endphp

@section('content')
<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">

            <div class="card shadow-sm border-0">

                <div class="card-header text-white text-center"
                    style="background-color:#1f4e78;">
                    <h5 class="mb-0">🛠 Mantención de Termos</h5>
                </div>

                <div class="card-body px-4 py-4">

                    @if(session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    <p class="text-muted text-center mb-4">
                        Complete el formulario y nos comunicaremos con usted para coordinar la visita.
                    </p>

                    <div class="alert alert-light border text-center mb-4">
                        🏢 <strong>{{ $edificio->nombre }}</strong><br>
                        <small class="text-muted">
                            {{ $edificio->direccion }} – {{ $edificio->comuna }}
                        </small>
                    </div>

                    <form action="{{ route('gestiones.nuevastore') }}" method="POST">
                        @csrf

                        <input type="hidden" name="edificio_id" value="{{ $edificio->id }}">

                        <div class="mb-3">
                            <label class="form-label">Departamento</label>
                            <input type="text"
                                   name="departamento"
                                   class="form-control"
                                   placeholder="Ej: Torre B, Dpto 302"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Trabajo solicitado</label>
                            <input type="text"
                                   name="titulo"
                                   class="form-control bg-light"
                                   value="Mantención de Termos"
                                   readonly>
                        </div>

                        <!-- FECHA Y HORA ESTIMADA -->
                        <div class="mb-3">
                            <label class="form-label">
                                Fecha estimada de visita
                            </label>

                            <input type="date"
                                name="fecha_visita_estimada"
                                id="fecha_visita"
                                class="form-control mb-2"
                                required>

                            <label class="form-label">
                                Hora estimada
                            </label>

                            <input type="time"
                                name="hora_visita_estimada"
                                id="hora_visita"
                                class="form-control"
                                min="09:00"
                                max="18:00"
                                required>

                            <small class="text-muted">
                                📅 Desde el día siguiente a la solicitud<br>
                                🕘 Horario sugerido: sábado entre 09:00 y 18:00<br>
                                ⏱ La hora es referencial y sujeta a confirmación
                            </small>

                            <div id="mensajeSabado"
                                class="alert alert-info mt-2 py-2 d-none text-center">
                                ✔ Sábado seleccionado – horario sugerido de 09:00 a 18:00
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nombre de contacto</label>
                            <input type="text"
                                   name="nombre_contacto"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text"
                                   name="telefono_contacto"
                                   id="telefono_contacto"
                                   class="form-control"
                                   value="+569"
                                   maxlength="12"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email"
                                   name="email_contacto"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Descripción del problema</label>
                            <textarea name="descripcion"
                                      rows="4"
                                      class="form-control"
                                      placeholder="Describa brevemente el problema"
                                      required></textarea>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-lg text-white"
                                    style="background-color:#1f4e78;">
                                📩 Enviar solicitud
                            </button>
                        </div>

                    </form>

                </div>

                <div class="card-footer text-center text-muted small">
                    Sistema de Mantenciones · Servicios Globales RV
                </div>

            </div>

        </div>
    </div>
</div>

<script>
// TELÉFONO
document.getElementById('telefono_contacto').addEventListener('input', function () {
    if (!this.value.startsWith('+569')) {
        this.value = '+569';
    }
    this.value = this.value.replace(/[^0-9+]/g, '');
});

// FECHA MÍNIMA = MAÑANA
const fechaInput = document.getElementById('fecha_visita');
const horaInput = document.getElementById('hora_visita');
const mensajeSabado = document.getElementById('mensajeSabado');

const hoy = new Date();
hoy.setDate(hoy.getDate() + 1);
fechaInput.min = hoy.toISOString().split('T')[0];

// HORA POR DEFECTO
horaInput.value = '09:00';

// DETECTAR SÁBADO
fechaInput.addEventListener('change', function () {
    const fecha = new Date(this.value + 'T00:00');
    if (fecha.getDay() === 6) { // sábado
        mensajeSabado.classList.remove('d-none');
    } else {
        mensajeSabado.classList.add('d-none');
    }
});
</script>

@endsection
