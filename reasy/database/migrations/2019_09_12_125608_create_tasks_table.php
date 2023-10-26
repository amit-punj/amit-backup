<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('unit_id')->nullable();
            $table->bigInteger('contract_id')->nullable();
            $table->bigInteger('MeterReading_id')->nullable();
            $table->bigInteger('rent_id')->nullable();
            $table->string('purpose',255)->nullable();
            $table->string('name',255)->nullable();
            $table->text('description')->nullable();
            $table->date('task_date');
            $table->string('status','50')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
