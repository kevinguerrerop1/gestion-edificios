<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Models\Edificio;
use App\Models\Articulos;
use App\Models\Tecnicos;
use App\Models\CheckoutObservacion;
use App\Models\Checkout_detalles;

class CheckoutController extends Controller
{
    public function index()
    {
        /*$checkouts = Checkout::with(['edificio', 'detalles'])
            ->latest()
            ->get();

        return view('checkouts.index', compact('checkouts'));*/
        $checkouts = Checkout::with(['edificio', 'tecnico', 'detalles'])
            ->where('estado', '!=', 'finalizado') // 🔥 ESTA ES LA CLAVE
            ->get();

        return view('checkouts.index', compact('checkouts'));
    }

    public function cerrados()
    {
        $checkouts = Checkout::with(['edificio', 'tecnico', 'detalles'])
            ->where('estado', 'finalizado')
            ->get();

        return view('checkouts.cerrados', compact('checkouts'));
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
        //dd(public_path('checkout'));

        $request->validate([
            'edificio_id' => 'required',
            'tecnico_id' => 'required',
            'bloque' => 'required',
        ]);

        // 🔹 Crear checkout
        $checkout = Checkout::create([
            'edificio_id' => $request->edificio_id,
            'tecnico_id' => $request->tecnico_id,
            'bloque' => $request->bloque,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_termino' => $request->fecha_termino,
            'estado' => 'pendiente',
        ]);

        // 🔥 Guardar artículos (DETALLES)
        if ($request->has('articulos')) {
            foreach ($request->articulos as $a) {
                Checkout_detalles::create([
                    'checkout_id' => $checkout->id,
                    'articulo_id' => $a['id'],
                    'cantidad' => $a['cantidad'],
                ]);
            }
        }

        // 📄 PDFs
        if ($request->hasFile('pdf_solicitud')) {
            $checkout->pdf_solicitud = $request->file('pdf_solicitud')->store('', 'public_direct');
        }

        if ($request->hasFile('pdf_entrega')) {
            $checkout->pdf_entrega = $request->file('pdf_entrega')->store('', 'public_direct');
        }

        $checkout->save();
        //dd($checkout->pdf_solicitud, $checkout->pdf_entrega);
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
            'bloque' => 'required'
        ]);

        // 🔹 Actualizar datos básicos
        $checkout->update([
            'edificio_id' => $request->edificio_id,
            'tecnico_id' => $request->tecnico_id,
            'bloque' => $request->bloque,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_termino' => $request->fecha_termino,
        ]);

        // 🔥 PDFs (reemplazo opcional)
        if ($request->hasFile('pdf_solicitud')) {
            $checkout->pdf_solicitud = $request->file('pdf_solicitud')
                ->store('', 'public_direct');
        }

        if ($request->hasFile('pdf_entrega')) {
            $checkout->pdf_entrega = $request->file('pdf_entrega')
                ->store('', 'public_direct');
        }

        $checkout->save();

        return redirect()->route('checkouts.index')
            ->with('success', 'Check-Out actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkout $checkout)
    {
        //
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
            'observacion' => 'required|string'
        ]);

        CheckoutObservacion::create([
            'checkout_id' => $id,
            'observacion' => $request->observacion
        ]);

        return back()->with('success', 'Observación agregada');
    }

    public function historial($id)
    {
        $checkout = Checkout::with('observaciones')->findOrFail($id);

        return view('checkouts.historial', compact('checkout'));
    }
}
