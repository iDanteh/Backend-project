<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

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
            'contrasena' => 'required|string',
            'urlimg' => 'required|string',
        ]);

        $user = User::create([
            'nombre' => $request->input('nombre'),
            'correo' => $request->input('correo'),
            'contrasena' => $request->input('contrasena'), // Almacenar en texto plano
            'urlimg' => $request->input('urlimg'),
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
            'contrasena' => 'required|string',
        ]);
    
        $user = User::where('correo', $validatedData['correo'])->first();

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 200);
        }
    
        if ($user->contrasena === $validatedData['contrasena']) {
            return response()->json(['message' => 'Usuario Correcto', 'usuario' => $user], 200);
        } else {
            return response()->json(['message' => 'Contraseña no valida'], 200);
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
    public function update(User $usuario, Request $request)
    {
        //
        $usuario->update($request->all());
        return response()->json($usuario, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_usuario)
    {
        $usuario = User::find($id_usuario);
        if (!$usuario) {
            return response()->json(["error" => "Usuario no encontrado"], 404);
        }
        $usuario->delete();
        return response()->json(["message" => "Usuario eliminado"], 200);
    }
    
    public function uploadImageUser(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('image/user');
            $image->move($destinationPath, $name);
            return response()->json(['url' => $name], 200);
        } else {
            return response()->json(['error' => 'No se ha subido ninguna imagen'], 404);
        }
    }

    public function showAllImagesUser()
    {
        $imageDirectory = public_path('image/user');
        $images = File::files($imageDirectory);

        if (empty($images)) {
            return response()->json(['error' => 'imagenes no encontradas'], 404);
        }

        $imageData = [];

        foreach ($images as $image) {
            $imageData[] = [
                'path' => $image->getRelativePathname(),
                'url' => $image->getFilename(),
            ];
        }

        return response()->json($imageData, 200);
    }

}
