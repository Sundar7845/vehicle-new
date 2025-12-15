<?php

namespace Database\Seeders;

use App\Models\VehicleType;
use Illuminate\Database\Seeder;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'unit_id' => '1',
                'vechicle_type' => 'Tractor'
            ],
            [
                'unit_id' => '2',
                'vechicle_type' => '6 Wheel'
            ],
            [
                'unit_id' => '3',
                'vechicle_type' => '10 Wheel'
            ],

            [
                'unit_id' => '4',
                'vechicle_type' => '12 Wheel'
            ]
        ];

        VehicleType::insert($data);
    }
}
