<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->integer('usertype_id');
            $table->foreign('usertype_id')->references('id')->on('user_types');
            $table->integer('employe_id');
            $table->string('image');
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->string('gender');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('user_type');
            $table->string('created');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}