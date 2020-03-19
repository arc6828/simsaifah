<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('category');
            $table->integer('discount')->nullable();
            $table->integer('dept')->nullable();
            $table->integer('total')->nullable();
            $table->string('status')->nullable();
            $table->integer('tracking_number')->nullable();
            $table->string('bank')->nullable();
            $table->string('slip')->nullable();
            $table->integer('order_id')->unsigned();
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
        Schema::drop('payments');
    }
}
