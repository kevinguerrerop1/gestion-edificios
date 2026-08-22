@extends('layouts.app')

@section('content')
    <!-- Librería para convertir la firma a imagen PNG -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 fw-bold text-dark">✉️ Generador de Firmas Corporativas</h4>
                <small class="text-muted">Servicios Globales RV - Genera y descarga tu firma institucional</small>
            </div>
        </div>

        <div class="row g-4">
            {{-- PANEL DE ENTRADA --}}
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-dark text-white fw-bold">
                        ⚙️ Datos del Colaborador
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Nombre Completo</label>
                            <input type="text" id="inputNombre" class="form-control form-control-sm"
                                placeholder="Ingresa el nombre y apellido...">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Cargo / Puesto</label>
                            <input type="text" id="inputCargo" class="form-control form-control-sm"
                                placeholder="Ingresa el cargo o departamento...">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Teléfono / Celular</label>
                            <input type="text" id="inputTelefono" class="form-control form-control-sm"
                                placeholder="+56 9 1234 5678">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Correo Electrónico</label>
                            <input type="email" id="inputEmail" class="form-control form-control-sm"
                                placeholder="ejemplo@serviciosglobalesrv.cl">
                        </div>

                        <hr>

                        <div class="d-grid">
                            <button type="button" class="btn btn-success fw-bold py-2" onclick="descargarComoImagen()">
                                🖼️ Descargar Firma como Imagen (PNG)
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- VISTA PREVIA --}}
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light fw-bold text-muted">
                        👁️ Vista Previa en Tiempo Real
                    </div>
                    <div class="card-body p-4 bg-light d-flex justify-content-center align-items-center"
                        style="min-height: 280px;">

                        {{-- CONTENEDOR DE LA FIRMA (ESTILO EJECUTIVO MODERNO) --}}
                        <div id="contenedorFirma"
                            style="display: inline-block; background-color: #ffffff; padding: 18px 24px; border-radius: 8px; border-top: 4px solid #1E3050; box-shadow: 0 4px 12px rgba(0,0,0,0.06);">
                            <table cellpadding="0" cellspacing="0" border="0"
                                style="font-family: 'Segoe UI', Helvetica, Arial, sans-serif; font-size: 11px; line-height: 1.35; color: #333333; background-color: #ffffff; min-width: 480px;">
                                <tbody>
                                    <tr>
                                        {{-- BLOQUE LOGO --}}
                                        <td valign="middle"
                                            style="padding-right: 22px; text-align: center; vertical-align: middle; width: 115px;">
                                            <img src="{{ asset('img/logo-rv.jpeg') }}" alt="Servicios Globales RV"
                                                width="110"
                                                style="display: block; width: 110px; max-width: 110px; height: auto; border: 0;">
                                        </td>

                                        {{-- SEPARADOR --}}
                                        <td style="border-left: 2px solid #E2E8F0; padding-left: 20px;" valign="top">
                                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                                <tbody>
                                                    {{-- NOMBRE --}}
                                                    <tr>
                                                        <td style="padding-bottom: 2px;">
                                                            <span id="prevNombre"
                                                                style="font-size: 16px; font-weight: 800; color: #1E3050; letter-spacing: 0.5px; text-transform: uppercase;">
                                                                NOMBRE DEL COLABORADOR
                                                            </span>
                                                        </td>
                                                    </tr>

                                                    {{-- CARGO --}}
                                                    <tr>
                                                        <td style="padding-bottom: 10px;">
                                                            <span id="prevCargo"
                                                                style="font-size: 10.5px; font-weight: 700; color: #0284C7; letter-spacing: 0.4px; text-transform: uppercase;">
                                                                CARGO / PUESTO
                                                            </span>
                                                        </td>
                                                    </tr>

                                                    {{-- DATOS DE CONTACTO --}}
                                                    <tr>
                                                        <td style="font-size: 11px; color: #475569; padding-bottom: 3px;">
                                                            <span
                                                                style="display: inline-block; width: 18px; color: #1E3050; font-weight: bold;">📞</span>
                                                            <span id="prevTelefono"
                                                                style="color: #334155; font-weight: 600;">+56 9 ...</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 11px; color: #475569; padding-bottom: 3px;">
                                                            <span
                                                                style="display: inline-block; width: 18px; color: #1E3050; font-weight: bold;">✉️</span>
                                                            <span id="prevEmail"
                                                                style="color: #0284C7; font-weight: 600;">contacto@serviciosglobalesrv.cl</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 10.5px; color: #64748B; padding-bottom: 8px;">
                                                            <span
                                                                style="display: inline-block; width: 18px; color: #1E3050; font-weight: bold;">📍</span>
                                                            <span>Comandante Whiteside N°4903, Oficina 506, San
                                                                Miguel</span>
                                                        </td>
                                                    </tr>

                                                    {{-- SITIO WEB (COMENTADO) --}}
                                                    {{--
                                                <tr>
                                                    <td style="font-size: 10.5px; color: #64748B; padding-bottom: 8px;">
                                                        <span style="display: inline-block; width: 18px; color: #1E3050; font-weight: bold;">🌐</span>
                                                        <span style="color: #0284C7; font-weight: 600;">www.serviciosglobalesrv.cl</span>
                                                    </td>
                                                </tr>
                                                --}}

                                                    {{-- BARRA INFERIOR --}}
                                                    <tr>
                                                        <td
                                                            style="border-top: 1px solid #F1F5F9; padding-top: 6px; font-size: 10px; color: #94A3B8;">
                                                            <strong style="color: #1E3050;">SERVICIOS GLOBALES RV
                                                                LTDA.</strong>
                                                            {{-- | RUT: 78.201.133-2 --}}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function actualizarFirma() {
            let nombre = document.getElementById('inputNombre').value.trim();
            let cargo = document.getElementById('inputCargo').value.trim();
            let telefono = document.getElementById('inputTelefono').value.trim();
            let email = document.getElementById('inputEmail').value.trim();

            document.getElementById('prevNombre').innerText = nombre || 'NOMBRE DEL COLABORADOR';
            document.getElementById('prevCargo').innerText = cargo || 'CARGO / PUESTO';
            document.getElementById('prevTelefono').innerText = telefono || '+56 9 ...';
            document.getElementById('prevEmail').innerText = email || 'contacto@serviciosglobalesrv.cl';
        }

        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', actualizarFirma);
        });

        // Descargar como PNG en Alta Definición
        function descargarComoImagen() {
            const contenedor = document.getElementById('contenedorFirma');
            const nombreColaborador = document.getElementById('inputNombre').value.trim() || 'Firma_Corporativa';
            const nombreArchivo = 'Firma_' + nombreColaborador.replace(/\s+/g, '_') + '.png';

            html2canvas(contenedor, {
                scale: 3, // Calidad retina HD
                backgroundColor: '#ffffff',
                useCORS: true,
                logging: false
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = nombreArchivo;
                link.href = canvas.toDataURL('image/png');
                link.click();
            });
        }
    </script>
@endsection
