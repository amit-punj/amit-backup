<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPropertyUnitsTableRemoveColume extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_units', function (Blueprint $table) {
            $table->string('p_type')->nullable()->change();
            $table->dropColumn('created_user_id');
            $table->dropColumn('property_id');
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
