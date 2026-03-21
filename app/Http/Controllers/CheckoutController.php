<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Models\Edificio;
use App\Models\Articulos;
use App\Models\Tecnicos;
use App\Models\Checkout_detalles;

class CheckoutController extends Controller
{
    public function index()
    {
        $checkouts = Checkout::with(['edificio', 'detalles'])
            ->latest()
            ->get();

        return view('checkouts.index', compact('checkouts'));
    }

    public function create()
    {
        return view('checkouts.create', [
            'edificios' => Edificio::all(),
            'articulos' => Articulos::all(),
            'tecnicos'  => Tecnicos::where('activo',1)->get()
        ]);
    }

    public function store(Request $request)
    {
        //dd(public_path('checkout'));

        $request->validate([
            'edificio_id' => 'required',
            'tecnico_id' => 'required',
            'bloque' => 'required'
        ]);

        // 🔹 Crear checkout
        $checkout = Checkout::create([
            'edificio_id' => $request->edificio_id,
            'tecnico_id' => $request->tecnico_id,
            'bloque' => $request->bloque,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_termino' => $request->fecha_termino,
        ]);

        // 🔥 Guardar artículos (DETALLES)
        if ($request->has('articulos')) {
            foreach ($request->articulos as $a) {
                Checkout_detalles::create([
                    'checkout_id' => $checkout->id,
                    'articulo_id' => $a['id'],
                    'cantidad' => $a['cantidad']
                ]);
            }
        }

        // 📄 PDFs
        if ($request->hasFile('pdf_solicitud')) {
            $checkout->pdf_solicitud = $request->file('pdf_solicitud')
                ->store('', 'public_direct');
        }

        if ($request->hasFile('pdf_entrega')) {
            $checkout->pdf_entrega = $request->file('pdf_entrega')
                ->store('', 'public_direct');
        }

        $checkout->save();
        //dd($checkout->pdf_solicitud, $checkout->pdf_entrega);
        return back()->with('success', 'Checkout guardado correctamente');
    }

    public function show($id)
    {
        $checkout = Checkout::with([
            'edificio',
            'tecnico',
            'detalles.articulo'
        ])->findOrFail($id);

        return view('checkouts.show', compact('checkout'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
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
}
