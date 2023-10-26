<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets_feedback', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ticket_id')->nullable();
            $table->string('role')->nullable();
            $table->string('sender')->nullable();
            $table->string('reply')->nullable();
            $table->tinyInteger('IsDeleted')->default('0')->nullable();
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
        Schema::dropIfExists('tickets_feedback');
    }
}
