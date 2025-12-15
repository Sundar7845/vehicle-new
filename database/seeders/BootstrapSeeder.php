<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BootstrapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Disable Foreign Key Checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 2. Truncate Tables
        $this->command->info('Truncating tables...');
        DB::table('users')->truncate();
        DB::table('sites')->truncate();
        DB::table('parties')->truncate();
        DB::table('walkin_vehicles')->truncate();
        DB::table('admin_sites')->truncate();
        DB::table('vehicle_types')->truncate();
        DB::table('units')->truncate();

        // 3. Define Master Data
        $admins = [
            [
                'phone' => '7604959521',
                'name' => 'Admin 7604959521',
                'sites' => [
                    ['site' => 'Anaipatti Ayyapan', 'party' => 'Ayyapan', 'user' => '1112250063'],
                    ['site' => 'Rajadhani Kothi Ilamagilan', 'party' => 'Ilamagilan', 'user' => '1112250064'],
                    ['site' => 'Pappanaichanpatti PPR', 'party' => 'PPR', 'user' => '1112250065'],
                    ['site' => 'Musuvanathu MKP', 'party' => 'MKP', 'user' => '1112250066'],
                    ['site' => 'Musuvanathu KKP', 'party' => 'KKP', 'user' => '1112250067'],
                    ['site' => 'Vathalakundu PRK', 'party' => 'PRK', 'user' => '1112250068'],
                    ['site' => 'Kurumbapatti RKL', 'party' => 'RKL', 'user' => '1112250069'],
                    ['site' => 'Singarakottai Arun', 'party' => 'Arun', 'user' => '1112250070'],
                    ['site' => 'Viralipatti Vijayakar', 'party' => 'Vijayakar', 'user' => '1112250071'],
                    ['site' => 'Vadi Muthupandi', 'party' => 'Muthupandi', 'user' => '1112250072'],
                    ['site' => 'Kongapatti Ragu', 'party' => 'Ragu', 'user' => '1112250073'],
                    ['site' => 'Methupatti VVJ', 'party' => 'VVJ', 'user' => '1112250074'],
                    ['site' => 'Ethilodu Paalpandi', 'party' => 'Paalpandi', 'user' => '1112250075'],
                    ['site' => 'Musuvanathu APR', 'party' => 'AOR', 'user' => '1112250076'],
                    ['site' => 'Ottupatti DRN', 'party' => 'DRN', 'user' => '1112250077'],
                    ['site' => 'Ethilodu Senthil', 'party' => 'Senthil', 'user' => '1112250078'],
                    ['site' => 'Malai Gowdanpatti Sekar', 'party' => 'Sekar', 'user' => '1112250079'],
                    ['site' => 'Musuvanathu KKP-2', 'party' => 'KKP', 'user' => '1112250080'],
                ]
            ],
            [
                'phone' => '7094300137',
                'name' => 'Admin 7094300137',
                'sites' => [
                    ['site' => 'Virupachi - Settu', 'party' => 'Muthu', 'user' => '1112250007'],
                    ['site' => 'Virupachi - Muruganandham Kadu', 'party' => 'Muthu', 'user' => '1112250008'],
                    ['site' => 'Arasapillaipatti - Chinrasu Kadu', 'party' => 'Muthu', 'user' => '1112250009'],
                    ['site' => 'Periyakottai - APT Plant', 'party' => 'Muthu', 'user' => '1112250010'],
                    ['site' => 'Modhupatti - Chinnasamy', 'party' => 'Muthu', 'user' => '1112250011'],
                    ['site' => 'Kallimandayam - Rajesh', 'party' => 'Muthu', 'user' => '1112250012'],
                    ['site' => 'Modhupatti Athmanathan', 'party' => 'Raja', 'user' => '1112250013'],
                    ['site' => 'Idayakottai Murugan Plant', 'party' => 'Raja', 'user' => '1112250014'],
                    ['site' => 'Murugan Gravel', 'party' => 'Raja', 'user' => '1112250015'],
                    ['site' => 'Mambarai Narasimman', 'party' => 'Raja', 'user' => '1112250016'],
                    ['site' => 'Mambarai Athmanathan', 'party' => 'Raja', 'user' => '1112250017'],
                    ['site' => 'Vagarai', 'party' => 'Krishnamoorthi', 'user' => '1112250018'],
                    ['site' => 'Melkaraipatti Suresh', 'party' => 'Krishnamoorthi', 'user' => '1112250019'],
                    ['site' => 'Korikadu P.S Mani', 'party' => 'Krishnamoorthi', 'user' => '1112250020'],
                    ['site' => 'Melkaraipatti', 'party' => 'Krishnamoorthi', 'user' => '1112250021'],
                    ['site' => 'Senkulam Kanmani', 'party' => 'Mara Kannan', 'user' => '1112250022'],
                    ['site' => 'dev blu metal', 'party' => 'mk anadh', 'user' => '1112250099'],
                    // Multi Party
                    ['site' => 'Chinnakalayamputhur', 'party' => ['selvam', 'Purushothaman'], 'user' => 'existing_number_reuse'],
                ]
            ],
            [
                'phone' => '7084300137',
                'name' => 'Admin 7084300137',
                'sites' => [
                    ['site' => 'Kuthiraiaaru Durai', 'party' => 'Durai', 'user' => '1112250050'],
                    ['site' => 'Kuthiraiaaru Jagadeesh', 'party' => 'Jagadeesh', 'user' => '1112250051'],
                    ['site' => 'Kuthiraiaaru Meen Prabhu', 'party' => 'Meen Prabhu', 'user' => '1112250052'],
                    ['site' => 'Kuthiraiaaru Saravanan', 'party' => 'Saravanan', 'user' => '1112250053'],
                    ['site' => 'Sarathkrishna Crusher Selvakumar', 'party' => 'Selvakumar', 'user' => '1112250054'],
                    ['site' => 'Sarathkrishna Crusher', 'party' => 'Sarathkrishna Crusher', 'user' => '1112250055'],
                    ['site' => 'Purushotaman', 'party' => 'Purushotaman', 'user' => '1112250056'],
                    ['site' => 'Sarathkrishna Crusher Ravi', 'party' => 'Ravi', 'user' => '1112250057'],
                    ['site' => 'Dev Crusher N.K Anand', 'party' => 'N.K Anand', 'user' => '1112250058'],
                    ['site' => 'Neikarapatti Jagadeesh', 'party' => 'Jagadeesh', 'user' => '1112250059'],
                    ['site' => 'Vannampaarai Nagaraj', 'party' => 'Nagaraj', 'user' => '1112250060'],
                    ['site' => 'Kuthiraiaaru Murthi', 'party' => 'Murthi', 'user' => '1112250061'],
                    ['site' => 'Kuthiraiaaru SRK', 'party' => 'SRK', 'user' => '1112250062'],
                ]
            ],
            [
                'phone' => '866190963',
                'name' => 'Admin 866190963',
                'sites' => [
                    ['site' => 'Mallayapuram DRV', 'party' => 'DRV', 'user' => '1112250041'],
                    ['site' => 'Mallayapuram Manmurugan', 'party' => 'Manmurugan', 'user' => '1112250042'],
                    ['site' => 'Panchampatti Philips', 'party' => 'Philips', 'user' => '1112250043'],
                    ['site' => 'RR Kabi College', 'party' => 'Rajvel', 'user' => '1112250044'],
                    ['site' => 'Darmathupatti DRN', 'party' => 'DRN', 'user' => '1112250045'],
                    ['site' => 'Mallapuram Arun', 'party' => 'Arun', 'user' => '1112250046'],
                    ['site' => 'Puthukottai Ayyapan', 'party' => 'Ayyapan', 'user' => '1112250049'],
                    ['site' => 'Pawal Site', 'party' => 'Pawal', 'user' => '1112250047'],
                    ['site' => 'Darmathupatti', 'party' => 'Vadivel', 'user' => '1112250048'],
                ]
            ],
            [
                'phone' => '8489783031',
                'name' => 'Admin 8489783031',
                'sites' => [
                    ['site' => 'Karamadai Baskar', 'party' => 'Baskar', 'user' => '1112250023'],
                    ['site' => 'Kannivadi Pandidurai', 'party' => 'Pandidurai', 'user' => '1112250024'],
                    ['site' => 'Sitharaparai Muruganatham', 'party' => 'Muruganatham', 'user' => '1112250025'],
                    ['site' => 'Amarapatti Baskar', 'party' => 'Sand', 'user' => '1112250026'],
                    ['site' => 'Alagupatti Manmurugan', 'party' => 'Manmurugan', 'user' => '1112250027'],
                    ['site' => 'Kadirayankulam', 'party' => 'Chandara Devar', 'user' => '1112250028'],
                    ['site' => 'Reddiyarchatram', 'party' => 'Sarathi', 'user' => '1112250029'],
                    ['site' => 'Alagupatti Man Murugan', 'party' => 'Manmurugan', 'user' => '1112250030'],
                    ['site' => 'Darnathupatti Kannan', 'party' => 'Kannan', 'user' => '1112250031'],
                    ['site' => 'Kombai Muthupandi', 'party' => 'Muthupandi', 'user' => '1112250032'],
                    ['site' => 'Karamadi Vadivel', 'party' => 'Vadivel', 'user' => '1112250033'],
                    ['site' => 'Samiyarpati Saravanan', 'party' => 'Saravanan', 'user' => '1112250034'],
                    ['site' => 'Kannivadi Ramalingam', 'party' => 'Ramalingam', 'user' => '1112250035'],
                    ['site' => 'Kannivadi DRN', 'party' => 'DRN', 'user' => '1112250036'],
                    ['site' => 'Darmathupatti DRN', 'party' => 'DRN', 'user' => '1112250037'],
                    ['site' => 'Darmathupatti Xavier', 'party' => 'Xavier', 'user' => '1112250040'],
                    ['site' => 'Kottarapatti Kulam', 'party' => ['Ramkumar', 'Micheal', 'Muthupandi', 'Muruganandham', 'Siva', 'Saravanan'], 'user' => '1112250038'],
                    ['site' => 'Muthanampatti Kulam', 'party' => ['Muruganandham', 'Balaji'], 'user' => '1112250039'],
                ]
            ],
            [
                'phone' => '9787042210',
                'name' => 'Admin 9787042210',
                'sites' => [
                    ['site' => 'Panniyamalai Saravan', 'party' => 'Saravanan', 'user' => '1112250078_dup'],
                    ['site' => 'Panniyamalai Suresh', 'party' => 'Suresh', 'user' => '1112250079_dup'],
                    ['site' => 'Moongilpatti Sendhil', 'party' => 'Sendhil', 'user' => '1112250080_dup'],
                    ['site' => 'Aravangurichi Seeman', 'party' => 'Seeman', 'user' => '1112250081'],
                    ['site' => 'Palanipatti Sekar', 'party' => 'Sekar', 'user' => '1112250082'],
                    ['site' => 'Uluppakudi Prasath', 'party' => 'Prasath', 'user' => '1112250083'],
                    ['site' => 'Pannapatti Kumar', 'party' => 'Kumar', 'user' => '1112250084'],
                    ['site' => 'Kattapatti', 'party' => 'Ragu', 'user' => '1112250085'],
                    ['site' => 'Kosavapatti', 'party' => 'Kennedy', 'user' => '1112250086'],
                    ['site' => 'RMTC Mohan', 'party' => 'Mohan', 'user' => '1112250087'],
                    ['site' => 'Sanarpatti Mani', 'party' => 'Mani', 'user' => '1112250088'],
                    ['site' => 'Paraipatti Chinrasu', 'party' => 'Chinrasu', 'user' => '1112250089'],
                    ['site' => 'Paraipatti Ganesan', 'party' => 'Ganesan', 'user' => '1112250090'],
                ]
            ],
            [
                'phone' => '9010165341',
                'name' => 'Admin 9010165341',
                'sites' => [
                    ['site' => 'MM Koilur (1)', 'party' => 'AVR Das', 'user' => '1112250091'],
                    ['site' => 'Odaipathi', 'party' => 'AVR DAs', 'user' => '1112250092'],
                    ['site' => 'Kulathur', 'party' => 'Jaganathan', 'user' => '1112250093'],
                    ['site' => 'Thirnayakkan Patu', 'party' => 'Vincent', 'user' => '1112250094'],
                    ['site' => 'MM Koilur (2)', 'party' => 'Citrarasur', 'user' => '1112250095'],
                    ['site' => 'Periyakottai', 'party' => 'Sakthivel', 'user' => '1112250096'],
                    ['site' => 'Udarpatti', 'party' => 'Natchimuthu', 'user' => '1112250097'],
                    ['site' => 'Ayyam Palayam', 'party' => 'KVT', 'user' => '1112250098'],
                    ['site' => 'Sukkampatti', 'party' => 'Gajendran', 'user' => '1112250099_dup'],
                    ['site' => 'Nallama nayakkan patti', 'party' => 'Micheal', 'user' => '1112250100'],
                    ['site' => 'Periyakottai Muthu', 'party' => 'Muthu', 'user' => '1112250101'],
                    ['site' => 'Kallupatti', 'party' => 'Vincent', 'user' => '1112250102'],
                    ['site' => 'Aalkuvarapatti Mayavan', 'party' => 'Mayavan', 'user' => '1112250103'],
                    ['site' => 'Periyakothi Maayi', 'party' => 'Maayi', 'user' => '1112250104'],
                ]
            ],
            [
                'phone' => '9944442583',
                'name' => 'Admin 9944442583',
                'sites' => [
                    ['site' => 'Dernaikanpatti', 'party' => 'PST', 'user' => '1112250105'],
                    ['site' => 'R Kombai Madhu', 'party' => 'Madhu', 'user' => '1112250106'],
                    ['site' => 'R Kombai Ramesh', 'party' => 'Ramesh', 'user' => '1112250107'],
                    ['site' => 'Thennampatti Bullet Mani', 'party' => 'Bulletmani', 'user' => '1112250108'],
                    ['site' => 'Thennampatti Bangaru Balu', 'party' => 'Bangarubalu', 'user' => '1112250109'],
                    ['site' => 'Alagarnaikanpatti', 'party' => 'Abinesh', 'user' => '1112250110'],
                    ['site' => 'Thennampatti Abinesh', 'party' => 'Abinesh', 'user' => '1112250111'],
                    ['site' => 'Thennampatti Nagaraj', 'party' => 'Nagaraj', 'user' => '1112250112'],
                    ['site' => 'Kambilianpatti', 'party' => 'Nagaraj', 'user' => '1112250113'],
                    ['site' => 'Muthanankottai', 'party' => 'Stalin', 'user' => '1112250114'],
                    ['site' => 'Ariyalur', 'party' => 'Stalin', 'user' => '1112250115'],
                    ['site' => 'Thennampatti Mukesh', 'party' => 'Mukesh', 'user' => '1112250116'],
                    ['site' => 'Thennampatti Muniappan', 'party' => 'Muniappan', 'user' => '1112250117'],
                    ['site' => 'Thennampatti Mutpuliyan', 'party' => 'Mutpuliyan', 'user' => '1112250118'],
                    ['site' => 'Thennampatti Selvakumar', 'party' => 'Selvakumar', 'user' => '1112250119'],
                    ['site' => 'Koppampatti Selvaraj', 'party' => 'Selvaraj', 'user' => '1112250120'],
                    ['site' => 'Puliyampatti Madhu', 'party' => 'Madhu', 'user' => '1112250121'],
                    ['site' => 'Kosivappatti Venkatesh', 'party' => 'Venkatesh', 'user' => '1112250122'],
                    ['site' => 'Vidhuthaipatti Kannan', 'party' => 'Kannan', 'user' => '1112250123'],
                    ['site' => 'Vellanapatti', 'party' => 'GMS', 'user' => '1112250124'],
                    ['site' => 'Puuliyamarathukottai', 'party' => 'Muthupandi', 'user' => '1112250125'],
                    ['site' => 'Pernaickenpatti', 'party' => 'Maayi', 'user' => '1112250126'],
                    ['site' => 'Poosaripatti', 'party' => 'Venkat', 'user' => '1112250127'],
                ]
            ],
        ];

        // 4. Create Main Data
        foreach ($admins as $adminData) {
            $this->command->info("Creating Admin: {$adminData['name']}");

            $adminId = DB::table('users')->insertGetId([
                'role_id' => 1,
                'name' => $adminData['name'],
                'phone' => $adminData['phone'],
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($adminData['sites'] as $siteData) {
                // Handle Multi-Party
                $partyNames = is_array($siteData['party']) ? $siteData['party'] : [$siteData['party']];

                // Uniqueness fixes
                $userPhone = $siteData['user'];
                if ($userPhone === 'existing_number_reuse') {
                    $userPhone = '1112250006';
                } elseif ($userPhone === '1112250078_dup') {
                    $userPhone = '1112250978';
                } elseif ($userPhone === '1112250079_dup') {
                    $userPhone = '1112250979';
                } elseif ($userPhone === '1112250080_dup') {
                    $userPhone = '1112250980';
                } elseif ($userPhone === '1112250099_dup') {
                    $userPhone = '1112250199';
                }

                $shortName = $this->generateShortName($siteData['site']);

                $siteId = DB::table('sites')->insertGetId([
                    'user_id' => $adminId,
                    'site_name' => $siteData['site'],
                    'short_name' => $shortName,
                    'is_active' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Populate Pivot Table
                DB::table('admin_sites')->insert([
                    'user_id' => $adminId,
                    'site_id' => $siteId,
                    'created_at' => now(), // timestamps might be needed if migration has them
                    'updated_at' => now()
                ]);

                // Create Parties
                foreach ($partyNames as $pName) {
                    DB::table('parties')->insert([
                        'site_id' => $siteId,
                        'name' => $pName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                // Create Site User
                DB::table('users')->insert([
                    'role_id' => 2,
                    'site_id' => $siteId,
                    'name' => 'User ' . $userPhone,
                    'phone' => $userPhone,
                    'otp' => rand(1000, 9999),
                    'otp_expires_at' => now()->addMinutes(10),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // 5. Seed Vehicles (Log)
        $this->seedVehicleData();

        // 6. Enable Foreign Key Checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    private function generateShortName($siteName)
    {
        return strtoupper(substr($siteName, 0, 3) . rand(10, 99));
    }

    private function seedVehicleData()
    {
        $this->command->info("Seeding Vehicle Data...");

        $rawData = "
1	Chinnakalayamputhur	Selvam	6 Wheel	4 unit	TN66AB6666	08-12-25 23:50	09-12-25 11:57	12:07:21	08-12-25 23:50	09-12-25 11:57
2	Chinnakalayamputhur	Purushothaman	10 Wheel	6 unit	TN55AB5555	08-12-25 23:50	08-12-25 23:51	0:00:12	08-12-25 23:50	08-12-25 23:51
3	Chinnakalayamputhur	Selvam	Tractor	4 unit	TN66BR6778	09-12-25 10:39	09-12-25 12:07	1:28:06	09-12-25 10:39	09-12-25 12:07
4	Chinnakalayamputhur	Selvam	12 Wheel	8 unit	TN77GB9986	09-12-25 11:57	09-12-25 12:12	0:14:32	09-12-25 11:57	09-12-25 12:12
5	Chinnakalayamputhur	Selvam	6 Wheel	4 unit	TN38AE8501	09-12-25 12:07	09-12-25 12:21	0:14:03	09-12-25 12:07	09-12-25 12:21
6	Chinnakalayamputhur	Selvam	6 Wheel	4 unit	TN28AK3775	09-12-25 12:09	09-12-25 12:24	0:15:06	09-12-25 12:09	09-12-25 12:24
7	Chinnakalayamputhur	Selvam	6 Wheel	4 unit	TN16C5757	09-12-25 12:10	09-12-25 12:32	0:21:56	09-12-25 12:10	09-12-25 12:32
8	Chinnakalayamputhur	Selvam	6 Wheel	4 unit	TN19E4424	09-12-25 12:11	09-12-25 12:38	0:27:10	09-12-25 12:11	09-12-25 12:38
9	Chinnakalayamputhur	Selvam	6 Wheel	4 unit	TN30X4446	09-12-25 12:17	09-12-25 12:43	0:26:30	09-12-25 12:17	09-12-25 12:43
10	Chinnakalayamputhur	Selvam	10 Wheel	6 unit	TN42AB3922	09-12-25 12:42	09-12-25 12:57	0:14:05	09-12-25 12:42	09-12-25 12:57
11	Chinnakalayamputhur	Selvam	6 Wheel	4 unit	TN63P5725	09-12-25 12:49	09-12-25 13:03	0:13:42	09-12-25 12:49	09-12-25 13:03
12	Chinnakalayamputhur	Selvam	6 Wheel	4 unit	TN94C7857	09-12-25 12:59	09-12-25 13:49	0:50:14	09-12-25 12:59	09-12-25 13:49
13	Neikarapatti	Jagadeesh	12 Wheel	8 unit	TN8UJDREDD	09-12-25 13:56	09-12-25 14:08	0:12:22	09-12-25 13:56	09-12-25 14:08
14	Chinnakalayamputhur	Selvam	6 Wheel	4 unit	TN69AJ1897	09-12-25 14:00	09-12-25 14:12	0:12:05	09-12-25 14:00	09-12-25 14:12
15	Neikarapatti	Jagadeesh	6 Wheel	4 unit	TN34AE4649	09-12-25 14:05	09-12-25 14:09	0:03:37	09-12-25 14:05	09-12-25 14:09
16	Neikarapatti	Jagadeesh	6 Wheel	4 unit	TN38AD4568	09-12-25 14:06	09-12-25 14:09	0:03:02	09-12-25 14:06	09-12-25 14:09
17	Neikarapatti	Jagadeesh	6 Wheel	4 unit	TN42AX3166	09-12-25 14:07	09-12-25 14:11	0:04:44	09-12-25 14:07	09-12-25 14:11
18	Chinnakalayamputhur	Selvam	6 Wheel	4 unit	TN28AK3775	09-12-25 14:15	09-12-25 14:33	0:17:36	09-12-25 14:15	09-12-25 14:33
19	Chinnakalayamputhur	Selvam	6 Wheel	4 unit	TN19E4424	09-12-25 14:16	09-12-25 14:35	0:19:02	09-12-25 14:16	09-12-25 14:35
20	Chinnakalayamputhur	Selvam	6 Wheel	4 unit	TN16C5757	09-12-25 14:17	09-12-25 14:40	0:22:33	09-12-25 14:17	09-12-25 14:40
21	Chinnakalayamputhur	Selvam	6 Wheel	4 unit	TN94C7857	09-12-25 14:34	09-12-25 14:50	0:16:08	09-12-25 14:34	09-12-25 14:50
22	Chinnakalayamputhur	Selvam	10 Wheel	6 unit	TN42AB3922	09-12-25 14:36	09-12-25 15:14	0:37:41	09-12-25 14:36	09-12-25 15:14
23	Chinnakalayamputhur	Selvam	6 Wheel	4 unit	TN63P5725	09-12-25 15:14	09-12-25 15:31	0:16:38	09-12-25 15:14	09-12-25 15:31
24	Chinnakalayamputhur	Selvam	6 Wheel	4 unit	TN38AE8501	09-12-25 15:26	09-12-25 15:42	0:15:34	09-12-25 15:26	09-12-25 15:42
25	Chinnakalayamputhur	Selvam	6 Wheel	4 unit	TN94C7857	09-12-25 15:47	09-12-25 16:15	0:27:55	09-12-25 15:47	09-12-25 16:15
26	Chinnakalayamputhur	Selvam	6 Wheel	4 unit	TN37BV6797	09-12-25 15:48	09-12-25 16:15	0:27:06	09-12-25 15:48	09-12-25 16:15
27	Neikarapatti	Jagadeesh	12 Wheel	8 unit	TN67HHHDSH	09-12-25 16:09	09-12-25 16:09	0:00:10	09-12-25 16:09	09-12-25 16:09
28	Chinnakalayamputhur	Selvam	6 Wheel	4 unit	TN63P5725	09-12-25 16:11	09-12-25 17:08	0:56:41	09-12-25 16:11	09-12-25 17:08
29	Chinnakalayamputhur	Selvam	10 Wheel	6 unit	TN42AB3922	09-12-25 16:23	09-12-25 17:08	0:45:11	09-12-25 16:23	09-12-25 17:08
30	Chinnakalayamputhur	Selvam	6 Wheel	4 unit	TN63P5725	11-12-25 10:36	11-12-25 18:50	8:14:30	11-12-25 10:36	11-12-25 18:50
31	dev blu metal	mk anadh	12 Wheel	8 unit	TN42AH6799	11-12-25 11:38	11-12-25 12:49	1:10:34	11-12-25 11:38	11-12-25 12:49
32	dev blu metal	mk anadh	12 Wheel	8 unit	TN42AK9799	11-12-25 12:07	11-12-25 12:34	0:27:00	11-12-25 12:07	11-12-25 12:34
33	dev blu metal	mk anadh	10 Wheel	6 unit	TN42AP9597	11-12-25 12:10	11-12-25 13:00	0:50:32	11-12-25 12:10	11-12-25 13:00
34	Neikarapatti	Jagadeesh	6 Wheel	4 unit	TN60J0077	11-12-25 12:28	11-12-25 12:28	0:00:18	11-12-25 12:28	11-12-25 12:28
35	Neikarapatti	Jagadeesh	6 Wheel	4 unit	TN45AD4568	11-12-25 12:30	11-12-25 12:42	0:12:10	11-12-25 12:30	11-12-25 12:42
36	dev blu metal	mk anadh	10 Wheel	6 unit	TN42AM5479	11-12-25 12:48	11-12-25 13:26	0:37:57	11-12-25 12:48	11-12-25 13:26
37	Neikarapatti	Jagadeesh	6 Wheel	4 unit	TN60J0077	11-12-25 13:04	11-12-25 13:18	0:13:28	11-12-25 13:04	11-12-25 13:18
38	dev blu metal	mk anadh	12 Wheel	8 unit	TN42AP2079	11-12-25 13:11	11-12-25 13:37	0:26:41	11-12-25 13:11	11-12-25 13:37
39	Neikarapatti	Jagadeesh	6 Wheel	4 unit	TN45AD4568	11-12-25 13:18	11-12-25 20:44	7:26:05	11-12-25 13:18	11-12-25 20:44
40	Neikarapatti	Jagadeesh	6 Wheel	4 unit	TN78AZ5514	11-12-25 13:20	11-12-25 13:26	0:06:31	11-12-25 13:20	11-12-25 13:26
41	dev blu metal	mk anadh	Tractor	1 unit	TGHHJG8878	11-12-25 14:17	11-12-25 14:21	0:03:58	11-12-25 14:17	11-12-25 14:21
42	dev blu metal	mk anadh	6 Wheel	4 unit	TN90DQ7789	11-12-25 14:18			11-12-25 14:18	11-12-25 14:18
43	virupachi settu	muthu	Tractor	1 unit	TN55GY3455	11-12-25 15:50	11-12-25 15:50	0:00:10	11-12-25 15:50	11-12-25 15:50
44	virupachi settu	muthu	12 Wheel	8 unit	TB67FF8688	11-12-25 15:50			11-12-25 15:50	11-12-25 15:50
45	Virupachi - Muruganandham Kadu	muthu	10 Wheel	6 unit	TN94Y06O08	11-12-25 15:54	11-12-25 15:56	0:01:02	11-12-25 15:54	11-12-25 15:56
46	virupachi settu	muthu	6 Wheel	4 unit	TN56GH7878	11-12-25 16:53	11-12-25 16:54	0:00:45	11-12-25 16:53	11-12-25 16:54
47	Chinnakalayamputhur	Selvam	12 Wheel	8 unit	TN77GT6666	11-12-25 18:50	11-12-25 18:50	0:00:31	11-12-25 18:50	11-12-25 18:50
48	Neikarapatti	Jagadeesh	Tractor	1 unit	TN66TH6666	11-12-25 20:43	11-12-25 20:45	0:01:54	11-12-25 20:43	11-12-25 20:45
49	Neikarapatti	Jagadeesh	6 Wheel	4 unit	TJDJDKDDJN	11-12-25 20:44			11-12-25 20:44	11-12-25 20:44
50	Neikarapatti	Jagadeesh	10 Wheel	6 unit	JDDIKNSKSN	11-12-25 20:44			11-12-25 20:44	11-12-25 20:44
51	Senkulam Kanmani	Mara Kannan	12 Wheel	8 unit	TN94D5593	12-12-25 11:32	12-12-25 11:46	0:14:32	12-12-25 11:32	12-12-25 11:46
52	Senkulam Kanmani	Mara Kannan	12 Wheel	8 unit	TN94D3497	12-12-25 11:45	12-12-25 11:46	0:01:27	12-12-25 11:45	12-12-25 11:46
53	Senkulam Kanmani	Mara Kannan	10 Wheel	6 unit	TN94Y8398	12-12-25 11:48			12-12-25 11:48	12-12-25 11:48
54	Senkulam Kanmani	Mara Kannan	6 Wheel	4 unit	TN94X8478	12-12-25 11:48			12-12-25 11:48	12-12-25 11:48
55	Senkulam Kanmani	Mara Kannan	10 Wheel	6 unit	TN78H5979	12-12-25 11:50			12-12-25 11:50	12-12-25 11:50
56	Senkulam Kanmani	Mara Kannan	10 Wheel	6 unit	TN94X6616	12-12-25 11:52			12-12-25 11:52	12-12-25 11:52
57	Senkulam Kanmani	Mara Kannan	6 Wheel	4 unit	TN37BW2986	12-12-25 11:53			12-12-25 11:53	12-12-25 11:53
58	Ottupatti DRN	DRN	10 Wheel	6 unit	TN57BR7890	12-12-25 14:16	12-12-25 14:17	0:01:10	12-12-25 14:16	12-12-25 14:17
59	Ottupatti DRN	DRN	10 Wheel	6 unit	TN57BK0303	12-12-25 14:17	12-12-25 14:18	0:01:24	12-12-25 14:17	12-12-25 14:18
60	Ottupatti DRN	DRN	10 Wheel	6 unit	TN57BK9160	12-12-25 14:19	12-12-25 14:22	0:02:57	12-12-25 14:19	12-12-25 14:22
61	Ottupatti DRN	DRN	10 Wheel	6 unit	TN57BK0918	12-12-25 14:20	12-12-25 14:23	0:02:42	12-12-25 14:20	12-12-25 14:23
62	Ottupatti DRN	DRN	10 Wheel	6 unit	TN57BM7396	12-12-25 14:20	12-12-25 14:22	0:01:15	12-12-25 14:20	12-12-25 14:22
63	Ottupatti DRN	DRN	10 Wheel	6 unit	TN57BM8613	12-12-25 14:21	12-12-25 14:23	0:02:00	12-12-25 14:21	12-12-25 14:23
64	Ottupatti DRN	DRN	10 Wheel	6 unit	TN57BM9160	12-12-25 14:26	12-12-25 14:27	0:00:31	12-12-25 14:26	12-12-25 14:27
65	Musuvanathu APR	AOR	Tractor	1 unit	TB5YGYGCNF	12-12-25 14:28	12-12-25 14:28	0:00:12	12-12-25 14:28	12-12-25 14:28
66	Rajadhani Kothi Ilamagilan	Ilamagilan	6 Wheel	4 unit	TJKKPG7090	12-12-25 18:08	12-12-25 18:08	0:00:11	12-12-25 18:08	12-12-25 18:08
67	Rajadhani Kothi Ilamagilan		6 Wheel	4 unit	SR0899FBU	12-12-25 18:10	12-12-25 18:11	0:01:19	12-12-25 18:10	12-12-25 18:11
68	Rajadhani Kothi Ilamagilan	Ilamagilan	6 Wheel	4 unit	07LY759TJK	12-12-25 18:10	12-12-25 18:11	0:01:08	12-12-25 18:10	12-12-25 18:11
69	Rajadhani Kothi Ilamagilan	Ilamagilan	6 Wheel	4 unit	R17JFY1111	12-12-25 18:11	12-12-25 18:11	0:00:27	12-12-25 18:11	12-12-25 18:11
70	Rajadhani Kothi Ilamagilan	Ilamagilan	10 Wheel	6 unit	TN63891122	12-12-25 18:13	12-12-25 18:13	0:00:16	12-12-25 18:13	12-12-25 18:13
71	MM Koilur	AVR  Das	Tractor	1 unit	TN59DQ9335	12-12-25 18:49	12-12-25 18:50	0:01:31	12-12-25 18:49	12-12-25 18:50
72	MM Koilur	AVR  Das	6 Wheel	4 unit	TN58AB3333	12-12-25 18:49			12-12-25 18:49	12-12-25 18:49
73	MM Koilur	AVR  Das	10 Wheel	6 unit	TN6EBQ9181	12-12-25 18:50	12-12-25 18:52	0:02:01	12-12-25 18:50	12-12-25 18:52
74	Anaipatti Ayyapan	Ayyapan	6 Wheel	4 unit	SGHLL5IOPT	12-12-25 19:06	12-12-25 19:06	0:00:06	12-12-25 19:06	12-12-25 19:06
75	Ayyam Palayam	KVT	10 Wheel	6 unit	TN55BQ4685	12-12-25 19:25	12-12-25 19:25	0:00:13	12-12-25 19:25	12-12-25 19:25
76	Methupatti VVJ	VVJ	6 Wheel	4 unit	AVJI2JXUKK	12-12-25 19:55	12-12-25 19:55	0:00:13	12-12-25 19:55	12-12-25 19:55
77	Singarakottai Arun	Arun	6 Wheel	4 unit	TTUHUSVJKJ	12-12-25 20:01	12-12-25 20:01	0:00:09	12-12-25 20:01	12-12-25 20:01
78	Dernaikanpatti 	PST	6 Wheel	4 unit	TN57AV6657	12-12-25 20:08	12-12-25 20:09	0:01:10	12-12-25 20:08	12-12-25 20:09
79	Dernaikanpatti 	PST	10 Wheel	6 unit	TN63AG7890	12-12-25 20:09			12-12-25 20:09	12-12-25 20:09";

        $lines = explode("\n", trim($rawData));
        foreach ($lines as $line) {
            $cols = preg_split('/\t+/', trim($line));
            if (count($cols) < 6)
                continue;

            $siteName = trim($cols[1]);
            $partyName = trim($cols[2]);
            $vehicleType = trim($cols[3]);
            $unitName = trim($cols[4]);
            $vehicleNo = trim($cols[5]);
            $inTime = isset($cols[6]) ? trim($cols[6]) : null;
            $outTime = isset($cols[7]) ? trim($cols[7]) : null;
            $spentTime = isset($cols[8]) ? trim($cols[8]) : null;

            $createdAt = isset($cols[9]) ? trim($cols[9]) : null;
            $updatedAt = isset($cols[10]) ? trim($cols[10]) : null;

            $createdAtTS = $createdAt ? Carbon::createFromFormat('d-m-y H:i', $createdAt) : now();
            $updatedAtTS = $updatedAt ? Carbon::createFromFormat('d-m-y H:i', $updatedAt) : now();

            // 1. Find Site
            $siteId = DB::table('sites')->where('site_name', $siteName)->value('id');
            if (!$siteId) {
                if ($siteName == 'MM Koilur')
                    $siteId = DB::table('sites')->where('site_name', 'MM Koilur (1)')->value('id');
                if ($siteName == 'virupachi settu')
                    $siteId = DB::table('sites')->where('site_name', 'Virupachi - Settu')->value('id');
                if ($siteName == 'Dernaikanpatti ')
                    $siteId = DB::table('sites')->where('site_name', 'Dernaikanpatti')->value('id');
                if ($siteName == 'Neikarapatti')
                    $siteId = DB::table('sites')->where('site_name', 'Neikarapatti Jagadeesh')->value('id');
            }

            if (!$siteId) {
                $this->command->warn("Site not found: $siteName");
                continue;
            }

            // 2. Find Party
            $partyId = DB::table('parties')
                ->where('site_id', $siteId)
                ->where('name', $partyName)
                ->value('id');

            // 3. Find/Create Unit
            $unitId = DB::table('units')->where('unit_name', $unitName)->value('id');
            if (!$unitId) {
                $unitId = DB::table('units')->insertGetId(['unit_name' => $unitName]);
            }

            // 4. Find/Create Vehicle Type
            $typeId = DB::table('vehicle_types')->where('vechicle_type', $vehicleType)->value('id');
            if (!$typeId) {
                $typeId = DB::table('vehicle_types')->insertGetId([
                    'vechicle_type' => $vehicleType,
                    'unit_id' => $unitId
                ]);
            }

            // 5. Find Site User
            $siteUserId = DB::table('users')->where('role_id', 2)->where('site_id', $siteId)->value('id');
            if (!$siteUserId)
                continue;

            DB::table('walkin_vehicles')->insert([
                'user_id' => $siteUserId,
                'party_id' => $partyId,
                'vehicle_number' => $vehicleNo,
                'vehicle_type_id' => $typeId,
                'unit_id' => $unitId,
                'in_time' => $inTime,
                'out_time' => $outTime,
                'spent_time' => $spentTime,
                'created_at' => $createdAtTS,
                'updated_at' => $updatedAtTS,
            ]);
        }
    }
}
