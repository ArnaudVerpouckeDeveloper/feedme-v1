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
