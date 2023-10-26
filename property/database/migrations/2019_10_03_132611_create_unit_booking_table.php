<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_booking', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('unit_id')->nullable();
            $table->integer('form_status')->nullable();
            $table->integer('contract_id')->nullable();
            $table->integer('tenant_id')->nullable();
            $table->integer('guarantor_id')->nullable();
            $table->integer('pde_id')->nullable();
            $table->integer('vo_id')->nullable();
            $table->integer('pm_id')->nullable();
            $table->integer('po_id')->nullable();
            $table->integer('terminate_id')->nullable();
            $table->integer('appointment_booked','2')->default('0')->nullable();
            $table->integer('lad_id')->nullable();
            $table->integer('transaction_id')->nullable();
            $table->string('contract_type')->nullable();
            $table->string('start_date')->nullable();
            $table->string('choose_guarantor')->default('yes')->nullable();
            $table->string('end_date')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('dues')->default('0')->nullable();
            $table->string('damage')->default('0')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('status')->comment('-1 = pending request, 0 = draft,1= pending payment, 2= payment done, 3 = accept, 4 = reject by pm, 5 = expert done, 6 = complete, 7 = cancel by tenant, 8 = terminate request by tenant, 9 = termination accepted by pm or po, 10 = unable to upload receipt')->default('-1')->nullable();
            $table->string('tenant_pay_slip')->nullable();
            $table->string('remark')->nullable();
            $table->string('guarantor')->default('yes')->nullable();
            $table->string('receipt_upload_time')->nullable();
            $table->string('rent_agreement')->nullable();
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
        Schema::dropIfExists('unit_booking');
    }
}
