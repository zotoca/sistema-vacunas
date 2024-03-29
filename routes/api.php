<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(["middleware" => "auth"],function(){
    
    Route::get("/vacunas", "App\Http\Controllers\VaccinationController@indexApi");
    
    Route::post("/personas/verificar-cedula", "App\Http\Controllers\PersonController@verificateDniApi");


    Route::post("/vacunas-personas", "App\Http\Controllers\PersonVaccinationController@store");
    Route::put("/vacunas-personas/{person_vaccination}", "App\Http\Controllers\PersonVaccinationController@update");
    Route::delete("/vacunas-personas/{person_vaccination}", "App\Http\Controllers\PersonVaccinationController@delete");
});
