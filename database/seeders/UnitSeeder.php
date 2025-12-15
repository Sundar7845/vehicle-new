<?php

namespace Database\Seeders;

use App\Models\Units;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['unit_name' => '1 unit'],
            ['unit_name' => '4 unit'],
            ['unit_name' => '9 unit'],
            ['unit_name' => '10 unit'],
        ];

        Units::insert($data);
    }
}
