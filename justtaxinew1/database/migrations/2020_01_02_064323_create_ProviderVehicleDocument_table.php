<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderVehicleDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_vehicle_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('provider_id');
            $table->bigInteger('vehicle_id');
            $table->string('document_id');
            $table->string('url');
            $table->string('unique_id')->nullable();
            $table->date('expiry')->nullable();
            $table->enum('status', ['PENDING','PROCESSING', 'ACTIVE', 'REJECT']);
            $table->timestamp('expires_at')->nullable();
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
        //
        Schema::dropIfExists('provider_vehicle_documents');
    }
}
