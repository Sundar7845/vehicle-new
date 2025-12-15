<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPartyIdToWalkinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('walkin_vehicles', function (Blueprint $table) {
            $table->unsignedBigInteger('party_id')->nullable()->after('user_id');
            $table->foreign('party_id')->references('id')->on('parties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('walkin_vehicles', function (Blueprint $table) {
            $table->dropForeign(['party_id']);
        });
    }
}
