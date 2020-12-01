<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\User;
use Redirect;

class AuthController extends Controller
{
    public function showLogin(){
        return View::make('auth.auth-login');


    }

    public function doLogin(Request $request){
        $validator = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if(Auth::attempt($validator)){
            return Redirect::to("/panel");
        }

        else{
            $errors = [
                'login' => 'El email o contraseña son incorrectos'
            ];
            
            return Redirect::to('/iniciar-sesion')->withErrors($errors);
        }
    }

    public function logout(){
        Auth::logout();
        return Redirect::to('/');
    }
}
