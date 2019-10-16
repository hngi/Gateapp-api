<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // We no longer need gateman_notifications table
        Schema::dropIfExists('gateman_notifications');

        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('resident_id');
            $table->unsignedBigInteger('gateman_id');
            $table->unsignedBigInteger('visitor_id')->nullable();
            $table->unsignedBigInteger('home_id');
            $table->enum('type', ['visitor_arrival', 'gateman_invite']);
            $table->string('title');
            $table->text('body');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->foreign('resident_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('gateman_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('home_id')->references('id')->on('homes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
