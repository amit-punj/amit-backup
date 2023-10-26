<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPropertyUnitsTableAddColume extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_units', function (Blueprint $table) {
            $table->integer('created_user_id')->nullable();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('phone_no')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_units', function (Blueprint $table) {
            //
        });
    }
}
