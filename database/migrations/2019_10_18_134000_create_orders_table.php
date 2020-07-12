<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code_order');
            $table->integer('id_user');
            $table->string('address');
            $table->string('name_recipient');
            $table->string('email');
            $table->string('phone');
            $table->string('letter');
            $table->integer('total_money');
            $table->integer('total_quantity');
            $table->integer('status')->default(0);
            $table->integer('payment_method');
            $table->integer('fee');
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
