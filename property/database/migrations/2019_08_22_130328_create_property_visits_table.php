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
            $table->string('time')->nullable();
            $table->integer('tenant_id')->nullable();
            $table->integer('property_id')->nullable();
            $table->integer('property_unit_id')->nullable();
            $table->longText('message')->nullable();
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
