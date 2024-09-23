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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->ipAddress('ip_address');
            $table->string('user_agent');
            $table->string('type');
            $table->integer('longitude');
            $table->integer('latitude');
            $table->string('country');
            $table->string('domain_name');
            $table->string('protocol'); 
            $table->string('random_date'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
