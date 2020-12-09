<?php

namespace Database\Factories;

use App\Models\PersonVaccination;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Person;
use App\Models\Vaccination;

class PersonVaccinationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PersonVaccination::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "dose" => $this->faker->sentence,
            "lot_number" => $this->faker->sentence,
            "is_vaccinated" => false,
            "vaccination_date" => $this->faker->date,
            "person_id" => Person::factory()->create(),
            "vaccination_id" => Vaccination::factory()->create(),
        ];
    }
}
