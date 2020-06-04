<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slider_name')->nullable();
            $table->string('slider_image')->nullable();
            $table->char('status', 1)->comment('1=enabled, 2=disabled')->nullable();
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
        Schema::dropIfExists('shopping_sliders');
    }
}
