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
            $table->string('property_type',100)->nullable();
            $table->string('size',500)->nullable();
            $table->bigInteger('price')->nullable();
            $table->integer('rooms')->nullable();
            $table->string('discription',3000)->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('city_name',200)->nullable();
            $table->string('longitude',100)->nullable();
            $table->string('latitude',100)->nullable();
            $table->string('purpose',200)->nullable();
            $table->text('address')->nullable();
            $table->string('type',50)->nullable();
            $table->string('status',50)->nullable();
            $table->integer('bathroom')->nullable();
            $table->string('half_bathroom')->nullable();
            $table->text('cross_streets')->nullable();
            $table->string('amenities',300)->nullable();
            $table->string('local_area',255);
            $table->string('all_cash',50);
            $table->string('exchange',50);
            $table->string('cover_pic',150)->nullable();
            $table->string('title',150)->nullable();
            $table->integer('client')->nullable();

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
