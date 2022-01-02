<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "first_name"=>"Super",
            "last_name" => "Admin",
            "email" => "admin@mail.com",
            "password" => bcrypt("Secret123"),
            "is_super_admin" => true    
        ];

        User::factory()->create($data)->assignRole("Super admin");
    }
}
