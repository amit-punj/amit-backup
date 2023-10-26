<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',191);
            $table->text('logo');
            $table->string('site_video',250)->nullable();
            $table->string('instagram',250)->nullable();
            $table->string('twitter',250)->nullable();
            $table->string('facebook',250)->nullable();
            $table->text('admin_email');
            $table->string('email',250)->nullable();
            $table->text('address_line_1');
            $table->text('address_line_2');
            $table->text('city');
            $table->text('country');
            $table->text('state');
            $table->text('postcode');
            $table->text('fb_appID');
            $table->text('fd_secretKey');
            $table->text('stripe_appID');
            $table->text('stripe_secretKey');
            $table->text('smtp_host');
            $table->text('smtp_port');
            $table->text('smtp_protocol');
            $table->text('smtp_username');
            $table->text('smtp_password');
            $table->string('remember_token',100)->nullable();
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
        Schema::dropIfExists('general_settings');
    }
}
