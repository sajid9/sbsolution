<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item_name',200);
            $table->string('item_desc',500)->nullable();
            $table->string('barcode',100);
            $table->integer('purchase_price');
            $table->integer('sale_price');
            $table->integer('company_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('sub_class_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->enum('is_active', ['yes', 'no'])->default('no');
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
        Schema::dropIfExists('items');
    }
}
