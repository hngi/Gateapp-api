<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentGatemanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resident_gateman', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('request_status')->nullable();  // null (pending) 0 (rejected) 1 (accepted)
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('gateman_id');

            // table indexes
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('gateman_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('resident_gateman');
    }
}
