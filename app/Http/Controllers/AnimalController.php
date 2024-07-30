<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Animal::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nombre'=>'required|string',
            'longevidad' => 'required|integer',
            'descripcion' => 'required|string',
            'urlimg' => 'required|string',
            'especie' => 'required|string',
        ]);
        $animal = Animal::create($request->all());

        return response()->json($animal, 201);
    }

    public function findAnimalName($name){
        $animal = Animal::where('nombre', $name)->first();
        if (!$animal) {
            return response()->json(["error"=> "Animal no encontrado"],404);
        }
        return response()->json($animal,200);
    }

    public function uploadImage(Request $request, $image)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ( $request->hasFile($image) ) {
            $image = $request->file('image');
            $detinationPath = 'images/';
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $uploadSuccess = $request->file($image)->move($detinationPath, $imageName);
            

        }

        // // Guardar la imagen
        // $image = $request->file('image');
        // $imageName = time() . '.' . $image->getClientOriginalExtension();
        // $image->move(public_path('image'), $imageName);

        // return response()->json(['message' => 'Image uploaded successfully', 'image_name' => $imageName], 200);
    }

    public function showAllImages()
    {
        $imageDirectory = public_path('image');
        $images = File::files($imageDirectory);

        if (empty($images)) {
            return response()->json(['error' => 'No images found'], 404);
        }

        $imageData = [];

        foreach ($images as $image) {
            $imageData[] = [
                'path' => $image->getRelativePathname(),
                'url' => url('image/' . $image->getFilename())
            ];
        }

        return response()->json($imageData, 200);
    }
    /**
     * Display the specified resource.
     */
    public function show(Animal $animal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Animal $animal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animal $animal)
    {
        //
    }
}
