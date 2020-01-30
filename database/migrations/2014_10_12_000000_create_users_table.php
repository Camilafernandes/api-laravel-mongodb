<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('cpf');
            $table->string('gender', 1);
            $table->date('date_of_birth');
            $table->integer('rg');
            $table->string('agency', 10);
            $table->string('marital_status');
            $table->string('nationality');
            $table->string('place_of_birth');
            $table->string('occupation');
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
        Schema::drop('users');
    }
}
