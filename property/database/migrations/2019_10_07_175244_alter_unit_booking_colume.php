<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUnitBookingColume extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('unit_booking', function (Blueprint $table) {
            $table->string('contract_communication_language', 50)->nullable();
            $table->string('signature_date')->nullable();
            $table->string('rent')->nullable();
            $table->string('cost_provision')->nullable();
            $table->string('fixed_charges')->nullable();
            $table->string('property_tax')->nullable();
            $table->string('deposit_amount')->nullable();
            $table->string('contract_time')->nullable();
            $table->string('sendMail_time')->nullable();
            $table->integer('current_status')->default(0)->comment('0 =  already in draft, 1 =  passed booking,');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unit_booking', function (Blueprint $table) {
            //
        });
    }
}
