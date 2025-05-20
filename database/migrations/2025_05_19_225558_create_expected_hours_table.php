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
            $table->decimal('monday_hours', 5, 2)->default(0); // Expected hours for Monday
            $table->decimal('tuesday_hours', 5, 2)->default(0); // Expected hours for Tuesday
            $table->decimal('wednesday_hours', 5, 2)->default(0); // Expected hours for Wednesday
            $table->decimal('thursday_hours', 5, 2)->default(0); // Expected hours for Thursday
            $table->decimal('friday_hours', 5, 2)->default(0); // Expected hours for Friday
            $table->decimal('saturday_hours', 5, 2)->default(0); // Expected hours for Saturday
            $table->decimal('sunday_hours', 5, 2)->default(0); // Expected hours for Sunday
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('expected_hours');
    }
};
