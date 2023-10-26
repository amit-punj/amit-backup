<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetersReadingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meter_readings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('meter_id')->nullable();
            $table->integer('unit_id')->nullable();
            $table->string('reading_date')->nullable();
            $table->integer('last_reading')->nullable();
            $table->integer('current_reading')->nullable();
            $table->integer('per_unit_price')->nullable();
            $table->integer('amount')->nullable();
            $table->string('reading_type')->nullable();
            $table->string('status')->nullable();
            $table->string('upload_document')->nullable();
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
        Schema::dropIfExists('meter_readings');
    }
}
