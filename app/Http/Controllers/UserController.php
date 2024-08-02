<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'correo' => 'required|string',
            'contraseña' => 'required|string',
        ]);

        $user = User::create([
            'nombre' => $request->input('nombre'),
            'correo' => $request->input('correo'),
            'contraseña' => $request->input('contraseña'),
        ]);

        return response()->json($user, 201);
    }

    public function show(User $usuario)
    {
        return $usuario;
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'correo' => 'required|string',
            'contraseña' => 'required|string',
        ]);

        $user = User::where('correo', $validatedData['correo'])->first();

        if ($user && $user->contraseña === $validatedData['contraseña']) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'nullable|string',
            'correo' => 'nullable|string',
            'contraseña' => 'nullable|string',
        ]);

        // Buscar el usuario por ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // Actualizar los datos del usuario
        $user->nombre = $request->input('nombre', $user->nombre);
        $user->correo = $request->input('correo', $user->correo);
        $user->contraseña = $request->input('contraseña', $user->contraseña);

        // Guardar los cambios
        $user->save();

        return response()->json($user, 200);
    }


    public function destroy($id)
    {
        //
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
    }
}
