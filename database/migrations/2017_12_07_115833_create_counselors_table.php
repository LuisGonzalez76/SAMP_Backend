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
            $table->string('counselorName');
            $table->string('counselorEmail')->unique();
            $table->string('counselorPhone');
            $table->string('counselorFaculty');
            $table->string('counselorDepartment');
            $table->string('counselorOffice');
            $table->integer('user_id')->unsigned()->unique();
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
        Schema::drop('counselors');
    }
}
