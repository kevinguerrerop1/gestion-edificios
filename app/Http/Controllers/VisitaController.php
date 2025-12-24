<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use App\Mail\VisitaConfirmada;
use Illuminate\Support\Facades\Mail;
use App\Models\gestiones;
use Illuminate\Http\Request;

class VisitaController extends Controller
{

    public function index()
    {
        //
    }

    public function create($gestion_id)
    {
        $gestion = Gestiones::findOrFail($gestion_id);
        return view('visitas.create', compact('gestion'));
    }

    public function store(Request $request, $gestion_id)
    {
        $request->validate([
            'fecha_visita' => 'required|date',
            'hora_visita' => 'required'
        ]);

        $gestion = Gestiones::findOrFail($gestion_id);

        Visita::create([
            'gestion_id' => $gestion->id,
            'fecha_visita' => $request->fecha_visita,
            'hora_visita' => $request->hora_visita,
            'estado' => 'en_proceso'
        ]);

        //PASAR GESTIÓN A EN PROCESO (solo si aún no lo está)
        if ($gestion->estado === 'pendiente') {
            $gestion->update([
                'estado' => 'en_proceso'
            ]);
        }

        /*if (!empty($gestion->email_contacto)) {
            Mail::to($gestion->email_contacto)->send(
                new VisitaConfirmada($gestion, $request->fecha_visita, $request->hora_visita)
            );
        }*/
            // Envío de correo
        if (!empty($gestion->email_contacto)) {
            Mail::to($gestion->email_contacto)->send(
                new VisitaConfirmada(
                    $gestion,
                    $request->fecha_visita,
                    $request->hora_visita
                )
            );
        }

        return redirect()
            ->route('visitas.historial', $gestion->id)
            ->with('success', 'Visita agendada con éxito');
    }

    public function historial($gestion_id)
    {
        $gestion = Gestiones::findOrFail($gestion_id);
        $visitas = $gestion->visitas()->orderBy('fecha_visita', 'desc')->get();

        return view('visitas.historial', compact('gestion', 'visitas'));
    }


    public function show(Visita $visita)
    {
        //
    }

    public function edit(Visita $visita)
    {
        //
    }

    public function update(Request $request, Visita $visita)
    {
        //
    }

    public function destroy(Visita $visita)
    {
        //
    }
}
