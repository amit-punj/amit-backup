<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('referrals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('referral_code')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->tinyInteger('IsDeleted')->default('0')->nullable();
            $table->softDeletes();
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
        //
    }
}
