<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->integer('user_id');
            $table->string('title',255)->nullable();
            $table->string('location',255)->nullable();
            $table->double('rent')->nullable();
            $table->double('deposite')->nullable();
            $table->integer('meter_id')->nullable();
            $table->longText('property_doc')->nullable();
            $table->string('cover_image',255)->nullable();
            $table->longText('images')->nullable();
            $table->string('property_type',255)->nullable();
            $table->string('latitude',50)->nullable();
            $table->string('longitude',50)->nullable();
            $table->double('area')->nullable();
            $table->longText('description')->nullable();
            $table->string('status',250)->nullable();
            $table->integer('IsDeleted')->default(0);
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
        Schema::dropIfExists('properties');
    }
}
