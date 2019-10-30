<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone', 20);
            $table->string('description', 2000);
            $table->string('image')->default('noimage.jpg');
            $table->unsignedBigInteger('estate_id');
            $table->boolean('status')->default(0);
            $table->integer('category_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('estate_id')->references('id')->on('estates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_providers');
    }
}
