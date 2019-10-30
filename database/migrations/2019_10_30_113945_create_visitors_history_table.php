<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('visitor_id');
            $table->unsignedBigInteger('user_id');
            $table->date('visit_date');
			

            // table indexes
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('visitor_id')->references('id')->on('visitors')->onDelete('cascade');
           
			
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
        Schema::dropIfExists('visitors_history');
    }
}
