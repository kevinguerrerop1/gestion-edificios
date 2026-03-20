<?php

namespace App\Http\Controllers;

use App\Models\Articulos;
use Illuminate\Http\Request;

class ArticulosController extends Controller
{
    public function index()
    {
        $articulos = Articulos::orderBy('nombre')->get();
        return view('articulos.index', compact('articulos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        Articulos::create([
            'nombre' => $request->nombre,
            'activo' => true
        ]);

        return back()->with('success', 'Artículo creado correctamente');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $articulo = Articulos::findOrFail($id);

        $articulo->update([
            'nombre' => $request->nombre
        ]);

        return back()->with('success', 'Artículo actualizado correctamente');
    }

    public function destroy($id)
    {
        Articulos::destroy($id);
        return back()->with('success', 'Artículo eliminado');
    }

    public function toggle($id)
    {
        $articulo = Articulos::findOrFail($id);
        $articulo->activo = !$articulo->activo;
        $articulo->save();

        return back()->with('success', 'Estado actualizado');
    }
}
