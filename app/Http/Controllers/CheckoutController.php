<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Models\Edificio;
use App\Models\Articulos;
use App\Models\Tecnicos;
use App\Models\CheckoutObservacion;
use App\Models\Checkout_detalles;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CheckoutCotizacion;
use App\Models\CheckoutCotizacionDetalle;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // 📅 Si no viene mes seleccionado, usar mes actual
        $mesSeleccionado = $request->mes ?? now()->month;

        $query = Checkout::with([
            'edificio',
            'tecnico',
            'detalles'
        ])->where('estado', '!=', 'finalizado');

        // 🏢 FILTRO EDIFICIO
        if ($request->filled('edificio_id')) {
            $query->where('edificio_id', $request->edificio_id);
        }

        // 📅 FILTRO MES
        if ($mesSeleccionado) {

            $mes = str_pad($mesSeleccionado, 2, '0', STR_PAD_LEFT);

            $query->whereRaw("DATE_FORMAT(fecha_inicio, '%m') = ?", [$mes]);
        }

        $checkouts = $query->get();

        // 🏢 EDIFICIOS
        $edificios = Edificio::orderBy('nombre')->get();

        return view('checkouts.index', compact(
            'checkouts',
            'edificios',
            'mesSeleccionado'
        ));
    }
    public function cerrados(Request $request)
    {
        // 📅 MES ACTUAL POR DEFECTO
        $mesSeleccionado = $request->mes ?? now()->month;

        $query = Checkout::with([
            'edificio',
            'tecnico',
            'detalles'
        ])
            ->where('estado', 'finalizado');

        // 🏢 FILTRO EDIFICIO
        if ($request->filled('edificio_id')) {
            $query->where('edificio_id', $request->edificio_id);
        }

        // 📅 FILTRO MES
        if ($mesSeleccionado != 'todos') {

            $mes = str_pad($mesSeleccionado, 2, '0', STR_PAD_LEFT);

            $query->whereRaw("DATE_FORMAT(fecha_inicio, '%m') = ?", [$mes]);
        }

        $checkouts = $query->get();

        // 🏢 EDIFICIOS
        $edificios = Edificio::orderBy('nombre')->get();

        return view('checkouts.cerrados', compact(
            'checkouts',
            'edificios',
            'mesSeleccionado'
        ));
    }

    public function create()
    {
        return view('checkouts.create', [
            'edificios' => Edificio::all(),
            'articulos' => Articulos::all(),
            'tecnicos' => Tecnicos::where('activo', 1)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'edificio_id' => 'required',
            'tecnico_id' => 'required',
            'bloque' => 'required',
            'monto_neto' => 'nullable|numeric',
        ]);

        $checkout = Checkout::create([
            'edificio_id' => $request->edificio_id,
            'tecnico_id' => $request->tecnico_id,
            'bloque' => $request->bloque,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_termino' => $request->fecha_termino,
            'monto_neto' => $request->monto_neto,
            'estado' => 'pendiente',
        ]);

        // 📄 PDFs
        if ($request->hasFile('pdf_solicitud')) {
            $checkout->pdf_solicitud = $request->file('pdf_solicitud')->store('', 'public_direct');
        }

        if ($request->hasFile('pdf_entrega')) {
            $checkout->pdf_entrega = $request->file('pdf_entrega')->store('', 'public_direct');
        }

        $checkout->save();

        return redirect()
            ->route('checkouts.index')
            ->with('success', 'Check-Out #' . $checkout->id . ' guardado correctamente.');
    }

    public function show($id)
    {
        $checkout = Checkout::with(['edificio', 'tecnico', 'detalles.articulo'])->findOrFail($id);

        $tecnicos = Tecnicos::where('activo', 1)->get();
        $articulos = Articulos::where('activo', 1)->get();

        return view('checkouts.show', compact('checkout', 'tecnicos', 'articulos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $checkout = Checkout::with(['detalles'])->findOrFail($id);

        $tecnicos = Tecnicos::where('activo', 1)->get();
        $edificios = Edificio::all();

        return view('checkouts.edit', compact('checkout', 'tecnicos', 'edificios'));
    }

    /*public function update(Request $request, $id)
    {
        $checkout = Checkout::findOrFail($id);

        $checkout->tecnico_id = $request->tecnico_id;
        $checkout->save();

        return back()->with('success', 'Técnico actualizado correctamente.');
    }*/
    public function update(Request $request, $id)
    {
        $checkout = Checkout::findOrFail($id);

        $request->validate([
            'edificio_id' => 'required',
            'tecnico_id' => 'required',
            'bloque' => 'required',
            'monto_neto' => 'nullable|numeric',
        ]);

        $checkout->update([
            'edificio_id' => $request->edificio_id,
            'tecnico_id' => $request->tecnico_id,
            'bloque' => $request->bloque,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_termino' => $request->fecha_termino,
            'monto_neto' => $request->monto_neto,
        ]);

        // 📄 PDFs (reemplazo opcional)
        if ($request->hasFile('pdf_solicitud')) {
            $checkout->pdf_solicitud = $request->file('pdf_solicitud')->store('', 'public_direct');
        }

        if ($request->hasFile('pdf_entrega')) {
            $checkout->pdf_entrega = $request->file('pdf_entrega')->store('', 'public_direct');
        }

        $checkout->save();

        return redirect()->route('checkouts.index')->with('success', 'Check-Out actualizado correctamente');
    }

    public function destroy($id)
    {
        $checkout = Checkout::findOrFail($id);
        $checkout->delete();

        return back()->with('success', 'Check-Out eliminado correctamente');
    }

    public function papelera()
    {
        $checkouts = Checkout::onlyTrashed()
            ->with(['edificio', 'tecnico'])
            ->get();

        return view('checkouts.papelera', compact('checkouts'));
    }

    public function restaurar($id)
    {
        $checkout = Checkout::onlyTrashed()->findOrFail($id);
        $checkout->restore();

        return back()->with('success', 'Check-Out restaurado correctamente');
    }

    public function forceDelete($id)
    {
        $checkout = Checkout::onlyTrashed()->findOrFail($id);
        $checkout->forceDelete();

        return back()->with('success', 'Check-Out eliminado definitivamente');
    }

    public function agregarArticulos(Request $request, $id)
    {
        $checkout = Checkout::findOrFail($id);

        if ($request->has('articulos')) {
            foreach ($request->articulos as $a) {
                // Si ya existe el artículo, suma la cantidad
                $detalle = $checkout->detalles()->where('articulo_id', $a['id'])->first();

                if ($detalle) {
                    $detalle->cantidad += $a['cantidad'];
                    $detalle->save();
                } else {
                    Checkout_detalles::create([
                        'checkout_id' => $checkout->id,
                        'articulo_id' => $a['id'],
                        'cantidad' => $a['cantidad'],
                    ]);
                }
            }
        }

        return back()->with('success', 'Artículos agregados correctamente.');
    }

    public function finalizar($id)
    {
        $checkout = Checkout::findOrFail($id);

        $checkout->estado = 'finalizado';
        $checkout->fecha_termino = now(); // opcional

        $checkout->save();

        return back()->with('success', 'Check-Out finalizado correctamente');
    }

    public function cambiarEstado(Request $request, $id)
    {
        $checkout = Checkout::findOrFail($id);

        // Asignar nuevo estado directamente
        $checkout->estado = $request->estado;

        // Si pasa a finalizado, guardar fecha
        if ($request->estado == 'finalizado') {
            $checkout->fecha_termino = now();
        }

        $checkout->save();

        return back()->with('success', 'Estado actualizado');
    }

    public function agregarObservacion(Request $request, $id)
    {
        $request->validate([
            'observacion' => 'required|string',
        ]);

        CheckoutObservacion::create([
            'checkout_id' => $id,
            'observacion' => $request->observacion,
        ]);

        return back()->with('success', 'Observación agregada');
    }

    public function historial($id)
    {
        $checkout = Checkout::with('observaciones')->findOrFail($id);

        return view('checkouts.historial', compact('checkout'));
    }

    public function guardarDocumentos(Request $request, $id)
    {
        $checkout = Checkout::findOrFail($id);

        $checkout->nro_oc = $request->nro_oc;
        $checkout->nro_factura = $request->nro_factura;

        if ($request->hasFile('pdf_oc')) {
            $checkout->pdf_oc = $request->file('pdf_oc')->store('', 'public_direct');
        }

        if ($request->hasFile('pdf_factura')) {
            $checkout->pdf_factura = $request->file('pdf_factura')->store('', 'public_direct');
        }

        $checkout->save();

        return back()->with('success', 'Documentos guardados correctamente');
    }

    public function pdf($id)
    {
        $checkout = Checkout::with(['edificio', 'tecnico'])->findOrFail($id);

        $pdf = Pdf::loadView('checkouts.pdf', compact('checkout'));

        return $pdf->download('checkout_' . $checkout->id . '.pdf');
    }

    // =========================================================================
    // 📑 MÉTODOS DE COTIZACIONES
    // =========================================================================

    public function createCotizacion($id)
    {
        $checkout = Checkout::with(['edificio'])->findOrFail($id);

        // 1. Obtener la última cotización registrada en el sistema
        $ultimaCotizacion = CheckoutCotizacion::orderBy('id', 'desc')->first();

        if ($ultimaCotizacion && preg_match('/\d+/', $ultimaCotizacion->numero_cotizacion, $matches)) {
            // Extrae los números del folio (ej. 161) y le suma 1 (162)
            $siguienteNumero = (int) $matches[0] + 1;
        } else {
            // Si no hay ninguna cotización previa, arranca en 1
            $siguienteNumero = 1;
        }

        // 2. Formatear con ceros a la izquierda (ej. COT-RV-0162)
        $siguienteCorrelativo = 'COT-RV-' . str_pad($siguienteNumero, 4, '0', STR_PAD_LEFT);

        return view('checkouts.cotizaciones.create', compact('checkout', 'siguienteCorrelativo'));
    }

    public function storeCotizacion(Request $request, $id)
    {
        $checkout = Checkout::findOrFail($id);

        $request->validate([
            'numero_cotizacion' => 'required|string|max:100',
            'fecha' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.detalle' => 'required|string',
            'items.*.valor_unitario' => 'required|numeric|min:0',
            'items.*.unidades' => 'required|numeric|min:1',
        ]);

        $subtotal = 0;
        foreach ($request->items as $item) {
            $subtotal += ($item['valor_unitario'] * $item['unidades']);
        }

        $iva = (int) round($subtotal * 0.19);
        $total = $subtotal + $iva;

        $cotizacion = CheckoutCotizacion::create([
            'checkout_id' => $checkout->id,
            'numero_cotizacion' => $request->numero_cotizacion,
            'fecha' => $request->fecha,
            'cliente_nombre' => $request->cliente_nombre,
            'contacto' => $request->contacto,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'departamento' => $request->departamento,
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total,
            'observaciones' => $request->observaciones,
            'estado' => 'pendiente',
        ]);

        foreach ($request->items as $item) {
            CheckoutCotizacionDetalle::create([
                'checkout_cotizacion_id' => $cotizacion->id,
                'detalle_servicio' => $item['detalle'],
                'valor_unitario' => $item['valor_unitario'],
                'unidades' => $item['unidades'],
                'total_linea' => ($item['valor_unitario'] * $item['unidades']),
            ]);
        }

        return redirect()->route('checkouts.index')->with('success', 'Cotización ' . $cotizacion->numero_cotizacion . ' creada exitosamente.');
    }

    public function cambiarEstadoCotizacion(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,autorizada',
        ]);

        $cotizacion = CheckoutCotizacion::findOrFail($id);
        $cotizacion->estado = $request->estado;
        $cotizacion->save();

        return back()->with('success', 'Estado de la cotización actualizado.');
    }

    public function eliminarCotizacion($id)
    {
        $cotizacion = CheckoutCotizacion::findOrFail($id);
        $cotizacion->delete();

        return back()->with('success', 'Cotización eliminada correctamente.');
    }

    public function pdfCotizacion($id)
    {
        $cotizacion = CheckoutCotizacion::with(['detalles', 'checkout.edificio'])->findOrFail($id);

        $pdf = Pdf::loadView('checkouts.cotizaciones.pdf', compact('cotizacion'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('Cotizacion_' . $cotizacion->numero_cotizacion . '.pdf');
    }

    public function generadorFirmas()
    {
        return view('firmas.index');
    }
}
