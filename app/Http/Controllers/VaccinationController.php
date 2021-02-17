<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaccination;

use App\Http\Requests\VaccinationDestroyRequest;

use View;

class VaccinationController extends Controller
{
    public function index(Request $request){

        $name = $request->get("name");

        $vaccinations = Vaccination::orderBy("created_at","desc")
            ->where("name", "LIKE", "%$name%")
            ->paginate(6)
            ->appends(["name" => $name]);

        return View::make("vaccinations.vaccination-index", ["vaccinations" => $vaccinations]);
    }

    public function store(Request $request){
        $vaccination_data = $request->validate(["name" => "required|string"]);

        $vaccination = Vaccination::create($vaccination_data);

        return response()->json(["message" => "ok"]);
        

    }

    public function update(Request $request, Vaccination $vaccination){

        $vaccination_data = $request->validate(["name" => "string"]);

        $vaccination->update($vaccination_data);

        return response()->json(["message" => "ok"]);
    }

    public function destroy(VaccinationDestroyRequest $request, Vaccination $vaccination){
        $vaccination->delete();

        return response()->json(["message" => "ok"]);
    }

    public function indexApi(Request $request){
        $vaccinations = Vaccination::all();
        

        return response()->json($vaccinations);
    }


}
