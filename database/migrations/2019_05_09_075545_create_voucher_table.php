<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('voucher_no',200);
            $table->integer('supplier_id');
            $table->integer('total_amount')->default(0);
            $table->integer('return_amount')->default(0);
            $table->integer('paid_amount')->default(0);
            $table->integer('balance_amount')->default(0);
            $table->integer('user_id')->default(0);
            $table->date('voucher_date');
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
        Schema::dropIfExists('voucher');
    }
}
