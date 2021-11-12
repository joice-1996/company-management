<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('client_id');
            $table->integer('product_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->float('quotation_amount');
            $table->string('quotation_no');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('status');
            $table->string('pdf')->nullable();
            $table->string('created');
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
        Schema::dropIfExists('quotations');
    }
}
