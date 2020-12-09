<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\House;
use App\Models\Street;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $streets = Street::all();

        foreach($streets as $street){

            House::factory()->create(["street_id" => $street->id]);
            
        }
    }
}
