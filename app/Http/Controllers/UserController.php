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
        //
        $request->validate([
            'nombre' => 'required|string',
            'correo' => 'required|string',
            'contraseña' => 'required|string',
        ]);

        $user = User::create([
            'nombre' => $request->input('nombre'),
            'correo' => $request->input('correo'),
            'contraseña' => Hash::make($request->input('contraseña')),
        ]);

        return response()->json($user, 201);
    }
    public function show(User $usuario)
    {
        return $usuario;
    }

    public function login(Request $request)
    {
        // Validar los datos del request
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'nombre' => 'required|string',
            'contraseña' => 'required|string',
        ]);

        // Buscar el usuario por ID
        $user = User::find($validatedData['id']);

        // Verificar si el usuario existe y si el nombre y la contraseña son correctos
        if ($user && $user->nombre === $validatedData['nombre'] && Hash::check($validatedData['contraseña'], $user->contraseña)) {
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
