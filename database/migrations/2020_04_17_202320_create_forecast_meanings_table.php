<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForecastMeaningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forecast_meanings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('number')->nullable();
            $table->text('content')->nullable();
            $table->string('position')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('forecast_meanings');
    }
}
