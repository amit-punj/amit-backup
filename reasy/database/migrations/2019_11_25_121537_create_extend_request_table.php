<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtendRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extend_request', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('unit_id')->nullable();
            $table->integer('booking_id')->nullable();
            $table->integer('tenant_id')->nullable();
            $table->integer('pde_id')->nullable();
            $table->integer('pm_id')->nullable();
            $table->integer('po_id')->nullable();
            $table->string('extend_date')->nullable();
            $table->string('extend_time')->nullable();
            $table->string('remark')->nullable();
            $table->bigInteger('transaction_id')->nullable();
            $table->string('status')->comment('0 = termination request, 1 = accept, 2 = reject')->nullable();
            $table->integer('isDeleted')->default('0')->nullable();
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
        Schema::dropIfExists('extend_request');
    }
}
