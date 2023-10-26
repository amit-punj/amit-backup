<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('token',255)->nullable();
            $table->string('user_role',255)->nullable();
            $table->string('name',255)->nullable();
            $table->string('email',255)->nullable();
            $table->longText('message')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('property_id')->nullable();
            $table->integer('property_unit_id')->nullable();
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
        Schema::dropIfExists('invitations');
    }
}
