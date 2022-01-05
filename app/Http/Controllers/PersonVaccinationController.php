<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PersonVaccination;
use App\Http\Requests\PersonVaccinationCreateRequest;
use App\Http\Requests\PersonVaccinationUpdateRequest;
use App\Http\Requests\PersonVaccinationDeleteRequest;


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

    public function delete(PersonVaccinationDeleteRequest $request,PersonVaccination $person_vaccination){
        $user = auth()->user();


        if(!$user->hasPermissionTo("remove person vaccination") && !$user->hasRole("Super admin")){
            return response()->json(["message" => "You aren't allowed to do this action"], 403);
        }




        $person_vaccination->delete();

        return response()->json(["message" => "ok"]);
    }
}
