@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <!-- Título con el número de cotización -->
                <h5 class="mb-0">
                    📄 Emitir Cotización: <span id="tituloCotizacion"
                        class="text-warning fw-bold">{{ $siguienteCorrelativo }}</span>
                    <small class="text-muted fs-6">(Check-Out #{{ $checkout->id }})</small>
                </h5>
                <a href="{{ route('checkouts.index') }}" class="btn btn-sm btn-outline-light">Volver</a>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('checkouts.cotizaciones.store', $checkout->id) }}">
                    @csrf

                    <!-- Cabecera de Datos -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">N° Cotización</label>
                            <input type="text" name="numero_cotizacion" id="inputNumeroCotizacion"
                                class="form-control fw-bold text-primary" value="{{ $siguienteCorrelativo }}" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">Fecha</label>
                            <input type="date" name="fecha" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Cliente / Razón Social</label>
                            <input type="text" name="cliente_nombre" class="form-control"
                                value="{{ $checkout->edificio->nombre ?? '' }}" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Contacto</label>
                            <input type="text" name="contacto" class="form-control" value="Sr.(a)">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="contacto@cliente.cl">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" value="+56 9 ">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Departamento</label>
                            <input type="text" name="departamento" class="form-control" value="{{ $checkout->bloque }}">
                        </div>
                    </div>

                    <hr>
                    <!-- Detalle de Servicios Dinámico -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0">Detalle de Servicios y Artículos</h6>
                        <button type="button" class="btn btn-sm btn-success" id="btnAgregarFila">➕ Agregar Ítem</button>
                    </div>

                    <table class="table table-bordered align-middle" id="tablaItems">
                        <thead class="table-secondary text-center">
                            <tr>
                                <th style="width: 5%;">N°</th>
                                <th style="width: 50%;">DETALLE DEL SERVICIO</th>
                                <th style="width: 15%;">VALOR UNITARIO ($)</th>
                                <th style="width: 10%;">UNIDADES</th>
                                <th style="width: 15%;">TOTAL ($)</th>
                                <th style="width: 5%;"></th>
                            </tr>
                        </thead>
                        <tbody id="filasContainer">
                            <tr>
                                <td class="text-center fw-bold row-index">1</td>
                                <td>
                                    <input type="text" name="items[0][detalle]" class="form-control form-control-sm"
                                        placeholder="Descripción del servicio o artículo" required>
                                </td>
                                <td>
                                    <input type="number" name="items[0][valor_unitario]"
                                        class="form-control form-control-sm text-end valor-unitario" value="0"
                                        min="0" required>
                                </td>
                                <td>
                                    <input type="number" name="items[0][unidades]"
                                        class="form-control form-control-sm text-center unidades" value="1"
                                        min="1" required>
                                </td>
                                <td class="text-end fw-bold total-linea">$0</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-eliminar">✕</button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end fw-bold">SUBTOTAL:</td>
                                <td class="text-end fw-bold" id="lblSubtotal">$0</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-end fw-bold">IVA (19%):</td>
                                <td class="text-end fw-bold text-danger" id="lblIva">$0</td>
                                <td></td>
                            </tr>
                            <tr class="table-light">
                                <td colspan="4" class="text-end fw-bold fs-5">TOTAL:</td>
                                <td class="text-end fw-bold fs-5 text-success" id="lblTotal">$0</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Observaciones</label>
                        <textarea name="observaciones" class="form-control" rows="3">Se encuentran contemplados en los servicios detallados a continuación, personal, mantención e instalación de termo y cualquier otro requerido y necesario para el cumplimiento total del servicio.</textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">💾 Guardar y Emitir Cotización</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let filaIndex = 1;

        function recalcularTotales() {
            let subtotal = 0;
            document.querySelectorAll('#filasContainer tr').forEach(tr => {
                let precio = parseFloat(tr.querySelector('.valor-unitario').value) || 0;
                let cant = parseFloat(tr.querySelector('.unidades').value) || 0;
                let totalLinea = precio * cant;
                tr.querySelector('.total-linea').innerText = '$' + totalLinea.toLocaleString('es-CL');
                subtotal += totalLinea;
            });

            let iva = Math.round(subtotal * 0.19);
            let total = subtotal + iva;

            document.getElementById('lblSubtotal').innerText = '$' + subtotal.toLocaleString('es-CL');
            document.getElementById('lblIva').innerText = '$' + iva.toLocaleString('es-CL');
            document.getElementById('lblTotal').innerText = '$' + total.toLocaleString('es-CL');
        }

        document.getElementById('btnAgregarFila').addEventListener('click', function() {
            let container = document.getElementById('filasContainer');
            let tr = document.createElement('tr');
            tr.innerHTML = `
        <td class="text-center fw-bold row-index"></td>
        <td>
            <input type="text" name="items[${filaIndex}][detalle]" class="form-control form-control-sm" placeholder="Descripción del servicio o artículo" required>
        </td>
        <td>
            <input type="number" name="items[${filaIndex}][valor_unitario]" class="form-control form-control-sm text-end valor-unitario" value="0" min="0" required>
        </td>
        <td>
            <input type="number" name="items[${filaIndex}][unidades]" class="form-control form-control-sm text-center unidades" value="1" min="1" required>
        </td>
        <td class="text-end fw-bold total-linea">$0</td>
        <td class="text-center">
            <button type="button" class="btn btn-sm btn-outline-danger btn-eliminar">✕</button>
        </td>
    `;
            container.appendChild(tr);
            filaIndex++;
            renumerarFilas();
        });

        document.getElementById('filasContainer').addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-eliminar')) {
                let filas = document.querySelectorAll('#filasContainer tr');
                if (filas.length > 1) {
                    e.target.closest('tr').remove();
                    renumerarFilas();
                    recalcularTotales();
                } else {
                    alert('Debe existir al menos un ítem.');
                }
            }
        });

        document.getElementById('filasContainer').addEventListener('input', function(e) {
            if (e.target.classList.contains('valor-unitario') || e.target.classList.contains('unidades')) {
                recalcularTotales();
            }
        });

        function renumerarFilas() {
            document.querySelectorAll('#filasContainer tr').forEach((tr, idx) => {
                tr.querySelector('.row-index').innerText = idx + 1;
            });
        }

        document.getElementById('inputNumeroCotizacion').addEventListener('input', function() {
            let valor = this.value.trim();
            document.getElementById('tituloCotizacion').innerText = valor !== '' ? valor : '---';
        });
    </script>
@endsection
