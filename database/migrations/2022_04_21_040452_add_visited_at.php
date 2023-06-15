<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVisitedAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('covis_transactions', function (Blueprint $table) {
            $table->dateTime('visited_at')->after('scheduled_date')->nullable();
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
            $table->dropColumn('visited_at')->nullable();
        });
    }
}
