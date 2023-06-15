<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovisTransactionImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covis_transaction_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('covis_transaction_id');
            $table->string('photo_front1', 100)->nullable();
            $table->string('photo_front2', 100)->nullable();
            $table->string('photo_left', 100)->nullable();
            $table->string('photo_right', 100)->nullable();
            $table->string('created_by', 100)->nullable();
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
        Schema::dropIfExists('covis_transaction_images');
    }
}
