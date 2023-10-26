<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPropertyUnitsColume extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_units', function (Blueprint $table) {
            $table->string('unit_category')->nullable();
            $table->string('area_in')->nullable()->comment('SI unit of area');
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
