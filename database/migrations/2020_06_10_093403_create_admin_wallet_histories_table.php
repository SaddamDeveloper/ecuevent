<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminWalletHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_wallet_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('transaction_type', 1)->comment('1=cr, 2=dr')->nullable();
            $table->double('amount')->nullable();
            $table->double('total_amount')->nullable();
            $table->mediumText('comment')->nullable();
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
        Schema::dropIfExists('admin_wallet_histories');
    }
}
