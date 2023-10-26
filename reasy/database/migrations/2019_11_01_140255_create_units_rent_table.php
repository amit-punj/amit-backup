<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsRentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units_rent', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('electric_bill')->nullable();
            $table->integer('water_bill')->nullable();
            $table->integer('gas_bill')->nullable();
            $table->integer('rent')->nullable();
            $table->integer('total_amount')->nullable();
            $table->integer('status')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('contract_id')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('date')->nullable();
            $table->integer('payment_method')->nullable();
            $table->integer('payment_status')->nullable();
            $table->integer('wallet_balance')->nullable();
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
        Schema::dropIfExists('units_rent');
    }
}
