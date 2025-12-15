<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class KillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if settings table is empty to avoid duplicates
        if (Setting::count() == 0) {
            Setting::create([
                'kill' => 0,  // default value
            ]);
        }
    }
}
