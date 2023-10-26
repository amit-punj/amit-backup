<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('provider_name')->nullable();
            $table->string('image')->nullable();
            $table->integer('capacity')->default(0);
            $table->float('fixed' ,10, 2)->default(0);
            $table->float('price' , 10,2)->default(0);
            $table->float('minute' , 10,2)->default(0);
            $table->integer('hour')->nullable();
            $table->float('night_charges',10, 2)->default(0);
            $table->float('airport_charges',10, 2)->default(0);
            $table->float('cancellation_fee',10, 2)->default(0);
            $table->float('platform_fee',10, 2)->default(0);
            $table->text('surge')->nullable();
            $table->integer('distance');
            $table->enum('calculator', ['MIN', 'HOUR', 'DISTANCE', 'DISTANCEMIN', 'DISTANCEHOUR']);
            $table->string('description')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('service_types');
    }
}