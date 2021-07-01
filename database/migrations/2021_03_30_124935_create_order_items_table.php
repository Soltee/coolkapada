<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('order_id');
            $table->uuid('customer_id')->nullable();
            $table->uuid('product_id');

            // $table->foreignId('order_id');
            // $table->foreignId('customer_id')->nullable();
            // $table->foreignId('product_id');
            $table->string('image_url');
            $table->string('name');
            $table->string('price');
            $table->string('qty');
            $table->string('colorId')->nullable();
            $table->string('color')->nullable();
            $table->string('attributeId')->nullable();
            $table->string('size')->nullable();
            $table->string('total');
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
        Schema::dropIfExists('order_items');
    }
}
