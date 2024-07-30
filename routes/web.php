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

Route::get('/api/findAnimalName/{name}', [AnimalController::class, 'findAnimalName']);
Route::post('/api/uploadImage', [AnimalController::class, 'uploadImage']);
Route::get('/api/showAllImages', [AnimalController::class,'showAllImages']);

Route::resource('Animal', AnimalController::class);
