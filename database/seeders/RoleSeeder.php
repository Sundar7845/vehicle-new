<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['role_name' => 'taluk'],
            ['role_name' => 'user'],
            ['role_name' => 'owner'],
        ];

        Role::insert($data);
    }
}
