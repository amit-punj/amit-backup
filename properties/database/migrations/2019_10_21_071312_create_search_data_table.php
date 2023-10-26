<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('property_type')->nullable();
            $table->string('purpose')->nullable();
            $table->integer('min_price')->nullable();
            $table->integer('max_price')->nullable();
            $table->integer('min_bathroom')->nullable();
            $table->integer('max_bathroom')->nullable();
            $table->string('min_room')->nullable();
            $table->string('max_room')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('exchange')->nullable();
            $table->integer('bathroom')->nullable();
            $table->integer('room')->nullable();
            $table->integer('price')->nullable();
            $table->string('type')->nullable();
            $table->string('all_cash')->nullable();
            $table->string('city_name')->nullable();
            $table->string('search_type')->nullable();
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
        Schema::dropIfExists('search_data');
    }
}
