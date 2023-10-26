<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUnitsRentColume extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('units_rent', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->string('rent_status')->nullable()->comment('pending,paid,processing,hold');
            $table->string('date')->nullable()->comment('Rent for Month')->change();
            $table->string('payment_method')->nullable()->change();
            $table->string('payment_status')->nullable()->change();
            $table->bigInteger('total_amount')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('units_rent', function (Blueprint $table) {
            //
        });
    }
}
