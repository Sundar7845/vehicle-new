<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAdminSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_sites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Admin ID
            $table->unsignedBigInteger('site_id'); // Site ID
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');

            // Unique constraint to prevent duplicate access
            $table->unique(['user_id', 'site_id']);
        });

        // DATA MIGRATION: Copy existing site ownership to pivot table
        $sites = DB::table('sites')->whereNotNull('user_id')->get();
        $pivotData = [];
        $now = now();

        foreach ($sites as $site) {
            $pivotData[] = [
                'user_id' => $site->user_id,
                'site_id' => $site->id,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        if (!empty($pivotData)) {
            DB::table('admin_sites')->insert($pivotData);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_sites');
    }
}
