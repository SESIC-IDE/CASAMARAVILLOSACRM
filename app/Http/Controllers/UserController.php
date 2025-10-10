<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Mostrar listado de usuarios (solo admin).
     */
    public function index(Request $request)
    {
        $query = User::query();

        // 🔍 Búsqueda por nombre o correo
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%");
        }

        // 📋 Orden y paginación
        $users = $query->orderBy('id', 'asc')->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Mostrar formulario para crear usuario.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Guardar un nuevo usuario.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
            'password' => 'required|confirmed|min:6',
            'status' => 'nullable|boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status ?? true,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', '✅ Usuario creado correctamente.');
    }

    /**
     * Mostrar formulario para editar un usuario existente.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Actualizar datos de usuario.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$user->id}",
            'role' => 'required|string',
            'status' => 'required|boolean',
            'password' => 'nullable|confirmed|min:6',
        ]);

        // 🚫 Evitar que el admin se inhabilite a sí mismo
        if (auth()->id() === $user->id && $request->status == 0) {
            return back()->with('error', 'No puedes inactivar tu propio usuario.');
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
            'password' => $request->filled('password')
                ? Hash::make($request->password)
                : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', '✅ Usuario actualizado correctamente.');
    }

    /**
     * Eliminar usuario.
     */
    public function destroy(User $user)
    {
        // Evita que el administrador se elimine a sí mismo
        if (auth()->id() === $user->id) {
            return back()->with('error', '🚫 No puedes eliminar tu propio usuario.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', '🗑️ Usuario eliminado correctamente.');
    }

    /**
     * Activar o inactivar usuario (AJAX).
     */
    public function toggleStatus(User $user)
    {
        // 🚫 Evita que el admin cambie su propio estado
        if (auth()->id() === $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'No puedes cambiar tu propio estado.'
            ], 403);
        }

        $user->status = !$user->status;
        $user->save();

        return response()->json([
            'success' => true,
            'status' => $user->status,
            'message' => $user->status ? '✅ Usuario activado' : '⚠️ Usuario inactivado'
        ]);
    }
}
