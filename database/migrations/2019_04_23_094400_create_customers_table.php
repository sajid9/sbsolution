<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
           $table->bigIncrements('id');
           $table->string('customer_name', 100);
           $table->string('occupation', 100)->nullable();
           $table->string('email', 100)->nullable();
           $table->string('website', 100)->nullable();
           $table->string('cnic', 100)->nullable();
           $table->string('address', 500)->nullable();
           $table->string('phone')->nullable();
           $table->string('mobile')->nullable();
           $table->string('rating', 100)->nullable();
           $table->string('gst', 100)->nullable();
           $table->string('ntn', 100)->nullable();
           $table->integer('user_id')->default(0);
           $table->string('standing_instruction', 500)->nullable();
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
        Schema::dropIfExists('customers');
    }
}
