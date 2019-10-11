<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->date('arrival_date');
            $table->string('car_plate_no', 20)->nullable();
            $table->string('purpose', 40);
            $table->string('image', 100)->default('no_image.jpg');
            $table->string('status', 20);
            $table->timestamp('time_in')->useCurrent();
            $table->timestamp('time_out')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('home_id')->nullable();

            // table indexes
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // table meta
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitors');
    }
}
