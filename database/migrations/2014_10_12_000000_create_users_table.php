<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('image')->default('noimage.jpg');
            $table->string('verifycode')->nullable();
            $table->enum('user_type', array('super_admin','resident','gateman', 'estate_admin'));
            $table->enum('role', array(0,1,2,3));
            $table->enum('2_factor_enabled', array('no', 'yes'));
            $table->string('fcm_column')->unique()->nullable();
            $table->string('device_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
