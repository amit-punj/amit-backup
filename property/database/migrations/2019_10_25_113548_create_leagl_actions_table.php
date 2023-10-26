<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaglActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagl_actions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('related_to')->nullable();
            $table->integer('po_id')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('tenant_id')->nullable();
            $table->integer('legal_advisor_id')->nullable();
            $table->integer('contract_id')->nullable();
            $table->string('due_amount')->nullable();
            $table->text('comment')->nullable();
            $table->string('status')->nullable();
            $table->string('create_time')->nullable();
            $table->string('action_time')->nullable();
            $table->text('action_comment')->nullable();
            $table->string('document')->nullable();
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
        Schema::dropIfExists('leagl_actions');
    }
}
