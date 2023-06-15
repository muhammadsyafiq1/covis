<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovisRevTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covis_rev_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('covis_customer_id');
            $table->bigInteger('user_id');
            $table->bigInteger('covis_condition_id');
            $table->bigInteger('covis_used_for_id');
            $table->bigInteger('covis_access_type_id');
            $table->tinyInteger('is_confirm');
            $table->text('note');
            $table->string('uuid');
            $table->string('created_by', 100);
            $table->string('updated_by', 100)->nullable();
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
        Schema::dropIfExists('covis_rev_transactions');
    }
}
