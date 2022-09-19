<?php

use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 */

Route::group(['as' => 'api.v1.'], function () {
    
    //Rutas para crear usuarios administradores y doctores
    Route::apiResource('/users', UserController::class);

    //Rutas para crear pacientes
    Route::apiResource('/patients', PatientController::class);

    //Rutas para crear historial clínico
    Route::apiResource('/histories', HistoryController::class);

});