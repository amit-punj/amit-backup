<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('payment_email',255);
            $table->string('status',255);
            $table->string('first_name',255);
            $table->string('last_name',255);
            $table->string('payer_id',255);
            $table->integer('total_amount');
            $table->string('currency',255);
            $table->string('payment_time',255);
            $table->integer('plan_id')->nullable();
            $table->string('membership_end_at',255);
            $table->string('deleted_at')->default(0);
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
        Schema::dropIfExists('membership_payments');
    }
}
