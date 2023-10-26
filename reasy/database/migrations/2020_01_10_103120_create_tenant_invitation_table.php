<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantInvitationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_invitations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('unit_id')->nullable();
            $table->bigInteger('booking_id')->nullable();
            $table->bigInteger('tenant_id')->nullable();
            $table->string('email')->nullable();
            $table->string('send_time')->nullable();
            $table->enum('status',['Yes', 'No'])->default('No')->nullable();
            $table->tinyInteger('response')->default('0')->nullable();
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
        Schema::dropIfExists('tenant_invitations');
    }
}
