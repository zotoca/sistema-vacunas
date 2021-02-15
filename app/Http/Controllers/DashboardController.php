<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{User,Person,House,Street};
use View;

class DashboardController extends Controller
{
    public function index(){
        $number_administrators = User::all()->count();
        $number_persons = Person::all()->count();

        $template_data = [
            "number_administrators" => $number_administrators,
            "number_persons" => $number_persons,
        ];

        return View::make("dashboard.dashboard-index", $template_data);
    }
}
