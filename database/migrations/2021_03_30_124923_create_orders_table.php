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
            $table->uuid('id')->primary();
            $table->uuid('customer_id')->nullable();

            // $table->foreignId('customer_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('city');
            $table->string('street_address');
            $table->string('house_number');
            $table->enum('payment_method', ['khalti', 'stripe', 'cash-on-delivery']);
            $table->string('payment_id')->nullable();
            $table->integer('sub_total');
            $table->integer('discount')->nullable();
            $table->integer('sub_after_discount')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('shipping')->default(25);
            $table->integer('grand_total');
            $table->boolean('is_paid')->default(false);
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
        Schema::dropIfExists('orders');
    }
}
