<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Storage;

use App\Models\User;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
class AdministratorController extends Controller
{
    public function index(Request $request){


        $first_name = $request->get("first-name");
        $last_name = $request->get("last-name");
        
        $users = User::firstName($first_name)
            ->lastName($last_name)
            ->orderBy("created_at", "ASC")
            ->paginate(5)
            ->appends(["first-name" => $first_name, "last-name" => $last_name]);
        
        return View::make("administrators.administrators-index", ["administrators" => $users]);
    }

    public function create(){

        return View::make("administrators.administrators-create");


    }




    public function store(UserCreateRequest $request){
        $validated = $request->validated();
        

        if(isset($validated["image"])){
            $validated["image_url"] = Storage::putFile("public", $request->file("image"));
        }        

        $new_administrator = User::create($validated);

        
        return redirect("/administradores");
    }

    public function edit(User $user){ 

        return View::make("administrators.administrator-edit",["administrator" => $user]);
    }


    public function update(UserUpdateRequest $request, User $user){
       
        $validated = $request->validated();

        $validated = array_filter($validated);

        if(isset($validated["image"])){
            Storage::delete($user->image_url);
            $validated["image_url"] = Storage::putFile("public", $request->file("image"));
        }

        
        $user->update($validated);


        return redirect($user->path() . "/editar");
    }

    public function destroy(User $user){
        Storage::delete($user->image_url);

        $user->delete();

        return response()->json(["message"=>"ok"]);
    }
    
}
