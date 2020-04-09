<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            
            /*
            $table->string("firstName");
            $table->string("lastName");
            $table->string("telephoneNumber");
            $table->string("email");
            */

            $table->string("addressStreet")->nullable();
            $table->string("addressNumber")->nullable();
            $table->integer("addressZipCode")->nullable();
            $table->string("addressCity")->nullable();      
            $table->text("details")->nullable();
            $table->dateTime("requestedTime");
            $table->boolean("confirmed")->default(false);
            $table->boolean("denied")->default(false);
            $table->string("deliveryMethod");
            $table->float("totalPrice")->nullable();
            $table->string("extratime")->nullable();

            $table->string("merchant_id");
            $table->string("customer_id")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
