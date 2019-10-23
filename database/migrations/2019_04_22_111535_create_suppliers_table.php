<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
           $table->bigIncrements('id');
           $table->string('supplier_name', 100);
           $table->string('email', 100)->nullable();
           $table->string('website', 100)->nullable();
           $table->string('cnic', 100)->nullable();
           $table->string('address', 500)->nullable();
           $table->string('phone')->nullable();
           $table->string('mobile')->nullable();
           $table->integer('user_id')->default(0);
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
        Schema::dropIfExists('suppliers');
    }
}
