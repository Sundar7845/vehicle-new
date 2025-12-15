<?php

namespace Database\Seeders;

use App\Models\Taluk;
use Illuminate\Database\Seeder;

class TalukSeeder extends Seeder
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
                'name' => 'taluk-1',
                'user_id' => 12
            ],
            [
                'name' => 'taluk-2',
                'user_id' => 13
            ],
            [
                'name' => 'taluk-3',
                'user_id' => 14
            ],
            [
                'name' => 'taluk-4',
                'user_id' => 15
            ],
            [
                'name' => 'taluk-5',
                'user_id' => 16
            ],
            [
                'name' => 'taluk-6',
                'user_id' => 17
            ],
            [
                'name' => 'taluk-7',
                'user_id' => 18
            ],
            [
                'name' => 'taluk-8',
                'user_id' => 19
            ],
            [
                'name' => 'taluk-9',
                'user_id' => 20
            ],
            [
                'name' => 'taluk-10',
                'user_id' => 21
            ],
            [
                'name' => 'taluk-11',
                'user_id' => 22
            ],
        ];

        foreach ($data as $item) {
            Taluk::create($item);
        }
    }
}
