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
            $table->string('fullName');
            $table->string('studentEmail')->unique();
            $table->string('studentNo');
            $table->string('studentPhone');
            $table->string('studentAddress');
            $table->string('studentCity');
            $table->string('studentCountry');
            $table->string('studentZipCode');

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
        Schema::drop('students');
    }
}
