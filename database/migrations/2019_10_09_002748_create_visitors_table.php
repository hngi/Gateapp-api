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
            $table->string('visitor_name', 50);
            $table->date('arrival_date');
            $table->string('car_plate_no', 20);
            $table->string('purpose', 40);
            $table->string('image', 100)->default('no_image.jpg');
            $table->string('status', 20);
            $table->timestamp('time_in')->useCurrent();
            $table->timestamp('time_out')->nullable();

            // table indexes
            $table->unique('car_plate_no');

            if (Schema::hasTable('users')) {
                $table->unsignedBigInteger('user_id');
                
                $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('cascade');
            }

            if (Schema::hasTable('homes')) {
                $table->unsignedBigInteger('home_id');

                $table->foreign('home_id')->references('home_id')->on('homes')
                        ->onDelete('cascade');
            }

            // table meta
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
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
        Schema::dropIfExists('visitors');
    }
}
