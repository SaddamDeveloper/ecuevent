<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingProductSpecification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_product_specification', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('p_id')->nullable();
            $table->string('name')->nullable();
            $table->string('value')->nullable();
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
        Schema::dropIfExists('shopping_product_specification');
    }
}
