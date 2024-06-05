<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\HotelPhotoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//RUTAS PARA DEPARTAMENTO
Route::get('departments', [DepartmentController::class, 'index']);
Route::post('departments', [DepartmentController::class, 'create']);


//RUTAS PARA HOTELES
Route::get('hotels', [HotelController::class, 'index']);
Route::post('hotels', [HotelController::class, 'store']);
Route::post('hotel', [HotelController::class, 'create']);
Route::put('hotels/{hotel}',[HotelController::class, 'update']);
Route::patch('hotels/{hotel}',[HotelController::class, 'update']);
Route::delete('hotels/{hotel}', [HotelController::class, 'delete']);



//photos
Route::post('hotel/photo/file',[HotelPhotoController::class, 'storeFile']);
