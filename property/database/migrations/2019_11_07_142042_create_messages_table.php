<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('unit_id')->nullable();
            $table->integer('appointment_id')->nullable();
            $table->integer('booking_id')->nullable();
            $table->integer('tenant_id')->nullable();
            $table->integer('pde_id')->nullable();
            $table->integer('vo_id')->nullable();
            $table->string('send')->nullable();
            $table->string('received')->nullable();
            $table->string('email_type')->nullable();
            $table->longText('message')->nullable();
            $table->string('time')->nullable();
            $table->integer('status')->default('0')->comment('0= default, 1= send, 2 = did not send')->nullable();
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
        Schema::dropIfExists('messages');
    }
}
