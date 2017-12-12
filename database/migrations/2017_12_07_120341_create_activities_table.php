<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned()->nullable();
            $table->integer('organization_id')->unsigned();
            $table->integer('facility_id')->unsigned();
            $table->integer('staff_id')->unsigned()->nullable();
            $table->string('activityName');
            $table->string('activityDescription');
            $table->integer('attendantsNumber');
            $table->dateTime('activityDate');
            $table->integer('activityStatus_code')->unsigned();
            $table->integer('hasFood');
            $table->integer('hasGuest');
            $table->string('guestName')->nullable();
            $table->integer('counselorStatus_code')->unsigned();
            $table->integer('managerStatus_code')->unsigned();
            $table->integer('activityType_code')->unsigned();
            $table->timestamps();

            //Foreign keys
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('facility_id')->references('id')->on('facilities');
            $table->foreign('staff_id')->references('id')->on('staff');

            $table->foreign('activityStatus_code')->references('code')->on('activity_statuses');
            $table->foreign('counselorStatus_code')->references('code')->on('counselor_statuses');
            $table->foreign('managerStatus_code')->references('code')->on('manager_statuses');
            $table->foreign('activityType_code')->references('code')->on('activity_types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activities');
    }
}
