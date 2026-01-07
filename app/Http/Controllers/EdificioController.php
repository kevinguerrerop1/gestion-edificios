<?php

namespace App\Http\Controllers;

use App\Models\Edificio;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class EdificioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $edificios = Edificio::withCount('gestiones')->orderBy('id')->get();

        return view('edificios.index', compact('edificios'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('edificios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'comuna'    => 'nullable|string|max:255',
        ]);

        Edificio::create(
            $request->only('nombre', 'direccion', 'comuna')
        );

        return redirect()
            ->route('edificios.index')
            ->with('success', 'Edificio creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Edificio  $edificio
     * @return \Illuminate\Http\Response
     */
    public function show(Edificio $edificio)
    {
        //
    }

    public function edit(Edificio $edificio)
    {
        return view('edificios.edit', compact('edificio'));
    }

    public function update(Request $request, Edificio $edificio)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'ciudad' => 'nullable|string|max:255',
        ]);

        $edificio->update($request->only('nombre', 'direccion', 'ciudad'));

        return redirect()
            ->route('edificios.index')
            ->with('success', 'Edificio actualizado correctamente');
    }
    public function destroy(Edificio $edificio)
    {
        //
    }

    public function qr($id)
{
    $edificio = Edificio::findOrFail($id);

    $url = route('gestiones.nueva', $edificio->id);

    $qrSvg = QrCode::format('svg')
        ->size(300)
        ->generate($url);

    return view('edificios.qr', compact('edificio', 'url', 'qrSvg'));
}

    public function imprimirQR($id)
    {
        $edificio = Edificio::findOrFail($id);

        $url = route('gestiones.nueva', $edificio->id);

        QrCode::format('svg')
    ->size(300)
    ->errorCorrection('H')
    ->encoding('UTF-8')
    ->generate($url);

        $pdf = Pdf::loadView('edificios.qr', compact('edificio', 'qr'));

        return $pdf->download("QR-{$edificio->nombre}.pdf");
    }

    public function qrPdf($id)
    {
        $edificio = Edificio::findOrFail($id);

        // URL a donde apunta el QR (ej: formulario "nueva")
        $url = route('gestiones.nueva', $edificio->id);

        // Generar QR en base64 (evita problemas con imagick)
        $qr = base64_encode(
            QrCode::format('svg')
    ->size(300)
    ->errorCorrection('H')
    ->encoding('UTF-8')
    ->generate($url)
        );

        $pdf = Pdf::loadView('edificios.qr_pdf', compact('edificio', 'qr'));

        return $pdf->download('QR_edificio_'.$edificio->id.'.pdf');
}

}
