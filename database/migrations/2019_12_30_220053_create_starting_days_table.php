<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStartingDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('starting_days', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->enum('shift', ['prva', 'druga']);
            $table->unsignedInteger('durationOfShiftInDays')->default(3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('starting_days');
    }
}
