<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quest_targets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('number_of_trips');
            $table->dateTime('time_period');
            $table->integer('bonus_amount');
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
        Schema::dropIfExists('driver_promo_code');
    }
}
