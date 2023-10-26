<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerminateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('step')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('booking_id')->nullable();
            $table->integer('tenant_id')->nullable();
            $table->integer('pde_id')->nullable();
            $table->integer('pm_id')->nullable();
            $table->integer('po_id')->nullable();
            $table->bigInteger('transaction_id')->nullable();
            $table->integer('appointment_id')->nullable();
            $table->string('appointment_time')->nullable();
            $table->string('notice')->nullable();
            $table->string('notice_period_date')->nullable();
            $table->string('report')->nullable();
            $table->string('pay_dues')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->comment('pending,paid')->nullable();
            $table->string('claim_method')->nullable();
            $table->string('refund_status')->default('pending')->comment('pending,paid')->nullable();
            $table->string('status')->comment('0 = termination request, 1 = book appointment, 2 = appointment done, 3 = pending PDE report, 4 = upload PDE report, 5 = payment pending with bank, 6 = payment paid, 7 = dues clear, 8 = refund claimed, 9 = refund status pending, 10 = refund status paid')->nullable();
            $table->string('StatusForPMPO')->default('0')->comment('column for asking PM or PO to update the final status of termination request and let unit to show in frontend to another booking, 0 = by default to Wait to update status for PO and PM, 1 = asking to update, 2 = updated')->nullable();
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
        Schema::dropIfExists('terminate');
    }
}
