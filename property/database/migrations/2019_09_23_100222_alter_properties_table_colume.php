<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPropertiesTableColume extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->renameColumn('title', 'unit_name');
            $table->renameColumn('location', 'address');
            $table->renameColumn('property_type', 'p_type');
            $table->dropColumn('rent');
            $table->dropColumn('deposite');
            $table->dropColumn('meter_id');
            $table->dropColumn('property_doc');
            $table->integer('property_manager_id')->nullable();
            $table->integer('property_description_experts_id')->nullable();
            $table->integer('property_legal_advisor_id')->nullable();
            $table->integer('property_visit_organizer_id')->nullable();
            $table->string('registration_possible')->nullable();
            $table->string('cleaning_commonc_room_incl')->nullable();
            $table->string('cleaning_private_room_incl')->nullable();
            $table->string('animal_allowed')->nullable();
            $table->string('play_musical_instrument')->nullable();
            $table->string('smoking_allowed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            //
        });
    }
}
