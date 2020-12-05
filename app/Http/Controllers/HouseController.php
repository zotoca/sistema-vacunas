<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\House;
use App\Models\Street;

use View;

class HouseController extends Controller
{
    public function index(Request $request, Street $street){

        $number = $request->get("number");

        $houses = $street->houses()->orderBy("created_at","desc")
            ->where("number", "LIKE", "%$number%")
            ->paginate(6)
            ->appends(["number" => $number]);

        return View::make("houses.house-index", ["houses" => $houses,"street" => $street]);
    }

    public function store(Request $request){
        $house_data = $request->validate(["number" => "required|integer","street_id" => "required|exists:streets,id"]);

        $house = House::create($house_data);

        return response()->json(["message" => "ok"]);
        

    }

    public function update(Request $request, House $house){

        $house_data = $request->validate(["number" => "integer"]);

        $house->update($house_data);

        return response()->json(["message" => "ok"]);
    }

    public function destroy(Request $request, House $house){
        $house->delete();

        return response()->json(["message" => "ok"]);
    }
}
