<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModeField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('covis_customers', function (Blueprint $table) {
            $table->string('mode')->after('code')->default(1);  //0 = tidak langsung // 1 =  langsung
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
            $table->dropColumn('mode')->default(1);
        });
    }
}
