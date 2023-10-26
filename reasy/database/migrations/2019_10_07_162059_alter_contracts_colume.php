<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterContractsColume extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contracts', function (Blueprint $table) {
            //$table->renameColumn('property_id', 'unit_id');
            $table->integer('user_id')->nullable();
            $table->string('contract_communication_language', 50)->nullable();
            $table->integer('description_expert_id')->nullable();
            $table->string('signature_date')->nullable();
            $table->string('rent')->nullable();
            $table->string('cost_provision')->nullable();
            $table->string('fixed_charges')->nullable();
            $table->string('property_tax')->nullable();
            $table->string('deposit_amount')->nullable();
            $table->string('contract_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contracts', function (Blueprint $table) {
            //
        });
    }
}
