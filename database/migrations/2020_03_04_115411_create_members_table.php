<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('mobile')->nullable();
            $table->string('gender')->nullable();
            $table->string('dob')->nullable();
            $table->bigInteger('sponsor_id')->nullable();
            $table->string('total_pair')->nullable();
            $table->char('status', 1)->nullable();
            $table->string('epin')->nullable();
            $table->string('nominee_relation')->nullable();
            $table->string('nominee_name')->nullable();
            $table->string('nominee_mobile')->nullable();
            $table->text('nominee_address')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->integer('pin')->nullable();
            $table->string('address_proof_doc')->nullable();
            $table->string('address_proof_no')->nullable();
            $table->string('photo_proof')->nullable();
            $table->char('document_status', 1)->nullable();
            $table->char('policy_is_agree', 1)->nullable();
            $table->bigInteger('member_id')->nullable();
            $table->bigInteger('regitered_by')->nullable();
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
        Schema::dropIfExists('members');
    }
}
