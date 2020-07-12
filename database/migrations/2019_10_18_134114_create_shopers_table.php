<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoper', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_shop');
            $table->string('slug_shop');
            $table->string('fanpage_Facebook');
            $table->string('address');
            $table->string('avatar');
            $table->string('background');
            $table->string('mail');
            $table->string('phone');
            $table->integer('order_number');
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
        Schema::dropIfExists('shopers');
    }
}
