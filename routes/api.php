<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/allAnimals', [AnimalController::class, 'index']);
Route::put('/actualizar/{animal}', [AnimalController::class, 'actualizar']);
Route::delete('/eliminar/{animal}', [AnimalController::class, 'eliminar']);
Route::post('/agregar', [AnimalController::class, 'agregar']);
Route::get('/findAnimalName/{name}', [AnimalController::class, 'findAnimalName']);
Route::post('/uploadImage', [AnimalController::class, 'uploadImage']);
Route::get('/showAllImages', [AnimalController::class, 'showAllImages']);


Route::get('/allUsers', [UserController::class, 'index']);
Route::get('/user/{usuario}', [UserController::class, 'show']);
Route::post('/newUser', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);



Route::apiResource('animals', AnimalController::class);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
