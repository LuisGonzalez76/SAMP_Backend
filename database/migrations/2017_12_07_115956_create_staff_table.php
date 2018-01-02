<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;



class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(/**
         * @param Blueprint $table
         */
            'staff', function (Blueprint $table) {
            $table->increments('id');
            $table->string('staffName');
            $table->string('staffEmail')->unique();
            $table->string('staffPhone');
            $table->integer('staffType_code')->unsigned();
            $table->integer('user_id')->unsigned()->unique();
            $table->boolean('isActive');
            $table->timestamps();

            //Foreign Keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('staffType_code')->references('code')->on('staff_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('staff');
    }
}
