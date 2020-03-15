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
            
            $table->string("firstName");
            $table->string("lastName");
            $table->string("telephoneNumber");
            $table->string("email");

            $table->string("addressStreet");
            $table->string("addressNumber");
            $table->integer("addressZipCode");
            $table->string("addressCity");      
            $table->text("details");
            $table->dateTime("deliveryOn");
            $table->boolean("confirmed");

            $table->string("merchant_id");
            //$table->string("customer_id");
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
