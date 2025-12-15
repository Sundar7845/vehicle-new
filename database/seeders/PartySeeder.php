<?php

namespace Database\Seeders;

use App\Models\Party;
use Illuminate\Database\Seeder;

class PartySeeder extends Seeder
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
                'site_id' => 2,
                'name' => 'Selvam',
            ],
            [
                'site_id' => 2,
                'name' => 'Purushothaman',
            ],
            [
                'site_id' => 4,
                'name' => 'Jagadish',
            ],
            [
                'site_id' => 5,
                'name' => 'Rajesh',
            ],
        ];

        foreach ($data as $item) {
            Party::create($item);
        }
    }
}
