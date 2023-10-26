<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('postal')->nullable()->change();
            $table->string('nr')->nullable()->change();
            $table->string('postal_code')->nullable()->change();
            $table->string('city')->nullable()->change();
            $table->string('id_card')->nullable()->change();
            $table->string('professional_status')->nullable()->change();
            $table->string('company_name')->nullable()->change();

            $table->string('tenant_type')->nullable();
            $table->string('school_company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('vat_nr')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('bank_account_number')->nullable();
        });

        //
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
