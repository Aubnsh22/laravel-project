<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('expected_hours', function (Blueprint $table) {
            $table->id();
            $table->date('week_start_date'); // The start date of the week (e.g., Monday)
            $table->time('monday_start_time')->nullable(); // Start time for Monday
            $table->time('monday_end_time')->nullable();   // End time for Monday
            $table->time('tuesday_start_time')->nullable();
            $table->time('tuesday_end_time')->nullable();
            $table->time('wednesday_start_time')->nullable();
            $table->time('wednesday_end_time')->nullable();
            $table->time('thursday_start_time')->nullable();
            $table->time('thursday_end_time')->nullable();
            $table->time('friday_start_time')->nullable();
            $table->time('friday_end_time')->nullable();
            $table->time('saturday_start_time')->nullable();
            $table->time('saturday_end_time')->nullable();
            $table->time('sunday_start_time')->nullable();
            $table->time('sunday_end_time')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('expected_hours');
    }
};