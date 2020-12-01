<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Person;
use App\Models\House;

class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "first_name" => $this->faker->firstName,
            "last_name" => $this->faker->lastName,
            "gender" => \Arr::random(["masculino","femenino"]),
            "birthday" => $this->faker->date,
            "age" => $this->faker->numberBetween(1,80),
            "phone_number" => $this->faker->phoneNumber,
            "house_id" => House::factory()->create()->id
        ];
    }
}
