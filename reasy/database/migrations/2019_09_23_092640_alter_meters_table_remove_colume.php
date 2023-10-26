<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMetersTableRemoveColume extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meters', function (Blueprint $table) {
            $table->dropColumn('date_of_reading');
            $table->dropColumn('reading_value');
            $table->renameColumn('property_id', 'unit_id');
            $table->renameColumn('property_unit_id', 'user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meters', function (Blueprint $table) {
            //
        });
    }
}
