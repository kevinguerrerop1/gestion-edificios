<?php

namespace App\Http\Controllers;

use App\Models\Edificio;
use Illuminate\Http\Request;

class EdificioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $edificios = Edificio::withCount('gestiones')->orderBy('nombre')->get();

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
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'ciudad' => 'nullable|string|max:255',
        ]);

        Edificio::create($request->only('nombre', 'direccion', 'ciudad'));

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
}
