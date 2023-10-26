<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('area_type');
            $table->string('property_type');
            $table->string('size_min')->nullable();
            $table->string('size_max')->nullable();
            $table->string('price_min')->nullable();
            $table->string('price_max')->nullable();
            $table->string('rooms')->nullable();
            $table->string('discription')->nullable();
            $table->integer('userid');
            $table->string('location')->nullable();
            $table->string('useremail')->nullable();
            $table->string('purpose')->nullable();
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
        Schema::dropIfExists('property');
    }
}
