<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provider_id');
            $table->integer('service_type_id');
            $table->integer('chassis_number');
            $table->enum('status', ['active', 'offline','riding','expired']);
            $table->tinyInteger('prime')->default('0')->nullable();
            $table->tinyInteger('active_status')->default('0')->nullable();
            $table->string('service_number')->nullable();
            $table->string('service_model')->nullable();
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
        Schema::dropIfExists('provider_services');
    }
}
