<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('voucher_id');
            $table->integer('item_id');
            $table->integer('qty');
            $table->integer('sale_price');
            $table->integer('discounted_price')->nullable();
            $table->integer('total_price');
            $table->enum('type', ['purchase', 'return'])->default('purchase');
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
        Schema::dropIfExists('voucher_detail');
    }
}
