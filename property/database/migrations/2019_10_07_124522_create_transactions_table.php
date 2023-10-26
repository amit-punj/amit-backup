<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('paypal_id')->nullable();
            $table->string('saleId')->nullable();
            $table->integer('booking_id')->nullable();
            $table->integer('tenant_id')->nullable();
            $table->bigInteger('terminate_id')->nullable();
            $table->string('paypal_PayerID')->nullable();
            $table->string('paypal_status')->nullable();
            $table->string('related_to')->nullable();
            $table->string('description')->nullable();
            $table->string('amount')->default(0);
            $table->string('payment_by')->nullable();
            $table->string('stripe_refundID')->nullable();
            
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
        Schema::dropIfExists('transactions');
    }
}
