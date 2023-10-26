<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('po_id')->nullable();
            $table->integer('user_role')->nullable()->comment('3-Property Manager, 4-Property Description Experts, 5-Legal Advisor, 6- Visit Organizer');
            $table->integer('unit_permission')->nullable()->comment('0 = Read, 1 = Write,2 = Full Access');
            $table->integer('contract_permission')->nullable()->comment('0 = Read, 1 = Write,2 = Full Access');
            $table->integer('meter_permission')->nullable()->comment('0 = Read, 1 = Write,2 = Full Access');
            $table->integer('reading_permission')->nullable()->comment('0 = Read, 1 = Write,2 = Full Access');
            $table->integer('booking_permission')->nullable()->comment('0 = Read, 1 = Write,2 = Full Access');
            $table->integer('transactio_permission')->nullable()->comment('0 = Read, 1 = Write,2 = Full Access');
            $table->integer('documents_permission')->nullable()->comment('0 = Read, 1 = Write,2 = Full Access');
            $table->integer('tickets_permission')->nullable()->comment('0 = Read, 1 = Write,2 = Full Access');
            $table->integer('legal_permission')->nullable()->comment('0 = Read, 1 = Write,2 = Full Access');
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
        Schema::dropIfExists('access_permissions');
    }
}
