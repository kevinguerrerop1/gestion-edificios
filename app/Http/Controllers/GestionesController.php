<?php

namespace App\Http\Controllers;

use App\Models\gestiones;
use Illuminate\Http\Request;

class GestionesController extends Controller
{
    public function index()
    {
        $gestiones = gestiones::orderBy('id','desc')->paginate(10);
        return view('gestiones.index', compact('gestiones'));
    }

    public function pendientes()
    {
        $gestiones = Gestiones::where('estado','pendiente')
            ->orderBy('id','desc')
            ->paginate(10);
            //dd($gestiones);
        return view('gestiones.pendientes', compact('gestiones'));
    }

    public function resueltas()
    {
        $gestiones = Gestiones::where('estado','resuelto')
            ->orderBy('id','desc')
            ->paginate(10);
            //dd($gestiones);
        return view('gestiones.resueltas', compact('gestiones'));
    }

    public function create()
    {
        return view('gestiones.create');
    }

    public function store(Request $request)
    {
        /*$request->validate([
            'departamento' => 'required',
            'titulo' => 'required',
            'descripcion' => 'required'
        ]);
        $data = $request->except('_token');
        //dd($data);
        gestiones::create($data);*/

        $gestion= new gestiones();
        $gestion->departamento=$request->departamento;
        $gestion->titulo=$request->titulo;
        $gestion->descripcion=$request->descripcion;
        $gestion->save();

        return redirect()->route('gestiones.index')
            ->with('success','Solicitud registrada correctamente.');
    }

    public function agendarvisita($id)
    {
        $gestion = Gestion::findOrFail($id);
        return view('gestiones.agendarvisita', compact('gestion'));
    }

    public function storevisita(Request $request, $id)
    {
        $gestion = Gestion::findOrFail($id);
        $gestion->fecha_visita = $request->fecha_visita;
        $gestion->hora_visita = $request->hora_visita;
        $gestion->save();

        return redirect()->route('gestiones.index')
            ->with('success','Visita agendada correctamente.');
    }

    public function show(gestiones $gestiones)
    {
        //
    }

    public function edit(gestiones $gestione)
    {
        //$servicio=gestiones::findOrFail($gestione);
        //return view('servicios.edit',['servicio'=>$servicio]);
        //dd($gestione);
        return view('gestiones.edit', compact('gestione'));
    }

    public function update(Request $request, Gestiones $gestione)
    {
        $gestione->update($request->only('estado'));

        return redirect()->route('gestiones.index')
            ->with('success','Actualizado.');
    }

    public function destroy(gestiones $gestiones)
    {
        //
    }
}
