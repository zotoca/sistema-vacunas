<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Http\Requests\PersonCreateRequest;

use App\Models\Person;
use App\Models\Vaccination;
use View;

class PersonController extends Controller
{
    public function index(Request $request){
        $dni = $request->get("dni");
        $missing_vaccination_id = $request->get("missing-vaccination");



        $persons = Person::orderBy("created_at","desc")
            ->where("dni", "LIKE", "%$dni%");
        if($missing_vaccination_id){
            $persons = $persons->whereHas("personVaccinations", function($query) use ($missing_vaccination_id){

                return $query
                    ->where("vaccination_id","=",$missing_vaccination_id)
                    ->where("is_vaccinated",0);
            });
        }
        
        $persons = $persons->paginate(6)
            ->appends(["dni" => $dni,'missing-vaccination' => $missing_vaccination_id]);
        
        $vaccinations = Vaccination::all();

        return View::make("persons.person-index", ["persons" => $persons,"vaccinations" => $vaccinations]);
    }

    public function show(Request $request, Person $person){
        $person->load(["person_vaccination" => function($query){
            $query->orderBy("created_at", "ASC");
        }]);
    }

    public function create(){
        return View::make("persons.person-create");
    }

    public function store(PersonCreateRequest $request){
        $validated = $request->validated;
        
        $person_data =  array_filter($validated, function($key){
            return in_array($key,["first_name","last_name","dni","gender","birthday","phone_number","house_id"]);
        }, ARRAY_FILTER_USE_KEY);

        if($validated["father_dni"]){
            $person_data["father_id"] = Person::where("dni",$validated["father_dni"]); 
        }

        if($validated["mother_dni"]){
            $person_data["mother_id"] = Person::where("dni",$validated["mother_dni"])->first()->id;
        }

        $actual = Carbon::now();

        $validated["age"] = $actual->diffForHumans($validated["birthday"], $actual);
        
        $new_person = Person::create($validated);

        foreach($validated["person_vaccination"] as $person_vaccination){
            
            $person_vaccination_data = $person_vaccination;

            $person_vaccination_data["person_id"] = $new_person->id;
        }

        return redirect("/personas");
    }

    public function edit(){
        return View::make("persons.person-edit");
    }
}
