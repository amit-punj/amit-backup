<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_visits', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->string('time',255)->nullable();
            $table->integer('tenant_id')->nullable();
            $table->integer('property_id')->nullable();
            $table->integer('property_unit_id')->nullable();
            $table->integer('property_visit_organizer_id')->nullable();
            $table->string('title',500)->nullable();
            $table->longText('description')->nullable();
            $table->bigInteger('phone_number');
            $table->string('email',255);
            $table->string('name',255);
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
        Schema::dropIfExists('property_visits');
    }
}
