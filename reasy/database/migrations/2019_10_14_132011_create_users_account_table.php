<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_account', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('terminate_id')->nullable();
            $table->integer('booking_id')->nullable();
            $table->integer('user_type')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('ada_number')->nullable();
            $table->string('account_number')->nullable();
            $table->string('routing_number')->nullable();
            $table->string('paypal_email')->nullable();
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
        Schema::dropIfExists('users_account');
    }
}
