<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('company')->nullable();
            $table->string('parish')->nullable();
            $table->string('district')->nullable();
            $table->string('province')->nullable();
            $table->string('postal')->nullable();
            $table->integer('contact')->nullable();
            $table->text('remake')->nullable();
            $table->integer('user_id')->unsigned();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('addresses');
    }
}
