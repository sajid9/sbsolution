<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierLedgerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_ledger', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('voucher_id');
            $table->integer('supplier_id');
            $table->integer('debit')->default(0);
            $table->integer('credit')->default(0);
            $table->integer('balance')->default(0);
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
        Schema::dropIfExists('supplier_ledger');
    }
}
