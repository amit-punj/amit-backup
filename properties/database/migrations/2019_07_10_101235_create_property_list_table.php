<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('property_type');
            $table->string('size');
            $table->string('price');
            $table->string('rooms');
            $table->string('discription');
            $table->integer('userid');
            $table->string('city_name');
            $table->string('useremail');
            $table->string('purpose');
            $table->string('bathroom');
            $table->integer('amenities ');
            $table->string('local_area');
            $table->string('all_cash');
            $table->string('exchange');
            $table->string('cover_pic');
            $table->string('title');
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
        Schema::dropIfExists('property_list');
    }
}
