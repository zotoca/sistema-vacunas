<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

use App\Models\Vaccination;
use App\Models\PersonVaccination;
use App\Http\Requests\PersonVaccinationCreateRequest;
use App\Http\Requests\PersonVaccinationUpdateRequest;
use App\Http\Requests\PersonVaccinationDeleteRequest;


class PersonVaccinationController extends Controller
{
    
    public function index(Request $request){

        $vaccination_date = $request->get("vaccination-date");
        
        $vaccination_id = $request->get("vaccination-id");
        $lot_number = $request->get("lot-number");
        $dose = $request->get("dose");
        $is_vaccinated = $request->get("is-vaccinated");

        $person_vaccinations = PersonVaccination::vaccinationDate($vaccination_date)
            ->vaccinationId($vaccination_id)
            ->lotNumber($lot_number)
            ->dose($dose)
            ->isVaccinated($is_vaccinated)
            ->get();

        
        $vaccinations = Vaccination::all();

        $context_data = [
            "person_vaccinations" => $person_vaccinations, 
            "vaccinations" => $vaccinations
        ];

        return View::make("all-person-vaccinations.all-person-vaccinations",$context_data);

    }


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
