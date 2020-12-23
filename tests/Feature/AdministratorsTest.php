<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use Storage;
use Illuminate\Http\UploadedFile;
class AdministratorsTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_administrator_can_see_persons(){
        
        $this->signIn();

        $user = User::factory()->create();

        $this->get("/administradores")
            ->assertStatus(200)
            ->assertSee($user->first_name);
    }

    public function test_a_administrator_can_search_administrators_by_her_first_name(){


        $this->signIn();

        $users = User::factory(2)->create();

        $this->get("/administradores?first-name=" . $users[0]->first_name)
        ->assertSee($users[0]->first_name)
        ->assertDontSee($users[1]->first_name);
 
    }

    public function test_a_administrator_can_search_administrators_by_her_last_name(){


        $this->signIn();

        $users = User::factory(2)->create();

        $this->get("/administradores?last-name=" . $users[0]->last_name)
        ->assertSee($users[0]->last_name)
        ->assertDontSee($users[1]->last_name);

    }
    public function test_a_administrator_can_see_create_administrator(){

        $this->signIn();

        $user = User::factory()->create();

        $this->get("/administradores/crear")
            ->assertStatus(200)
            ->assertSee("Crear");
    }

    public function test_a_administrator_can_create_an_administrator(){

        $this->signIn();

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

    public function test_an_administrator_can_create_an_administrator_with_image(){
        $this->withoutExceptionHandling();
        $this->signIn();

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

    public function test_a_administrator_cannot_create_an_administrator_without_attributes(){
        $this->signIn();

        $this->post("/administradores")
            ->assertStatus(302)
            ->assertSessionHasErrors("first_name")
            ->assertSessionHasErrors("last_name")
            ->assertSessionHasErrors("email")
            ->assertSessionHasErrors("password");
    }

    public function test_a_administrator_can_see_edit_administrator(){
        $this->withoutExceptionHandling();
        $this->signIn();

        $administrator = User::factory()->create();

        $this->get($administrator->path()."/editar")
            ->assertStatus(200)
            ->assertSee($administrator->first_name)
            ->assertSee($administrator->last_name);


    }

    public function test_a_administrator_can_edit_an_administrator(){
        $this->withoutExceptionHandling();
        $this->signIn();

        $administrator = User::factory()->create();

        $attributes = ["first_name" => "first name test"];

        $this->put($administrator->path(), $attributes)
            ->assertRedirect($administrator->path()."/editar");



        $this->assertDatabaseHas("users", $attributes);
    }

    public function test_a_administrator_can_edit_an_administrator_with_image(){
        $this->signIn();

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

    public function test_a_administrator_can_delete_a_person(){
        $this->withoutExceptionHandling();
        $this->signIn();

        $administrator = User::factory()->create();

        $this->delete($administrator->path())
            ->assertStatus(200);

        $this->get("/administradores")
            ->assertStatus(200)
            ->assertDontSee($administrator->first_name);
        
        
        $this->assertDatabaseMissing("users", ["id" => $administrator->id]);
    }


}
