<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBranchId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('covis_transactions', function (Blueprint $table) {
            $table->integer('branch_id')->after('covis_customer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('covis_transactions', function (Blueprint $table) {
            $table->dropColumn('branch_id')->after('covis_customer_id');
        });
    }
}
