<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('shipping_id');
            $table->string('transaction_id');
            $table->string('payment_method');
            $table->string('payment_type');
            $table->string('card_number');
            $table->string('currency');
            $table->float('amount');
            $table->string('payment_status');
            $table->string('receipt_email');
            $table->string('receipt_url');
            $table->string('postal_code');
            $table->integer('status');
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
        Schema::dropIfExists('payments');
    }
}
