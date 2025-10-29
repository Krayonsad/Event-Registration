<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExhibitorPaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('exhibitor_payment_details', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('order_id', 191);
        //     $table->string('tracking_id', 191);
        //     $table->string('bank_ref_no', 191);
        //     $table->string('order_status', 191);
        //     $table->string('failure_message', 191);
        //     $table->string('payment_mode', 191);
        //     $table->string('card_name', 191);
        //     $table->string('status_code', 191);
        //     $table->string('status_message', 191);
        //     $table->string('currency', 191);
        //     $table->string('amount', 191);
        //     $table->string('billing_name', 191);
        //     $table->string('billing_address', 191);
        //     $table->string('billing_city', 191);
        //     $table->string('billing_state', 191);
        //     $table->string('billing_zip', 191);
        //     $table->string('billing_country', 191);
        //     $table->string('billing_tel', 191);
        //     $table->string('billing_email', 191);
        //     $table->string('delivery_name', 191);
        //     $table->string('delivery_address', 191);
        //     $table->string('delivery_city', 191);
        //     $table->string('delivery_state', 191);
        //     $table->string('delivery_zip', 191);
        //     $table->string('delivery_country', 191);
        //     $table->string('delivery_tel', 191);
        //     $table->string('merchant_param1', 191);
        //     $table->string('merchant_param2', 191);
        //     $table->string('merchant_param3', 191);
        //     $table->string('merchant_param4', 191);
        //     $table->string('merchant_param5', 191);
        //     $table->string('vault', 191);
        //     $table->string('offer_type', 191);
        //     $table->string('offer_code', 191);
        //     $table->string('discount_value', 191);
        //     $table->string('mer_amount', 191);
        //     $table->string('eci_value', 191);
        //     $table->string('retry', 191);
        //     $table->string('response_code', 191);
        //     $table->string('billing_notes', 191);
        //     $table->string('trans_date', 191);
        //     $table->string('bin_country', 191);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exhibitor_payment_details');
    }
}
