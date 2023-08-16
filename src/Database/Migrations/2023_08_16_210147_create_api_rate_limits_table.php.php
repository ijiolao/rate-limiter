<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //create the rate limit table
        Schema::create('api_rate_limits', function (Blueprint $table) {
            $table->id();
            $table->string('user_identifier'); //ip address or userID
            $table->string('endpoint'); //endpoint being requested
            $table->dateTime('request_at'); //timestamp of the request
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('api_rate_limits');
    }
};
