<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\gestiones;
use App\Models\Edificio;
use App\Models\Visita;
use App\Models\Checkout;
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
        $reportesTermos = [
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
            [
                'id' => 'historial_gestion',
                'titulo' => 'Historial de gestión',
                'descripcion' => 'Línea de tiempo completa de una gestión específica.',
                'ruta' => route('reportes.historial_gestion'),
                'requiere_fechas' => false,
            ],
            [
                'id' => 'reporte_maestro',
                'titulo' => 'Reporte general de gestiones',
                'descripcion' => 'Filtra por fecha, edificio y estado.',
                'ruta' => route('reportes.maestro'),
                'requiere_fechas' => true,
            ],
        ];

        $reportesCheckouts = [
            [
                'titulo' => 'Reporte de Checkouts',
                'descripcion' => 'Filtra por técnico, edificio y fechas.',
                'ruta' => route('reportes.checkouts'),
                'requiere_fechas' => true,
            ],
            [
                'titulo' => 'Checkouts finalizados',
                'descripcion' => 'Listado de checkouts cerrados.',
                'ruta' => route('checkouts.cerrados'),
                'requiere_fechas' => false,
            ],
        ];

        return view('reportes.index', compact('reportesTermos', 'reportesCheckouts'));
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

    public function historialGestion(Request $request)
    {
        $gestiones = Gestiones::orderBy('id', 'desc')->get();

        $gestion = null;
        $visitas = collect();

        if ($request->filled('gestion_id')) {
            $gestion = Gestiones::findOrFail($request->gestion_id);

            $visitas = Visita::where('gestion_id', $gestion->id)
                ->orderBy('fecha_visita')
                ->orderBy('hora_visita')
                ->get();
        }

        return view('reportes.historial_gestion', compact(
            'gestiones',
            'gestion',
            'visitas'
        ));
    }

    public function historialGestionPdf($id)
    {
        $gestion = Gestiones::with('edificio')->findOrFail($id);

        $visitas = Visita::where('gestion_id', $id)
            ->orderBy('fecha_visita')
            ->orderBy('hora_visita')
            ->get();

        $pdf = Pdf::loadView('reportes.pdf.historial_gestion', [
            'gestion' => $gestion,
            'visitas' => $visitas
        ])->setPaper('A4', 'portrait');

        return $pdf->download(
            'historial-gestion-' . $gestion->id . '.pdf'
        );
    }

    public function buscarGestion(Request $request)
    {
        $q = $request->get('q');

        return Gestiones::with('edificio')
            ->where('id', 'like', "%{$q}%")
            ->orWhereHas('edificio', function ($query) use ($q) {
                $query->where('nombre', 'like', "%{$q}%");
            })
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($g) {
                return [
                    'id' => $g->id,
                    'text' => 'Gestión #' . $g->id . ' — ' . ($g->edificio->nombre ?? 'Sin edificio'),
                ];
            });
    }

    private function queryReporteMaestro(Request $request)
    {
        $query = Gestiones::with('edificio');

        if ($request->filled(['desde', 'hasta'])) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->desde)->startOfDay(),
                Carbon::parse($request->hasta)->endOfDay()
            ]);
        }

        if ($request->filled('edificio_id')) {
            $query->where('edificio_id', $request->edificio_id);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        return $query->orderBy('created_at', 'desc');
    }

    public function reporteMaestro(Request $request)
    {
        $edificios = Edificio::orderBy('nombre')->get();
        $gestiones = collect();

        if ($request->filled(['desde', 'hasta'])) {
            $gestiones = $this->queryReporteMaestro($request)->get();
        }

        return view('reportes.maestro', compact(
            'gestiones',
            'edificios'
        ));
    }

    public function reporteMaestroPdf(Request $request)
    {
        $gestiones = $this->queryReporteMaestro($request)->get();

        $pdf = Pdf::loadView('reportes.pdf.maestro', [
            'gestiones' => $gestiones,
            'request' => $request
        ])->setPaper('A4', 'landscape');

        return $pdf->download(
            'reporte-gestiones-' . now()->format('d-m-Y') . '.pdf'
        );
    }

    public function checkouts(Request $request)
    {
        $query = \App\Models\Checkout::with(['tecnico', 'edificio']);

        if ($request->tecnico_id) {
            $query->where('tecnico_id', $request->tecnico_id);
        }

        if ($request->edificio_id) {
            $query->where('edificio_id', $request->edificio_id);
        }

        if ($request->desde && $request->hasta) {
            $query->whereBetween('fecha_inicio', [$request->desde, $request->hasta]);
        }

        $checkouts = $query->get();

        $tecnicos = \App\Models\Tecnicos::all();
        $edificios = \App\Models\Edificio::all();

        return view('reportes.checkouts', compact('checkouts', 'tecnicos', 'edificios'));
    }

    public function checkoutsPdf(Request $request)
    {
        $query = \App\Models\Checkout::with(['edificio', 'tecnico']);

        if ($request->filled(['desde', 'hasta'])) {
            $query->whereBetween('fecha_inicio', [
                \Carbon\Carbon::parse($request->desde)->startOfDay(),
                \Carbon\Carbon::parse($request->hasta)->endOfDay()
            ]);
        }

        if ($request->filled('tecnico_id')) {
            $query->where('tecnico_id', $request->tecnico_id);
        }

        if ($request->filled('edificio_id')) {
            $query->where('edificio_id', $request->edificio_id);
        }

        $checkouts = $query->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
            'reportes.pdf.checkouts',
            compact('checkouts')
        )->setPaper('A4', 'landscape');

        return $pdf->download('reporte-checkouts.pdf');
    }

    public function CheckoutsExcel(Request $request)
    {
        $checkouts = Checkout::with(['edificio', 'tecnico'])
            ->whereBetween('fecha_inicio', [$request->desde, $request->hasta])
            ->get();

        return response()->view('reportes.excel.checkouts', compact('checkouts'))
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename="reporte-checkouts.xls"');
    }
}
