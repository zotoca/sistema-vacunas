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

    Route::get("/logout", "App\Http\Controllers\AuthController@logout");
});