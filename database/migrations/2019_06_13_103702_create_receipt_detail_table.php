<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('receipt_id');
            $table->integer('item_id');
            $table->float('qty');
            $table->integer('sale_price')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('total_price')->nullable();
            $table->string('type');
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
        Schema::dropIfExists('receipt_detail');
    }
}
