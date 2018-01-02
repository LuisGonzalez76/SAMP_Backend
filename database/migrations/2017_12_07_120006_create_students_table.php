<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('studentName');
            $table->string('studentEmail')->unique();
            $table->string('studentNo');
            $table->string('studentPhone');
            $table->string('studentAddress');
            $table->string('studentCity');
            $table->string('studentCountry');
            $table->string('studentZipCode');
            $table->integer('user_id')->unsigned()->unique();
            $table->boolean('isActive');
            $table->timestamps();

            //Foreign Keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('students');
    }
}
