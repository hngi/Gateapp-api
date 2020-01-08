<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentModeToResidentBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resident_bills', function (Blueprint $table) {
            $table->string('payment_mode')->nullable()->after('amount');
          //
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
            $table->dropColumn(['payment_mode']);
        });
    }
}
