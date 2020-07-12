<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_rate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_product');
            $table->integer('rate');
            $table->integer('id_user');
            $table->string('name_user');
            $table->string('avatar');
            $table->string('content');
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
        Schema::dropIfExists('comment_rates');
    }
}
