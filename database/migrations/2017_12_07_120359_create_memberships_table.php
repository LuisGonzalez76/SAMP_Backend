<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('organization_id')->unsigned();
            $table->integer('organizationRole_code')->unsigned();
            $table->timestamps();

            //Foreign keys
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('organizationRole_code')->references('code')->on('organization_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('memberships');
    }
}
