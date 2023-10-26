<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_tenants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('unit_id')->nullable();
            $table->integer('booking_id')->nullable();
            $table->integer('tenant_id')->nullable();
            $table->integer('pde_id')->nullable();
            $table->integer('pm_id')->nullable();
            $table->integer('po_id')->nullable();
            $table->integer('isDeleted')->default('0')->nullable();
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
        Schema::dropIfExists('sub_tenants');
    }
}
