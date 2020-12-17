<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PersonVaccination;
use App\Http\Requests\PersonVaccinationCreateRequest;
use App\Http\Requests\PersonVaccinationUpdateRequest;

class PersonVaccinationController extends Controller
{
    
    public function store(PersonVaccinationCreateRequest $request){
        $validated = $request->validated();
        
        $person_vaccination = PersonVaccination::create($validated);
        
        return response()->json(["message" => "ok"]);
    }

    public function update(PersonVaccinationUpdateRequest $request, PersonVaccination $person_vaccination){
        $validated = $request->validated();

        $person_vaccination->update($validated);


        return response()->json(["message" => "ok"]);
    }

    public function delete(Request $request,PersonVaccination $person_vaccination){

        $person_vaccination->delete();

        return response()->json(["message" => "ok"]);
    }
}
