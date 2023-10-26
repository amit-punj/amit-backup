<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPropertyUnitsTableAddColume1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_units', function (Blueprint $table) {
            $table->integer('user_id')->nullable();
            $table->integer('p_type')->nullable();
            $table->integer('area')->nullable();
            $table->longText('description')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->longText('address')->nullable();
            $table->string('u_type')->nullable();
            $table->integer('building_id')->nullable();
            //$table->integer('rent')->nullable();
            $table->integer('cost_provision')->nullable();
            //$table->integer('deposit')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->string('bed_funished')->nullable();
            $table->string('bed_lock')->nullable();
            $table->string('kitchen')->nullable();
            $table->string('toilet')->nullable();
            $table->string('living_room')->nullable();
            $table->string('balcony_terrace')->nullable();
            $table->string('garden')->nullable();
            $table->string('basement')->nullable();
            $table->string('parking')->nullable();
            $table->string('wheelchair')->nullable();
            $table->string('allergy_friendly')->nullable();
            //$table->longText('amenities')->nullable();
            $table->string('preferred_gender')->nullable();
            $table->integer('min_age')->nullable();
            $table->integer('max_age')->nullable();
            $table->string('tenant_type')->nullable();
            $table->string('couples_allowed')->nullable();
            $table->string('registration_possible')->nullable();
            $table->string('cleaning_commonc_room_incl')->nullable();
            $table->string('cleaning_private_room_incl')->nullable();
            $table->string('animal_allowed')->nullable();
            $table->string('play_musical_instrument')->nullable();
            $table->string('smoking_allowed')->nullable();
            $table->longText('cover_image')->nullable();
            $table->longText('images')->nullable();
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
