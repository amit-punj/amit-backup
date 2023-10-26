<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_vendors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('building_id')->nullable();
            $table->integer('property_unit_id')->nullable();
            $table->string('vendor_type')->nullable();
            $table->string('name')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('property_vendors');
    }
}
