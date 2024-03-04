<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Registro de usuario
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// Rutas protegidas por autenticación de Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('usuarios', UserController::class);
});
Route::apiResource('tareas', TareaController::class);

Route::get('unauthorized', function () {
    return response()->json(null, 401);
})->name('unauthorized');

// Route::apiResource('tareas', TareaController::class)->middleware('auth:api');
// Route::apiResource('usuarios', UserController::class)->middleware('auth:api');
