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
    Route::get("/calles", "App\Http\Controllers\StreetController@indexApi");
    Route::get("/calles/{street}/casas", "App\Http\Controllers\StreetController@housesApi");
    

    Route::post("/personas/verificar-cedula", "App\Http\Controllers\PersonController@verificateDniApi");
});
