<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use App\Models\gestiones;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VisitaController extends Controller
{

    public function index()
    {
        //
    }

    public function create($gestion_id)
    {
        $gestion = Gestion::findOrFail($gestion_id);
        return view('visitas.create', compact('gestion'));
    }

    public function store(Request $request, $gestion_id)
    {
        $request->validate([
            'fecha_visita' => 'required|date',
            'hora_visita' => 'required'
        ]);

        $gestion = Gestion::findOrFail($gestion_id);

        Visita::create([
            'gestion_id' => $gestion->id,
            'fecha_visita' => $request->fecha_visita,
            'hora_visita' => $request->hora_visita,
            'estado' => 'pendiente'
        ]);

        return redirect()
            ->route('visitas.historial', $gestion->id)
            ->with('success', 'Visita agendada con éxito');
    }

    public function historial($gestion_id)
    {
        $gestion = Gestion::findOrFail($gestion_id);
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
