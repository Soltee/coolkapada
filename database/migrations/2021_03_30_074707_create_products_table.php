<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->string('image_url');
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('prev_price')->nullable();
            $table->integer('price');
            $table->integer('qty');
            $table->integer('sold')->nullable();
            $table->string('sizes')->nullable();
            $table->string('colors')->nullable();
            $table->string('excerpt')->nullable();
            $table->text('description')->nullable();
            $table->boolean('featured')->default(false);
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
        Schema::dropIfExists('products');
    }
}
