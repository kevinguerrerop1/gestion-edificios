<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Valida que solo el administrador pueda usar este mantenedor.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->check() || auth()->user()->rol !== 'admin') {
                abort(403, 'Acceso denegado: esta sección es exclusiva para el administrador.');
            }
            return $next($request);
        });
    }

    /**
     * Listado de usuarios.
     */
    public function index()
    {
        $usuarios = User::orderBy('name')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Formulario nuevo usuario.
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Guardar usuario en la BD.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'rol'      => ['required', Rule::in(['admin', 'supervisor'])],
        ], [
            'email.unique'       => 'Este correo electrónico ya se encuentra registrado.',
            'password.confirmed' => 'Las contraseñas ingresadas no coinciden.',
            'password.min'       => 'La contraseña debe tener al menos 6 caracteres.',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'rol'      => $request->rol,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario registrado correctamente.');
    }

    /**
     * Formulario de edición.
     */
    public function edit(User $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Actualizar datos y contraseña opcional.
     */
    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => ['required', 'email', 'max:255', Rule::unique('users')->ignore($usuario->id)],
            'rol'      => ['required', Rule::in(['admin', 'supervisor'])],
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'email.unique'       => 'Este correo ya pertenece a otro usuario.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min'       => 'La nueva contraseña debe tener al menos 6 caracteres.',
        ]);

        $usuario->name  = $request->name;
        $usuario->email = $request->email;
        $usuario->rol   = $request->rol;

        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Eliminar usuario.
     */
    public function destroy(User $usuario)
    {
        if ($usuario->id === auth()->id()) {
            return back()->with('error', 'No puedes eliminar la cuenta con la que tienes la sesión iniciada.');
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
