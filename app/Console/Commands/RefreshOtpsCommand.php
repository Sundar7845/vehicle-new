<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class RefreshOtpsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'otp:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh OTPs for all sites/users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::where('role_id', 2)->get();

        foreach ($users as $user) {
            $user->otp = rand(1000, 9999);
            $user->otp_expires_at = now()->addMinute();
            $user->save();
        }

        $this->info('OTPs refreshed successfully at ' . now());
    }
}
