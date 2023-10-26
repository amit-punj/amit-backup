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
            $table->string('name',191);
            $table->string('email',191)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',191);
            $table->enum('role', ['1', '2', '3', '4'])->default(4);
            $table->string('phone_no',50)->nullable();
            $table->string('public_view',50)->nullable();
            $table->string('telephone',50)->nullable();
            $table->string('address',200)->nullable();
            $table->integer('zipcode')->nullable();
            $table->string('fname',100)->nullable();
            $table->string('lname',100)->nullable();
            $table->string('profile_pic',191)->nullable();
            $table->string('firm_logo',191)->nullable();
            $table->string('state',50)->nullable();
            $table->string('agent_profile_url',100)->nullable();
            $table->string('state_licence_id',70)->nullable();
            $table->string('realestate_firm',100)->nullable();
            $table->string('city_name',100)->nullable();
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
