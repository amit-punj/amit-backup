<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::defaultStringLength(191);
          Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('confirmation_code',250)->nullable();
            $table->integer('verified')->default(0);
            $table->integer('receipt_failed_count')->default(0);
            $table->integer('user_role')->default(1)->comment(' 0-admin, 1-Tenant, 2-Property Owner, 3-Property Manager, 4-Property Description Experts, 5-Legal Advisor, 6- Visit Organizer');
            $table->string('last_name',255)->nullable();
            $table->string('phone_no',20)->nullable();
            $table->string('wallet_amount')->default('0')->nullable();
            $table->string('gender',255)->nullable();
            $table->string('image',255)->nullable();
            $table->string('google_id',255)->nullable();
            $table->string('facebook_id',255)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
