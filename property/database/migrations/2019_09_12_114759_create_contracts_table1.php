<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
           // $table->integer('property_id')->nullable();
            //$table->integer('property_unit_id')->nullable();
            $table->string('contract_type',255)->nullable();
            $table->integer('unit_id')->nullable();
            $table->string('starting_date',255)->nullable();
            $table->string('end_date',255)->nullable();
            $table->string('document_file',255)->nullable();
            $table->integer('tenent_id')->nullable();
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
        Schema::dropIfExists('contracts');
    }
}
