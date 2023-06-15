<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('covis_customers', function (Blueprint $table) {
            $table->text('contact_office_no')->after('contact_name')->nullable();
            $table->text('contact_no_second')->after('contact_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('covis_customers', function (Blueprint $table) {
            $table->dropColumn('contact_office_no');
            $table->dropColumn('contact_no_second');
        });
    }
}
