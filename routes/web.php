<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(["middleware" => "guest"], function(){
   
    Route::get('/', function () {
        return view('home');
    });

    Route::get("/iniciar-sesion", "App\Http\Controllers\AuthController@showLogin")->name("iniciar-sesion");
    Route::post("/do-login", "App\Http\Controllers\AuthController@doLogin");



});

Route::group(["middleware" => "auth"], function(){
    Route::get("/panel", "App\Http\Controllers\DashboardController@index");

    Route::get("/vacunas", "App\Http\Controllers\VaccinationController@index");
    Route::post("/vacunas", "App\Http\Controllers\VaccinationController@store");
    Route::put("/vacunas/{vaccination}", "App\Http\Controllers\VaccinationController@update");    
    Route::delete("/vacunas/{vaccination}", "App\Http\Controllers\VaccinationController@destroy");

    Route::get("/calles", "App\Http\Controllers\StreetController@index");
    Route::post("/calles", "App\Http\Controllers\StreetController@store");
    Route::put("/calles/{street}", "App\Http\Controllers\StreetController@update");    
    Route::delete("/calles/{street}", "App\Http\Controllers\StreetController@destroy");

    Route::get("/calles/{street}/casas", "App\Http\Controllers\HouseController@index");
    Route::post("/casas", "App\Http\Controllers\HouseController@store");
    Route::put("/casas/{house}", "App\Http\Controllers\HouseController@update");    
    Route::delete("/casas/{house}", "App\Http\Controllers\HouseController@destroy");

    Route::get("/personas", "App\Http\Controllers\PersonController@index");
    Route::get("/personas/{person}", "App\Http\Controllers\PersonController@show")->where("person","/d+");
    Route::get("/personas/crear", "App\Http\Controllers\PersonController@create");
    Route::post("/personas", "App\Http\Controllers\PersonController@store");
    Route::get("/personas/editar/{person}", "App\Http\Controllers\PersonController@edit");
    Route::put("/personas/{person}", "App\Http\Controllers\PersonController@update");
    Route::delete("/personas/{person}", "App\Http\Controllers\PersonController@destroy");


    Route::get("/logout", "App\Http\Controllers\AuthController@logout");


});

