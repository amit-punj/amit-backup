<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refunds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('contract_id')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('tenant_id')->nullable();
            $table->integer('po_id')->nullable();
            $table->integer('refund_amount')->nullable();
            $table->string('method')->nullable();
            $table->string('refundID')->nullable();
            $table->string('time')->nullable();
            $table->string('status')->nullable();
            $table->string('related_to')->nullable();
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
        Schema::dropIfExists('refunds');
    }
}
