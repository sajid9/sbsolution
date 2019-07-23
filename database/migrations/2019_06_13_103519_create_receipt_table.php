<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('receipt_no');
            $table->integer('customer_id');
            $table->integer('total_amount')->default(0);
            $table->integer('total_discount')->default(0);
            $table->integer('paid_amount')->default(0);
            $table->integer('return_amount')->default(0);
            $table->integer('balance_amount')->default(0);
            $table->enum('type',['quotation','sale'])->default('sale');
            $table->date('receipt_date');
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
        Schema::dropIfExists('receipt');
    }
}
