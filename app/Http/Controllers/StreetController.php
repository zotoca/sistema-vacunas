<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

use App\Models\Street;

class StreetController extends Controller
{
    public function index(Request $request){

        $name = $request->get("name");

        $streets = Street::orderBy("created_at","desc")
            ->where("name", "LIKE", "%$name%")
            ->paginate(6)
            ->appends(["name" => $name]);

        return View::make("streets.street-index", ["streets" => $streets]);
    }

    public function store(Request $request){
        $street_data = $request->validate(["name" => "required|string"]);

        $street = Street::create($street_data);

        return response()->json(["message" => "ok"]);
        

    }

    public function update(Request $request, Street $street){

        $street_data = $request->validate(["name" => "string"]);

        $street->update($street_data);

        return response()->json(["message" => "ok"]);
    }

    public function destroy(Request $request, Street $street){
        $street->delete();

        return response()->json(["message" => "ok"]);


    }


}
