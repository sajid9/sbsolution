<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemLedgerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_ledger', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('item_id');
            $table->integer('voucher_id')->nullable();
            $table->integer('receipt_id')->nullable();
            $table->string('description')->nullable();
            $table->integer('purchase')->nullable();
            $table->integer('sale')->nullable();
            $table->integer('left');
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
        Schema::dropIfExists('item_ledger');
    }
}
