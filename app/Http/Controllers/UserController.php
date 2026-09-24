<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Valida que solo el administrador pueda usar el mantenedor,
     * excepto el cambio de clave propio al que puede entrar cualquier usuario autenticado.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->check() || auth()->user()->rol !== 'admin') {
                abort(403, 'Acceso denegado: esta sección es exclusiva para el administrador.');
            }
            return $next($request);
        })->except(['editPassword', 'updatePassword']);
    }

    public function editPassword()
    {
        return view('usuarios.password');
    }

    /**
     * Procesar el cambio de la propia contraseña.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password'         => ['required', 'string', 'min:6', 'confirmed', 'different:current_password'],
        ], [
            'current_password.required' => 'Debes ingresar tu contraseña actual.',
            'password.required'         => 'Debes ingresar una nueva contraseña.',
            'password.min'              => 'La nueva contraseña debe tener al menos 6 caracteres.',
            'password.confirmed'        => 'La confirmación de la nueva contraseña no coincide.',
            'password.different'        => 'La nueva contraseña no puede ser idéntica a la actual.',
        ]);

        $user = User::find(Auth::id());

        // Verificar que la clave actual sea correcta
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'La contraseña actual no es correcta.'
            ])->withInput();
        }

        // Actualizar la contraseña
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', '¡Tu contraseña ha sido actualizada correctamente!');
    }

    /**
     * Listado de usuarios (ocultando tu cuenta).
     */
    public function index()
    {
        $usuarios = User::where('email', '!=', 'kevinguerrerop1@gmail.com')
            ->orderBy('name')
            ->get();

        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Formulario para crear un nuevo usuario.
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Guardar el nuevo usuario.
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
     * Formulario para editar un usuario existente.
     */
    public function edit(User $usuario)
    {
        if ($usuario->email === 'kevinguerrerop1@gmail.com') {
            abort(403, 'No tienes permisos para modificar este usuario.');
        }

        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Actualizar los datos del usuario.
     */
    public function update(Request $request, User $usuario)
    {
        if ($usuario->email === 'kevinguerrerop1@gmail.com') {
            abort(403, 'No tienes permisos para modificar este usuario.');
        }

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
     * Eliminar un usuario.
     */
    public function destroy(User $usuario)
    {
        if ($usuario->email === 'kevinguerrerop1@gmail.com' || $usuario->id === auth()->id()) {
            return back()->with('error', 'Esta cuenta está protegida y no puede ser eliminada.');
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
