<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {

            $table->increments('UID');
            $table->integer('DepartmentID');
            $table->foreign('DepartmentID')->references('id')->on('departments');
            $table->integer('KST')->nullable();
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('Title');
            $table->string('Extension')->nullable();
            $table->string('Phone')->nullable();
            $table->string('Mobile')->nullable();
            $table->string('Fax')->nullable();
            $table->string('Location')->nullable();
            $table->string('Photo')->nullable();
            $table->string('Email')->nullable();
            $table->string('Plecat')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
