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
        $number_houses = House::all()->count();
        $number_streets = Street::all()->count();

        $template_data = [
            "number_administrators" => $number_administrators,
            "number_persons" => $number_persons,
            "number_houses" => $number_houses,
            "number_streets" => $number_streets
        ];

        return View::make("dashboard.dashboard-index", $template_data);
    }
}
