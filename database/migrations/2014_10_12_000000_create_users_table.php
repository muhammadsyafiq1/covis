<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nip', 25)->unique();
            $table->string('name', 100);
            $table->bigInteger('company_id');
            $table->bigInteger('department_id');
            $table->bigInteger('job_position_id');
            $table->string('username', 100)->unique();
            $table->string('email', 100)->unique();
            $table->string('mobile_no', 25);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('user_role_id');
            $table->text('note')->nullable();
            $table->tinyInteger('is_active');
            $table->tinyInteger('is_logged_in')->nullable();
            $table->rememberToken();
            $table->date('password_updated_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
