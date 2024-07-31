<?php

use App\Http\Controllers\AnimalController;
use App\Models\Animal;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::prefix('animal')->group(function () {
//     Route::get('/findAnimalName/{name}', [AnimalController::class, 'findAnimalName']);
//     Route::post('/uploadImage', [AnimalController::class, 'uploadImage']);
//     Route::get('/showAllImages', [AnimalController::class, 'showAllImages']);

//     Route::get('/allAnimals', [AnimalController::class,'index']);
//     Route::put('/actualizar/{animal}', [AnimalController::class, 'actualizar']);
//     Route::delete('/eliminar/{animal}', [AnimalController::class, 'eliminar']);
//     Route::post('/agregar/{animal}', [AnimalController::class,'store']);
// });
// Route::resource('Animal', AnimalController::class);
