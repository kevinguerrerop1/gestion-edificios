<?php

namespace App\Http\Controllers;

use App\Models\Tecnicos;
use Illuminate\Http\Request;

class TecnicosController extends Controller
{
    public function index()
    {
        $tecnicos = Tecnicos::orderBy('nombre')->get();

        return view('tecnicos.index', compact('tecnicos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email'  => 'nullable|email|max:255'
        ]);

        Tecnicos::create([
            'nombre' => $request->nombre,
            'email'  => $request->email,
            'activo' => true
        ]);

        return back()->with('success', 'Técnico creado correctamente');
    }

    public function toggle($id)
    {
        $tecnico = Tecnicos::findOrFail($id);

        $tecnico->activo = !$tecnico->activo;
        $tecnico->save();

        return back()->with('success', 'Estado actualizado');
    }

    public function destroy($id)
    {
        // 🔥 RECOMENDACIÓN: en vez de eliminar, desactivar
        $tecnico = Tecnicos::findOrFail($id);

        $tecnico->activo = false;
        $tecnico->save();

        return back()->with('success', 'Técnico desactivado');
    }

    // (Opcional) si después quieres editar inline
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email'  => 'nullable|email|max:255'
        ]);

        $tecnico = Tecnicos::findOrFail($id);

        $tecnico->update([
            'nombre' => $request->nombre,
            'email'  => $request->email
        ]);

        return back()->with('success', 'Técnico actualizado');
    }
}
