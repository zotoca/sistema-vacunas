<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Storage;

use App\Models\User;
use App\Models\UserLog;

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
        if(auth()->user()->hasRole("Super admin")){
            return View::make("administrators.administrators-create");
        }
        
        return redirect("/administradores");
    }




    public function store(UserCreateRequest $request){
        $validated = $request->validated();
        

        if(isset($validated["image"])){
            $validated["image_url"] = Storage::putFile("public", $request->file("image"));
        }
        else{
            $validated["image_url"] = "person.png";
        }        
        $validated["password"] = bcrypt($validated["password"]);
        $new_administrator = User::create($validated);

        
        return redirect("/administradores");
    }

    public function edit(User $user){ 
        if(auth()->user()->hasRole('Super admin')){
            return View::make("administrators.administrator-edit",["administrator" => $user]);
        }
        return redirect("/administradores");
    }


    public function update(UserUpdateRequest $request, User $user){
        if(!auth()->user()->hasRole('Super admin')){
            return redirect("/administradores");
        }

        $validated = $request->validated();

        $validated = array_filter($validated);

        if(isset($validated["image"])){
            Storage::delete($user->image_url);
            $validated["image_url"] = Storage::putFile("public", $request->file("image"));
        }
        if(isset($validated["password"])){
            $validated["password"] = bcrypt($validated["password"]);
        }
        $user->update($validated);

        //TODO: Refactor this code snippet, we have to move this snippet to an observer
        if(isset($validated["delete_vaccine_permission"]) && $validated["delete_vaccine_permission"] == 1){
            $user->givePermissionTo('remove vaccine');    
        }else{
            $user->revokePermissionTo('remove vaccine');
        }


        if(isset($validated["delete_person_vaccination_permission"]) && $validated["delete_person_vaccination_permission"] == 1){
           
            $user->givePermissionTo('remove person vaccination');
            
        }else{
            $user->revokePermissionTo('remove person vaccination');
        }

        if(isset($validated["delete_person_permission"]) && $validated["delete_person_permission"] == 1){
            $user->givePermissionTo('remove person');
            
        }else{
            $user->revokePermissionTo('remove person');
        }

    


        return redirect($user->path() . "/editar");
    }

    public function destroy(User $user){
        if(!auth()->user()->hasRole("Super admin")){
            return response()->json(["message" => "You aren't allowed to do this action"], 403);
        }
        else if($user->hasRole("Super admin")){
            return response()->json(["message" => "This is a super admin"], 404);
        }
        

        Storage::delete($user->image_url);

        $user->delete();

        return response()->json(["message"=>"ok"]);
    }
    

    public function userLogs(Request $request){

        $first_name = $request->get("first-name");
        $last_name = $request->get("last-name");

        $user_logs = UserLog::userFirstName($first_name)
        ->userLastName($last_name)
        ->orderBy("created_at", "DESC")
        ->paginate(5)
        ->appends(["first-name" => $first_name, "last-name" => $last_name]);

        return View::make("administrators.administrator-logs", ["user_logs" => $user_logs]);
    }
}
