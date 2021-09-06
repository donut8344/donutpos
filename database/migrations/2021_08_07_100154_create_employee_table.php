<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('enterprise_id');
            $table->unsignedBigInteger('employee_type_id');
            $table->string('fname');
            $table->string('lname');
            $table->text('address');
            $table->string('phone');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('employee_type_id')->references('id')->on('employee_type')->onDelete('cascade');
            $table->foreign('enterprise_id')->references('id')->on('enterprise')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.enterprise
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee');
    }
}
