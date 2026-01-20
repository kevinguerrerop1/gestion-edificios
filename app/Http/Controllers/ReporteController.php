<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\gestiones;
use App\Models\Edificio;
use App\Models\Visita;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reportes = [
            [
                'id' => 'sin_visita',
                'titulo' => 'Solicitudes sin visita agendada',
                'descripcion' => 'Listado de solicitudes que aún no tienen visita programada.',
                'ruta' => route('reportes.solicitudes_sin_visita'),
                'requiere_fechas' => false,
            ],
            [
                'id' => 'visitas_atrasadas',
                'titulo' => 'Visitas atrasadas',
                'descripcion' => 'Visitas no realizadas cuya fecha ya venció.',
                'ruta' => route('reportes.visitas-atrasadas'),
                'requiere_fechas' => false,
            ],
            [
                'id' => 'finalizadas_por_edificio',
                'titulo' => 'Gestiones finalizadas por edificio',
                'descripcion' => 'Consolidado de gestiones finalizadas por edificio y rango de fechas.',
                'ruta' => route('reportes.gestiones_finalizadas'),
                'requiere_fechas' => true,
            ],
        ];

        return view('reportes.index', compact('reportes'));
    }

    public function solicitudesSinVisita()
    {
        $gestiones = gestiones::with('edificio')
            ->whereDoesntHave('visitas')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reportes.solicitudes_sin_visita', compact('gestiones'));
    }

    public function gestionesFinalizadasPorEdificio(Request $request)
    {
        $edificios = Edificio::orderBy('nombre')->get();

        $gestiones = collect();
        $edificioSeleccionado = null;

        if ($request->filled(['desde', 'hasta', 'edificio_id'])) {

            $edificioSeleccionado = Edificio::find($request->edificio_id);

            $gestiones = gestiones::where('estado', 'finalizada')
                ->where('edificio_id', $request->edificio_id)
                ->whereBetween('created_at', [
                    Carbon::parse($request->desde)->startOfDay(),
                    Carbon::parse($request->hasta)->endOfDay()
                ])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('reportes.gestiones_finalizadas', compact(
            'gestiones',
            'edificios',
            'edificioSeleccionado'
        ));
    }

    public function gestionesFinalizadasPorEdificioPdf(Request $request)
    {
        $request->validate([
            'edificio_id' => 'required',
            'desde' => 'required|date',
            'hasta' => 'required|date',
        ]);

        $edificio = Edificio::findOrFail($request->edificio_id);

        $gestiones = gestiones::where('estado', 'finalizada')
            ->where('edificio_id', $edificio->id)
            ->whereBetween('created_at', [
                Carbon::parse($request->desde)->startOfDay(),
                Carbon::parse($request->hasta)->endOfDay()
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('reportes.pdf.gestiones_finalizadas', [
            'gestiones' => $gestiones,
            'edificio' => $edificio,
            'desde' => $request->desde,
            'hasta' => $request->hasta
        ])->setPaper('A4', 'portrait');

        return $pdf->download(
            'gestiones-finalizadas-' .
            $edificio->nombre . '-' .
            now()->format('d-m-Y') . '.pdf'
        );
    }

    public function sinVisitaPdf()
    {
        $gestiones = gestiones::whereDoesntHave('visitas')
            ->where('estado', 'pendiente')
            ->with('edificio')
            ->orderBy('created_at', 'asc')
            ->get();

        $pdf = Pdf::loadView('reportes.pdf.sin-visita', compact('gestiones'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('solicitudes_sin_visita_agendada.pdf');
    }

    public function visitasAtrasadas()
    {
        $visitas = Visita::where('estado', '!=', 'finalizada')
            ->whereDate('fecha_visita', '<', Carbon::today())
            ->with(['gestion.edificio'])
            ->orderBy('fecha_visita', 'asc')
            ->get();

        return view('reportes.visitas-atrasadas', compact('visitas'));
    }

    public function visitasAtrasadasPdf()
    {
        $visitas = Visita::where('estado', '!=', 'finalizada')
            ->whereDate('fecha_visita', '<', Carbon::today())
            ->with(['gestion.edificio'])
            ->orderBy('fecha_visita', 'asc')
            ->get();

        $pdf = Pdf::loadView('reportes.pdf.visitas-atrasadas', compact('visitas'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('visitas_atrasadas.pdf');
    }
}
