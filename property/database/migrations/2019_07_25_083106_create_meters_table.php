<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('property_id')->nullable();
            $table->string('meter_type')->nullable();
            $table->string('meter_number')->nullable();
            $table->string('ean_number')->nullable();
            $table->string('unit_price')->nullable();
            $table->string('document_file')->nullable();
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
        Schema::dropIfExists('meters');
    }
}
