<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Taluk;
use App\Models\Site;
use App\Models\Party;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class OttanSeeder extends Seeder
{
    public function run()
    {
        DB::transaction(function () {
            $this->command->info("Starting Ottanchathiram Import...");

            // 1. Create New Admin
            $adminPhone = '7094300137';
            $existingAdmin = User::where('phone', $adminPhone)->first();
            if ($existingAdmin) {
                $existingAdmin->forceDelete(); // Ensure clean slate
            }

            $admin = new User();
            $admin->name = 'Ottanchathiram Admin';
            $admin->phone = $adminPhone;
            $admin->role_id = 1;
            $admin->password = Hash::make('12345678');
            $admin->save();

            $this->command->info("Created Admin: " . $admin->name);

            // 2. Create Taluk
            $talukName = 'Ottanchathiram';
            $existingTaluk = Taluk::where('name', $talukName)->first();
            if ($existingTaluk) {
                $existingTaluk->delete();
            }

            $taluk = new Taluk();
            $taluk->name = $talukName;
            $taluk->user_id = $admin->id;
            $taluk->save();

            $this->command->info("Created Taluk: " . $taluk->name . " (ID: " . $taluk->id . ")");

            // 3. Import Data
            $sitesData = [
                ['site' => 'Virupachi - Settu', 'party' => 'Muthu', 'phone' => '1112250007'],
                ['site' => 'Virupachi - Muruganandham Kadu', 'party' => 'Muthu', 'phone' => '1112250008'],
                ['site' => 'Arasapillaipatti - Chinrasu Kadu', 'party' => 'Muthu', 'phone' => '1112250009'],
                ['site' => 'Periyakottai - APT Plant', 'party' => 'Muthu', 'phone' => '1112250010'],
                ['site' => 'Modhupatti - Chinnasamy', 'party' => 'Muthu', 'phone' => '1112250011'],
                ['site' => 'Kallimandayam - Rajesh', 'party' => 'Muthu', 'phone' => '1112250012'],
                ['site' => 'Modhupatti Athmanathan', 'party' => 'Raja', 'phone' => '1112250013'],
                ['site' => 'Idayakottai Murugan Plant', 'party' => 'Raja', 'phone' => '1112250014'],
                ['site' => 'Murugan Gravel', 'party' => 'Raja', 'phone' => '1112250015'],
                ['site' => 'Mambarai Narasimman', 'party' => 'Raja', 'phone' => '1112250016'],
                ['site' => 'Mambarai Athmanathan', 'party' => 'Raja', 'phone' => '1112250017'],
                ['site' => 'Vagarai', 'party' => 'Krishnamoorthi', 'phone' => '1112250018'],
                ['site' => 'Melkaraipatti Suresh', 'party' => 'Krishnamoorthi', 'phone' => '1112250019'],
                ['site' => 'Korikadu P.S Mani', 'party' => 'Krishnamoorthi', 'phone' => '1112250020'],
                ['site' => 'Melkaraipatti', 'party' => 'Krishnamoorthi', 'phone' => '1112250021'],
                ['site' => 'Senkulam Kanmani', 'party' => 'Mara Kannan', 'phone' => '1112250022'],
            ];

            foreach ($sitesData as $data) {
                // Create Site
                $site = new Site();
                $site->site_name = $data['site'];
                $site->short_name = substr(str_replace(' ', '', $data['site']), 0, 8);
                $site->is_active = 1;
                $site->user_id = $admin->id; // Link site to Admin for visibility
                $site->save();

                // Create Party (for filters)
                // Assuming Party model exists (checked schema earlier)
                // Need to check namespace 'App\Models\Party'. If not exists, will use DB facade?
                // Step 1057 showed 'parties' table exists. Step 905 showed 'PartySeeder.php'.
                // I'll assume App\Models\Party exists. If not, I'll fallback to DB::table.

                // Let's use DB::table to be safe as I didn't view Party.php
                DB::table('parties')->insert([
                    'site_id' => $site->id,
                    'name' => $data['party'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // Create User (Supervisor)
                $user = new User();
                $user->name = $data['party']; // Name is the Party Name
                $user->phone = $data['phone'];
                $user->password = Hash::make('12345678');
                $user->role_id = 2; // Supervisor

                // Manually assign attributes to bypass mass-assignment protection
                $user->site_id = $site->id;
                $user->taluk_id = $taluk->id;

                $user->save();
            }

            $this->command->info("Imported " . count($sitesData) . " sites, parties, and supervisors.");
        });
    }
}
