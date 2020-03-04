<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('epin');
            $table->enum('status', ['used', 'not_used']);
            $table->string('alloted_to');
            $table->string('used_by');
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
        Schema::dropIfExists('epin');
    }
}
