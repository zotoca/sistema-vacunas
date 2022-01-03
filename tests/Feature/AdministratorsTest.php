<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\UserLog;
use App\Models\Person;
use Storage;
use Illuminate\Http\UploadedFile;
class AdministratorsTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_doctor_can_see_persons(){
        
        $this->signIn();

        $user = User::factory()->create();

        $this->get("/administradores")
            ->assertStatus(200)
            ->assertSee($user->first_name);
    }

    public function test_a_doctor_can_search_doctors_by_her_first_name(){


        $this->signIn();

        $users = User::factory(2)->create();

        $this->get("/administradores?first-name=" . $users[0]->first_name)
        ->assertSee($users[0]->first_name)
        ->assertDontSee($users[1]->first_name);
 
    }

    public function test_a_doctor_can_search_doctors_by_her_last_name(){


        $this->signIn();

        $users = User::factory(2)->create();

        $this->get("/administradores?last-name=" . $users[0]->last_name)
        ->assertSee($users[0]->last_name)
        ->assertDontSee($users[1]->last_name);

    }
    public function test_a_administrator_can_see_create_doctor(){

        $this->signInAsAdministrator();

        $this->get("/administradores/crear")
            ->assertStatus(200)
            ->assertSee("Crear");
    }
    public function test_a_doctor_cannot_see_create_doctor(){
       
        $this->signIn();

        $this->get("/administradores/crear")
            ->assertRedirect("/administradores");
        
    }

    public function test_a_administrator_can_create_an_doctor(){

        $this->signInAsAdministrator();

        $attributes = User::factory()->raw();

        
        $attributes["password"] = "Secret123";
        $attributes["repeatPassword"] = "Secret123";

        $this->post("/administradores", $attributes)
            ->assertRedirect("/administradores");

        $this->get("/administradores")
            ->assertStatus(200)
            ->assertSee($attributes["first_name"]);

        $this->assertDatabaseHas("users", ["first_name" => $attributes["first_name"]]);
    }

    public function test_an_administrator_can_create_an_doctor_with_image(){
        $this->withoutExceptionHandling();
        $this->signInAsAdministrator();

        $attributes = User::factory()->raw();

        $attributes["image"] = UploadedFile::fake()->image("user.jpg");

        $attributes["password"] = "Secret123";
        $attributes["repeatPassword"] = "Secret123";

        $this->post("/administradores", $attributes)
            ->assertRedirect("/administradores");

        $this->get("/administradores")
            ->assertStatus(200)
            ->assertSee($attributes["first_name"]);

        $this->assertDatabaseHas("users", ["first_name" => $attributes["first_name"]]);
    
        $administrator = User::where("first_name", $attributes["first_name"])->first();

        Storage::assertExists($administrator->image_url);
    }

    public function test_a_administrator_cannot_create_an_doctor_without_attributes(){
        $this->signInAsAdministrator();

        $this->post("/administradores")
            ->assertStatus(302)
            ->assertSessionHasErrors("first_name")
            ->assertSessionHasErrors("last_name")
            ->assertSessionHasErrors("email")
            ->assertSessionHasErrors("password");
    }

    public function test_a_administrator_can_see_edit_doctor(){
        $this->withoutExceptionHandling();
        $this->signInAsAdministrator();

        $doctor = User::factory()->create();

        $this->get($doctor->path()."/editar")
            ->assertStatus(200)
            ->assertSee($doctor->first_name)
            ->assertSee($doctor->last_name);


    }

    public function test_a_doctor_cannot_see_edit_doctor(){
        $this->withoutExceptionHandling();
        $this->signIn();

        $doctor = User::factory()->create();

        $this->get($doctor->path()."/editar")
            ->assertRedirect("/administradores");
    }

    public function test_a_administrator_can_edit_a_doctor(){
        $this->withoutExceptionHandling();
        $this->signInAsAdministrator();

        $administrator = User::factory()->create();

        $attributes = ["first_name" => "first name test"];

        $this->put($administrator->path(), $attributes)
            ->assertRedirect($administrator->path()."/editar");



        $this->assertDatabaseHas("users", $attributes);
    }
    public function test_a_doctor_cannot_edit_a_doctor(){
        $this->withoutExceptionHandling();
        $this->signIn();

        $administrator = User::factory()->create();

        $attributes = ["first_name" => "first name test"];

        $this->put($administrator->path(), $attributes)
            ->assertRedirect("/administradores");



        $this->assertDatabaseMissing("users", $attributes);
    }




    public function test_a_administrator_can_edit_a_doctor_with_image(){
        $this->signInAsAdministrator();

        $administrator = User::factory()->create();
    
        $attributes = [
            "image" => UploadedFile::fake()->image("avatar.jpg")
        ];
        

        $administrator->image_url = Storage::putFile("avatars", UploadedFile::fake()->image("avatar.jpg"));

        $old_image_url = $administrator->image_url;

        $administrator->save();

        $this->put($administrator->path(), $attributes)
            ->assertRedirect($administrator->path()."/editar");


        $administrator->refresh();
        
        Storage::assertExists($administrator->image_url);
        Storage::assertMissing($old_image_url);
    }

    public function test_a_administrator_can_delete_a_doctor(){
        $this->withoutExceptionHandling();
        $this->signInAsAdministrator();

        $administrator = User::factory()->create();
        $this->delete($administrator->path())
            ->assertStatus(200);
        
        $this->get("/administradores")
            ->assertStatus(200)
            ->assertDontSee($administrator->first_name);
        
        
        $this->assertDatabaseMissing("users", ["id" => $administrator->id]);
    }

    public function test_a_doctor_cannot_delete_a_doctor(){
        $this->withoutExceptionHandling();
        $this->signIn();

        $administrator = User::factory()->create();
        $this->delete($administrator->path())
            ->assertStatus(403);
        
        $this->get("/administradores")
            ->assertStatus(200)
            ->assertSee($administrator->first_name);
        
        
        $this->assertDatabaseHas("users", ["id" => $administrator->id]);
    }


    public function test_a_doctor_can_see_doctor_actions_list(){
        $this->withoutExceptionHandling();
        $this->signIn();

        $create_user_log = UserLog::factory()->create(["action_type" => "Crear"]);
        $edit_user_log = UserLog::factory()->create(["action_type" => "Editar"]);
        $delete_user_log = UserLog::factory()->create(["action_type" => "Eliminar"]);

        $this->get("/registro-personas")
            ->assertStatus(200)
            ->assertSee($create_user_log->action_type)
            ->assertSee($edit_user_log->action_type)
            ->assertSee($delete_user_log->action_type);
    }

    public function test_a_doctor_can_create_doctor_actions(){
        $this->signIn();

        $attributes = Person::factory()->raw();

        $edit_person = Person::factory()->create();
        $edit_person_attributes = ["first_name" => "Hey"];
        
        $delete_person = Person::factory()->create();

        $this->post("/personas", $attributes)
            ->assertStatus(302);
        
        $this->put($edit_person->path(), $edit_person_attributes)
            ->assertStatus(302);
        
        $this->delete($delete_person->path())
            ->assertStatus(200);

        $this->get("/registro-personas")
            ->assertStatus(200)
            ->assertSee(auth()->user()->first_name)
            ->assertSee("Editar")
            ->assertSee("Eliminar")
            ->assertSee("Crear");        
    }

    public function test_a_doctor_can_search_user_logs_by_the_user_first_name(){

        $this->withoutExceptionHandling();
        $this->signIn();

        $user_logs = UserLog::factory(2)->create();

        $this->get("/registro-personas?first-name=" . $user_logs[0]->user->first_name)
        ->assertStatus(200)
        ->assertSee($user_logs[0]->user->first_name)
        ->assertDontSee($user_logs[1]->user->first_name);
 
    }

    public function test_a_doctor_can_search_user_logs_by_the_user_last_name(){


        $this->signIn();

        $user_logs = UserLog::factory(2)->create();

        $this->get("/registro-personas?last-name=" . $user_logs[0]->user->last_name)
        ->assertStatus(200)
        ->assertSee($user_logs[0]->user->last_name)
        ->assertDontSee($user_logs[1]->user->last_name);

    }

    public function test_an_administrator_cannot_delete_an_administrator(){

        $this->signInAsAdministrator();

        $admin = User::factory()->create();
        $admin->assignRole("Super admin");

        $this->delete($admin->path())
            ->assertStatus(404);
        

        $this->get("/administradores")
            ->assertSee($admin->first_name);
    }
}
