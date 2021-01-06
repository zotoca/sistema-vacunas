<?php

namespace Database\Factories;

use App\Models\UserLog;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Person;
use App\Models\User;

class UserLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $person = Person::factory()->create();
        dd($person);
        return [
            "person_id" => $person->id,
            "person_dni" => $person->dni,
            "action_type" => "Crear",
            "user_id" => User::factory()->create()->id,
        ];
    }
}
