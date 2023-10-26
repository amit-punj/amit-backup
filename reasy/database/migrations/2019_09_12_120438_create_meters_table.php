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
            $table->string('meter_type',255)->nullable();
            $table->string('meter_number',255)->nullable();
            $table->string('ean_number',255)->nullable();
            $table->string('unit_price',255)->nullable();
            $table->string('document_file',255)->nullable();
            $table->integer('property_unit_id')->nullable();
            $table->integer('consumption')->default(0)->nullable();
            $table->string('date_of_reading',255)->nullable();
            $table->integer('reading_value')->nullable();

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
