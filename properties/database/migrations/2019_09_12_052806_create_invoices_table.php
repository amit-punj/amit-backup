<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('package_id')->nullable();
            $table->string('package_name')->nullable();
            $table->string('title')->nullable();
            $table->double('price')->nullable();
            $table->integer('paid')->nullable();
            $table->string('subscription_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->timestamp('last_payment')->nullable();
            $table->timestamp('next_payment')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
