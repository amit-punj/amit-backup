<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentStatusToUnitBooking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('unit_booking', function (Blueprint $table) {
            //
            $table->string('payment_status')->comment('pending,paid')->nullable();
            $table->string('status')->comment('0 = draft,1= pending payment, 2= payment done, 3 = accept, 4 = reject by pm, 5 = expert done, 6 = complete, 7 = cancel by tenant')->change();
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
