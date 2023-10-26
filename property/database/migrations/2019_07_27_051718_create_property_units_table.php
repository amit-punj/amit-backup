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
            $table->string('unit_name')->nullable();
            $table->string('rent')->nullable();
            $table->string('deposit')->nullable();
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
