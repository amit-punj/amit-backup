<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequirementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirement', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('property_type',200)->nullable();
            $table->bigInteger('min_price')->nullable();
            $table->bigInteger('max_price')->nullable();
            $table->string('discription',3000)->nullable();
            $table->integer('userid');
            $table->string('purpose',200)->nullable();
            $table->integer('min_room')->nullable();
            $table->integer('max_room')->nullable();
            $table->string('all_cash',40)->nullable();
            $table->string('exchange',20)->nullable();
            $table->string('pre_approved',250)->nullable();
            $table->string('investment_buyer',250)->nullable();
            $table->string('status',250)->nullable();
            $table->integer('min_bathroom')->nullable();
            $table->integer('max_bathroom')->nullable();
            $table->string('amenities',400)->nullable();
            $table->string('city_name',200)->nullable();
            $table->string('local_area',300)->nullable();
            $table->string('latitude',100)->nullable();
            $table->string('longitude',100)->nullable();
            $table->string('min_size',70)->nullable();
            $table->string('max_size',70)->nullable();
            $table->string('title',200)->nullable();
            $table->string('email',200)->nullable();
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
        Schema::dropIfExists('requirement');
    }
}
