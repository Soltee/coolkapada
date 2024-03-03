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
            $table->uuid('id')->primary();
            $table->uuid('category_id');
            $table->uuid('subcategory_id')->nullable();
            $table->uuid('media_id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('sold')->nullable();
            $table->integer('stock')->nullable();
            $table->integer('min')->nullable();
            $table->integer('max')->nullable();
            $table->text('description')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('published')->default(false);
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
