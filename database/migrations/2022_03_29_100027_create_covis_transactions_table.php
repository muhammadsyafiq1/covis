<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovisTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covis_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('covis_customer_id');
            $table->date('termination_date');
            $table->tinyInteger('covis_class_id');
            $table->tinyInteger('covis_priority_id');
            $table->tinyInteger('user_id');
            $table->date('scheduled_date')->nullable();
            $table->tinyInteger('covis_condition_id')->nullable();
            $table->tinyInteger('covis_used_for_id')->nullable();
            $table->tinyInteger('covis_access_type_id')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('is_revision')->nullable();
            $table->text('admin_note')->nullable();
            $table->text('note')->nullable();
            $table->string('uuid')->nullable();
            $table->string('distance')->nullable();
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
        Schema::dropIfExists('covis_transactions');
    }
}
