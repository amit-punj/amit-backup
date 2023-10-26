<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('unit_id')->nullable();
            $table->integer('contract_id')->nullable();
            $table->integer('tenant_id')->nullable();
            $table->integer('pde_id')->nullable();
            $table->integer('vo_id')->nullable();
            $table->integer('terminate_id')->nullable();
            $table->string('created_by')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('appointment_type')->nullable();
            $table->longText('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('time')->nullable();
            $table->integer('book_status')->default(0);
            $table->integer('reply_status')->default(0)->comment('0= default, 1= send, 2 = did not send');
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
        Schema::dropIfExists('appointments');
    }
}
