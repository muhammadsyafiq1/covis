<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovisCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covis_customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 20)->unique();
            $table->bigInteger('company_id');
            $table->bigInteger('project_id');
            $table->bigInteger('branch_id');
            $table->bigInteger('region_id');
            $table->string('name');
            $table->bigInteger('covis_type_id');
            $table->longText('address');
            $table->integer('province_code')->nullable();
            $table->integer('city_code')->nullable();
            $table->integer('district_code')->nullable();
            $table->string('contact_name', 100)->nullable();
            $table->string('contact_no', 25)->nullable();
            $table->string('ao_name', 100)->nullable();
            $table->string('ao_no', 25)->nullable();
            $table->date('termination_date')->nullable();
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
        Schema::dropIfExists('covis_customers');
    }
}
