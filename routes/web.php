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

    Route::get('/desarrolladores', function () {
        return view('developers');
    });
    
    Route::get("/iniciar-sesion", "App\Http\Controllers\AuthController@showLogin")->name("iniciar-sesion");
    Route::post("/do-login", "App\Http\Controllers\AuthController@doLogin");
});

Route::get("/noticias", "App\Http\Controllers\NewsController@index");


Route::group(["middleware" => "auth"], function(){
    Route::get("/panel", "App\Http\Controllers\DashboardController@index");
    
    Route::get("/calendarios-de-vacunas", "App\Http\Controllers\PersonVaccinationController@index");

    Route::get("/vacunas", "App\Http\Controllers\VaccinationController@index");
    Route::post("/vacunas", "App\Http\Controllers\VaccinationController@store");
    Route::put("/vacunas/{vaccination}", "App\Http\Controllers\VaccinationController@update");    
    Route::delete("/vacunas/{vaccination}/eliminar", "App\Http\Controllers\VaccinationController@destroy");
    
    Route::get("/personas", "App\Http\Controllers\PersonController@index");
    Route::get("/personas/crear", "App\Http\Controllers\PersonController@create");
    Route::post("/personas", "App\Http\Controllers\PersonController@store");
    Route::get("/personas/{person}", "App\Http\Controllers\PersonController@show");
    Route::get("/personas/{person}/editar", "App\Http\Controllers\PersonController@edit");
    Route::put("/personas/{person}", "App\Http\Controllers\PersonController@update");
    Route::get("/personas/{person}/vacunas-personas", "App\Http\Controllers\PersonController@personVaccinations");    
    Route::delete("/personas/{person}", "App\Http\Controllers\PersonController@destroy");
    
    Route::get("/administradores", "App\Http\Controllers\AdministratorController@index");
    Route::get("/administradores/crear", "App\Http\Controllers\AdministratorController@create");
    Route::get("/administradores/{user}/editar", "App\Http\Controllers\AdministratorController@edit");
    Route::post("/administradores", "App\Http\Controllers\AdministratorController@store");
    Route::put("/administradores/{user}", "App\Http\Controllers\AdministratorController@update");
    Route::delete("/administradores/{user}", "App\Http\Controllers\AdministratorController@destroy");
    
    Route::post("/foro/subir-imagen", "App\Http\Controllers\PostController@uploadImage");
    
    Route::get("/foro", "App\Http\Controllers\PostController@index");
    Route::get("/foro/crear", "App\Http\Controllers\PostController@create");
    Route::get("/foro/{post}/editar", "App\Http\Controllers\PostController@edit");
    Route::post("/foro", "App\Http\Controllers\PostController@store");
    
    Route::put("/foro/{post}", "App\Http\Controllers\PostController@update");
    
    Route::get("/foro/{post}", "App\Http\Controllers\PostController@show");
    
    
    Route::delete("/foro/{post}", "App\Http\Controllers\PostController@destroy");
    
    Route::post("/comentarios", "App\Http\Controllers\CommentController@store");
    
    Route::put("/comentarios/{comment}", "App\Http\Controllers\CommentController@update");
    
    Route::delete("/comentarios/{comment}", "App\Http\Controllers\CommentController@destroy");
    
    Route::get("/noticias/crear", "App\Http\Controllers\NewsController@create");
    Route::get("/noticias/{news}/editar", "App\Http\Controllers\NewsController@edit");
    
    Route::get("/registro-personas", "App\Http\Controllers\AdministratorController@userLogs");


    Route::post("/noticias", "App\Http\Controllers\NewsController@store");
    Route::put("/noticias/{news}", "App\Http\Controllers\NewsController@update");
    Route::delete("/noticias/{news}", "App\Http\Controllers\NewsController@destroy");
    Route::post("/noticias/subir-imagen", "App\Http\Controllers\NewsController@uploadImage");
    
    Route::get("/logout", "App\Http\Controllers\AuthController@logout");
    
    
});

Route::get("/noticias/{news}", "App\Http\Controllers\NewsController@show");
Route::get("/noticias/{news}", "App\Http\Controllers\NewsController@show");
