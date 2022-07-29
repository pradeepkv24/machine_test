<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('deliveryboy_id')->nullable();
            $table->unsignedBigInteger('pickup_address_id');
            $table->unsignedBigInteger('delivery_address_id');
            $table->timestamp('pickup')->nullable();
            $table->timestamp('delivered')->nullable();
            $table->string('expected_pickup',20)->nullable();
            $table->string('expected_delivered',20)->nullable();
            $table->string('status',1)->default('0')->comment('0 for open, 1 for accept, 2 for picked, 3 for delivered');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreign('deliveryboy_id')->references('id')->on('users');
            $table->foreign('pickup_address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->foreign('delivery_address_id')->references('id')->on('addresses')->onDelete('cascade');
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
};
