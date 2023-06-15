<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovisClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covis_classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 5)->unique();
            $table->string('name', 100);
            $table->text('note')->nullable();
            $table->tinyInteger('is_active');
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
        Schema::dropIfExists('covis_classes');
    }
}
