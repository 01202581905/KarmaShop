<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Suggestopenvendor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('openshop', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_user');
            $table->string('name_shop');
            $table->string('email_shop');
            $table->string('avatar_shop');
            $table->string('address_shop');
            $table->string('phone_shop');
            $table->string('letter');
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
        //
    }
}
