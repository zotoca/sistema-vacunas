<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(["name" => "Super admin"]);
        $permission_1 = Permission::create(["name" => "remove vaccine"]);
        $permission_2 = Permission::create(["name" => "remove person vaccination"]);
        $permission_3 = Permission::create(["name" => "remove person"]);
    }
}
