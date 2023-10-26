<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_appointment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tenent_id')->nullable();
            $table->integer('contract_id')->nullable();
            $table->longText('title')->nullable();
            $table->integer('pde_id')->nullable();
            $table->integer('unit_id')->nullable(); 
            $table->longText('text')->nullable();
            $table->longText('time')->nullable(); 
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('book_appointment');
    }
}
