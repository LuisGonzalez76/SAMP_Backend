<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCounselorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counselors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullName');
            $table->string('counselorEmail')->unique();
            $table->string('counselorPhone');
            $table->string('counselorFaculty');
            $table->string('counselorDepartment');
            $table->string('counselorOffice');
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
        Schema::drop('counselors');
    }
}
