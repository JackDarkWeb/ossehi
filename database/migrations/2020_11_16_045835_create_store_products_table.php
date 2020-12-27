<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_products', function (Blueprint $table) {
            $table->id();

            $table->string('title')->unique();
            $table->string('slug');
            $table->text('description');
            $table->float('price');
            $table->string('image');
            $table->json('colors')->nullable();
            $table->json('sizes')->nullable();
            $table->string('brands', 50)->nullable();

            $table->unsignedBigInteger('store_productable_id');
            $table->string('store_productable_type');

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
        Schema::dropIfExists('store_products');
    }
}
