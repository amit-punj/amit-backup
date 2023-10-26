<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhotoToUnitBooking extends Migration
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
            $table->string('tenant_photo')->nullable();
            $table->string('tenant_photo_id_proof')->nullable();
            $table->string('tenant_photo_esignature')->nullable();
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
