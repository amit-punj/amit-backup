<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyEmailUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('company_email')->nullable();
            $table->string('company_phone')->nullable();

            $table->string('tenant_address')->nullable();
            $table->string('tenant_photo')->nullable();
            $table->string('tenant_photo_id_proof')->nullable();
            $table->string('tenant_photo_esignature')->nullable();
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
    }
}
