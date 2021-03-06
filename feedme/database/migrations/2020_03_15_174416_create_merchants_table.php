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
            $table->integer("amountOfVisitors")->default(0);

            $table->string("minimumWaitTime_takeaway",20)->default("00:30");
            $table->string("minimumWaitTime_delivery",20)->default("01:00");

            $table->float("minimumOrderValue",20)->default("0.00");
            $table->float("deliveryCost",20)->default("0.00");

            $table->string("takeaway_monday_from_1",20)->default("11:30");
            $table->string("takeaway_monday_till_1",20)->default("13:30");
            $table->string("takeaway_monday_from_2",20)->default("17:30");
            $table->string("takeaway_monday_till_2",20)->default("21:30");
            $table->string("takeaway_tuesday_from_1",20)->default("11:30");
            $table->string("takeaway_tuesday_till_1",20)->default("13:30");
            $table->string("takeaway_tuesday_from_2",20)->default("17:30");
            $table->string("takeaway_tuesday_till_2",20)->default("21:30");
            $table->string("takeaway_wednesday_from_1",20)->default("11:30");
            $table->string("takeaway_wednesday_till_1",20)->default("13:30");
            $table->string("takeaway_wednesday_from_2",20)->default("17:30");
            $table->string("takeaway_wednesday_till_2",20)->default("21:30");
            $table->string("takeaway_thursday_from_1",20)->default("11:30");
            $table->string("takeaway_thursday_till_1",20)->default("13:30");
            $table->string("takeaway_thursday_from_2",20)->default("17:30");
            $table->string("takeaway_thursday_till_2",20)->default("21:30");
            $table->string("takeaway_friday_from_1",20)->default("11:30");
            $table->string("takeaway_friday_till_1",20)->default("13:30");
            $table->string("takeaway_friday_from_2",20)->default("17:30");
            $table->string("takeaway_friday_till_2",20)->default("21:30");
            $table->string("takeaway_saturday_from_1",20)->default("11:30");
            $table->string("takeaway_saturday_till_1",20)->default("13:30");
            $table->string("takeaway_saturday_from_2",20)->default("17:30");
            $table->string("takeaway_saturday_till_2",20)->default("21:30");
            $table->string("takeaway_sunday_from_1",20)->default("11:30");
            $table->string("takeaway_sunday_till_1",20)->default("13:30");
            $table->string("takeaway_sunday_from_2",20)->default("17:30");
            $table->string("takeaway_sunday_till_2",20)->default("21:30");


            $table->string("delivery_monday_from_1",20)->default("11:30");
            $table->string("delivery_monday_till_1",20)->default("13:30");
            $table->string("delivery_monday_from_2",20)->default("17:30");
            $table->string("delivery_monday_till_2",20)->default("21:30");
            $table->string("delivery_tuesday_from_1",20)->default("11:30");
            $table->string("delivery_tuesday_till_1",20)->default("13:30");
            $table->string("delivery_tuesday_from_2",20)->default("17:30");
            $table->string("delivery_tuesday_till_2",20)->default("21:30");
            $table->string("delivery_wednesday_from_1",20)->default("11:30");
            $table->string("delivery_wednesday_till_1",20)->default("13:30");
            $table->string("delivery_wednesday_from_2",20)->default("17:30");
            $table->string("delivery_wednesday_till_2",20)->default("21:30");
            $table->string("delivery_thursday_from_1",20)->default("11:30");
            $table->string("delivery_thursday_till_1",20)->default("13:30");
            $table->string("delivery_thursday_from_2",20)->default("17:30");
            $table->string("delivery_thursday_till_2",20)->default("21:30");
            $table->string("delivery_friday_from_1",20)->default("11:30");
            $table->string("delivery_friday_till_1",20)->default("13:30");
            $table->string("delivery_friday_from_2",20)->default("17:30");
            $table->string("delivery_friday_till_2",20)->default("21:30");
            $table->string("delivery_saturday_from_1",20)->default("11:30");
            $table->string("delivery_saturday_till_1",20)->default("13:30");
            $table->string("delivery_saturday_from_2",20)->default("17:30");
            $table->string("delivery_saturday_till_2",20)->default("21:30");
            $table->string("delivery_sunday_from_1",20)->default("11:30");
            $table->string("delivery_sunday_till_1",20)->default("13:30");
            $table->string("delivery_sunday_from_2",20)->default("17:30");
            $table->string("delivery_sunday_till_2",20)->default("21:30");

            $table->boolean("hasSetDeliveryTimes")->default(false);
            $table->boolean("hasSetTakeawayTimes")->default(false);
            $table->boolean("hasSetMinimumWaitTimeForDelivery")->default(false);
            $table->boolean("hasSetMinimumWaitTimeForTakeaway")->default(false);
            $table->boolean("hasSetMinimumOrderValue")->default(false);
            $table->boolean("hasSetDeliveryCost")->default(false);

            $table->boolean("receiveEmailsForNewOrders")->default(true);
            $table->boolean("hideMerchantFromSpeedmeal")->default(false);
            

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
