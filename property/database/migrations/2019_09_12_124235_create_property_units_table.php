<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_units', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('property_id')->nullable();
            $table->string('unit_name',255)->nullable();
            $table->string('rent',255)->nullable();
            $table->string('deposit',255)->nullable();
            $table->integer('created_user_id')->nullable();
            $table->integer('property_manager_id')->nullable();
            $table->integer('property_description_experts_id')->nullable();
            $table->integer('property_legal_advisor_id')->nullable();
            $table->integer('property_visit_organizer_id')->nullable();
            $table->string('po_esignature')->nullable();
            $table->integer('IsDeleted')->default(0);

            $table->string('tax')->default(0);
            $table->string('fix_price')->default(0);
            $table->string('choose_guarantor')->default('yes');

            $table->text('amenities')->nullable();
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
        Schema::dropIfExists('property_units');
    }
}
