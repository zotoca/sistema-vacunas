<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Street;

class StreetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Street::factory(10)->create();
    }
}
