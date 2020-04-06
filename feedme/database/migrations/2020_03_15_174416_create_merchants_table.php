<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->unsigned();
            $table->string("name");
            $table->string("apiName");
            $table->string("message")->nullable();
            $table->string("logoFileName")->nullable();
            $table->string("bannerFileName")->nullable();
            $table->boolean("deliveryMethod_takeaway")->default(true);
            $table->boolean("deliveryMethod_delivery")->default(true);
            $table->timestamps();
            $table->string("merchantPhone");
            $table->string("address_street");
            $table->string("address_number");
            $table->integer("address_zip");
            $table->string("address_city");
            $table->string("tax_number");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchants');
    }
}
