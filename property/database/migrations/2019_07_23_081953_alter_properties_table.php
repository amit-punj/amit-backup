<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('title')->nullable()->change();
            $table->string('location')->nullable()->change();
            $table->float('rent')->nullable()->change();
            $table->float('deposite')->nullable()->change(); 
            $table->integer('meter_id')->nullable()->change();
            $table->longText('property_doc')->nullable()->change();
            $table->longText('images')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            //
        });
    }
}
