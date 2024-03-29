<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use View;
use Storage;



use App\Http\Requests\PersonCreateRequest;
use App\Http\Requests\PersonUpdateRequest;
use App\Http\Requests\PersonDeleteRequest;
use App\Http\Requests\DniRequest;
use App\Models\Person;
use App\Models\Vaccination;
use App\Models\UserLog;

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
        return View::make("persons.person-show", ["person" => $person]);
    } 

    public function create(){

        return View::make("persons.person-create");
    }

    public function store(PersonCreateRequest $request){
        $validated = $request->validated();
        
        
        $person_data =  array_filter($validated, function($key){
            return in_array($key,["first_name","last_name","dni","gender","birthday","phone_number","address"]);
        }, ARRAY_FILTER_USE_KEY);


        if(isset($validated["image"])){
            $person_data["image_url"] = Storage::putFile("public", $request->file("image"));
        }else{
            $person_data["image_url"] = "person.png";
        }        
        if(isset($validated["father_dni"]) && $validated["father_dni"] != ""){
            $person_data["father_id"] = Person::where("dni",$validated["father_dni"])->first()->id; 
        }

        if(isset($validated["mother_dni"])){
            $person_data["mother_id"] = Person::where("dni",$validated["mother_dni"])->first()->id;
        }

        
        
        $new_person = Person::create($person_data);

        UserLog::create([
            "person_id" => $new_person->id,
            "person_dni" => $new_person->dni,
            "action_type" => "Crear",
            "user_id" => auth()->user()->id
        ]);

        return redirect("/personas");
    }

    public function edit(Person $person){
        $person_vaccinations = $person->personVaccinations;


        return View::make("persons.person-edit",["person"=>$person,"person_vaccinations" => $person_vaccinations]);
    }

    public function update(PersonUpdateRequest $request, Person $person){

        $validated = $request->validated();
        
        
        $person_data =  array_filter($validated, function($key){
            return in_array($key,["first_name","last_name","dni","gender","birthday","phone_number","address"]);
        }, ARRAY_FILTER_USE_KEY);
        if(isset($validated["image"])){
            Storage::delete($person->image_url);
            $person_data["image_url"] = Storage::putFile("public", $request->file("image"));
        }
        
        if(isset($validated["father_dni"])){
            $person_data["father_id"] = Person::where("dni",$validated["father_dni"])->first()->id; 
        }

        if(isset($validated["mother_dni"])){
            $person_data["mother_id"] = Person::where("dni",$validated["mother_dni"])->first()->id;
        }


        $person->update($person_data);

        UserLog::create([
            "person_id" => $person->id,
            "person_dni" => $person->dni,
            "action_type" => "Editar",
            "user_id" => auth()->user()->id
        ]);

        return redirect($person->path()."/editar");
    }

    public function personVaccinations(Request $request, Person $person){
        
        
        $vaccination_date = $request->get("vaccination-date");
        
        $vaccination_id = $request->get("vaccination-id");
        $lot_number = $request->get("lot-number");
        $dose = $request->get("dose");
        $is_vaccinated = $request->get("is-vaccinated");

        $person_vaccinations = $person
            ->personVaccinations()
            ->vaccinationDate($vaccination_date)
            ->vaccinationId($vaccination_id)
            ->lotNumber($lot_number)
            ->dose($dose)
            ->isVaccinated($is_vaccinated)
            ->get();

        
        $vaccinations = Vaccination::all();

        $context_data = [
            "person_vaccinations" => $person_vaccinations, 
            "person" => $person,
            "vaccinations" => $vaccinations
        ];

        return View::make("persons.person-vaccinations",$context_data);


    }


    public function personVaccinationPrint(Request $request, Person $person){

        $person_vaccinations = $person
            ->personVaccinations()
            ->get();
        
        $context_data = [
            "person_vaccinations" => $person_vaccinations, 
            "person" => $person,
        ];
        return View::make("components.person-vaccination.print-vaccinations.index",$context_data);
    }


    public function destroy(PersonDeleteRequest $request, Person $person){
        
        $user = auth()->user();

        if(!$user->hasPermissionTo("remove person") && !$user->hasRole("Super admin")){
            return response()->json(["message" => "You aren't allowed to do this action"], 403);
        }
        
        Storage::delete($person->image_url);

        $person->delete();

        UserLog::create([
            "person_id" => $person->id,
            "person_dni" => $person->dni,
            "action_type" => "Eliminar",
            "user_id" => auth()->user()->id
        ]);

        return response()->json(["message"=>"ok"]);
    }

    public function verificateDniApi(DniRequest $request){
        $is_valid = Person::where("dni", $request->all()["dni"])->exists();

        return response()->json(["isValid" => $is_valid]);


    }
}
