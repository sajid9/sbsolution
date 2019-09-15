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
            $table->string('color')->nullable();
            $table->integer('pieces')->nullable();
            $table->string('size')->nullable();
            $table->string('quality')->nullable();
            $table->float('meter')->nullable();
            $table->integer('low_stock')->nullable();
            $table->string('tile_type')->nullable();
            $table->enum('type',['tile','item'])->default('item');
            $table->integer('store_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('unit_id')->nullable();
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
