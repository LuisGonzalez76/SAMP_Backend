<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilitiesManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facilities_managers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('managerName');
            $table->string('managerEmail')->unique();
            $table->string('managerPhone');
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
        Schema::drop('facilities_managers');
    }
}
