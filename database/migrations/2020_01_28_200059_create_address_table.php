<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id')->unsigned()->index();
            $table->integer('postcode');
            $table->string('address');
            $table->string('number');
            $table->string('secondary_address');
            $table->string('country');
            $table->string('city');
            $table->string('state');
            $table->timestamps();
            $table->foreign('users_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('address');
    }
}
