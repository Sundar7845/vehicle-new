<?php

namespace Database\Seeders;

use App\Models\Site;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['site_name' => 'Chinnakalayamputhur', 'user_id' => 2, 'is_active' => 1, 'short_name' => 'CPUTHUR01'],
            ['site_name' => 'Neikarapatti', 'user_id' => 4, 'is_active' => 1, 'short_name' => 'NPATTI01'],
            ['site_name' => 'Andippatti', 'user_id' => 5, 'is_active' => 1, 'short_name' => null],
            ['site_name' => 'Site C', 'is_active' => 0, 'short_name' => null],
        ];
        foreach ($data as $item) {
            Site::create($item);
        }
    }
}
