<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('unit_id')->nullable();
            $table->integer('tenant_id')->nullable();
            $table->integer('pde_id')->nullable();
            $table->integer('vo_id')->nullable();
            $table->string('send')->nullable();
            $table->string('received')->nullable();
            $table->string('email_type')->nullable();
            $table->longText('message')->nullable();
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
        Schema::dropIfExists('email_log');
    }
}
