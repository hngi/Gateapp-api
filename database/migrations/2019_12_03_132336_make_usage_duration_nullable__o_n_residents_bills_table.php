<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeUsageDurationNullableONResidentsBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resident_bills', function (Blueprint $table) {
            $table->bigInteger('usage_duration')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resident_bills', function (Blueprint $table) {
            $table->bigInteger('usage_duration')->change();
        });
    }
}
