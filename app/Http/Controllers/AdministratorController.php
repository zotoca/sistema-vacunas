<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

use App\Models\User;

class AdministratorController extends Controller
{
    public function index(Request $request){


        $first_name = $request->get("first-name");
        $last_name = $request->get("last-name");
        
        $users = User::firstName($first_name)
            ->lastName($last_name)
            ->orderBy("created_at", "ASC")
            ->paginate(5)
            ->appends(["first-name" => $first_name, "last-name" => $last_name]);
        
        return View::make("administrators.administrators-index", ["administrators" => $users]);
    }
}
