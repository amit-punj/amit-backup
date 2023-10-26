<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_id',50)->nullable();
            $table->string('subscription_id',100)->nullable();
            $table->string('plan_id',100)->nullable();
            $table->string('renew_time',50)->nullable();
            $table->string('amount',100)->nullable();
            $table->string('next_payment',50)->nullable();
            $table->string('failed',10)->nullable();
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
        Schema::dropIfExists('transaction');
    }
}
