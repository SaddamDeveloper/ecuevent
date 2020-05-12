<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('name')->nullable();
            $table->string('main_image')->nullable();
            $table->double('mrp')->default('0')->nullable();
            $table->double('price')->default('0')->nullable();
            $table->mediumText('short_desc')->nullable();
            $table->mediumText('long_desc')->nullable();
            $table->char('status')->default('1')->comment('1=enabled, 2=disabled')->nullable();
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
        Schema::dropIfExists('shopping_product');
    }
}
