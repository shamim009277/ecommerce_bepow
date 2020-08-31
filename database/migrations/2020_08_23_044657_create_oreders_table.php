<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOredersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oreders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipping_id');
            $table->foreignId('payment_id');
            $table->foreignId('user_id');
            $table->integer('quantity');
            $table->float('total');
            $table->float('subtotal');
            $table->float('shipping_cost');
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
        Schema::dropIfExists('oreders');
    }
}
