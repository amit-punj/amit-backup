<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBookingStatusToPropertyUnits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_units', function (Blueprint $table) {
            //
            $table->string('booking_status')->default('0')->comment('0 for view in front,1 for draft contract, 2 for complete contract');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_units', function (Blueprint $table) {
            //
        });
    }
}
