<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->integer('product_id');
            $table->foreign('product_id')->references('id')->on('products');
           
            $table->float('quotation_amount');
            $table->string('quotation_no');
            $table->float('payment');
         
            $table->string('created');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
