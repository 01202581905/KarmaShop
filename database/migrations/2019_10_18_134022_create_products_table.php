<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_vendor');
            $table->string('name');
            $table->string('slug');
            $table->text('image');
            $table->text('list_image');
            $table->text('content');
            $table->text('description');
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('promotional');
            $table->integer('id_type');
            $table->integer('id_category');
            $table->integer('rate');
            $table->text('size');
            $table->text('color');
            $table->integer('status')->default(1);
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
