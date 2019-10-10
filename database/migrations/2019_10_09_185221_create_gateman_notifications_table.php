<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatemanNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateman_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('visitor_id')->unsigned();
            $table->integer('gateman_id')->unsigned();
            $table->integer('resident_id')->unsigned();
            $table->integer('home_id')->unsigned();
            $table->string('date_sent');
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
        Schema::dropIfExists('gateman_notifications');
    }
}
