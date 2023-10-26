<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('faqs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_id')->nullable();
            $table->string('question');
            $table->longText('answer');
            $table->integer('status')->default(0);
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
        //
        Schema::dropIfExists('faqs');
    }
}
