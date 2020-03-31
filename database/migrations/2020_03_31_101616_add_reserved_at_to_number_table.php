<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReservedAtToNumberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('numbers', function (Blueprint $table) {
            $table->dateTime('reserved_at')->nullable();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('bookedorder_at');
            $table->dropColumn('successful_at');
            $table->dropColumn('cancel_at');
        });
        
        Schema::table('orders', function (Blueprint $table) {
            $table->dateTime('bookedorder_at')->nullable();
            $table->dateTime('successful_at')->nullable();
            $table->dateTime('cancel_at')->nullable();
        });
       
        
        Schema::table('payments', function (Blueprint $table) {            
            $table->dropColumn('chackpayment_at');
            $table->dropColumn('delivery_at');
            $table->dropColumn('cancelpayment_at');
        });

        Schema::table('payments', function (Blueprint $table) {   
            $table->dateTime('chackpayment_at')->nullable();
            $table->dateTime('delivery_at')->nullable();
            $table->dateTime('cancelpayment_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('numbers', function (Blueprint $table) {
            //
        });
    }
}
