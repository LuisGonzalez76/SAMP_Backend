<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCounselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counsels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('counselor_id')->unsigned();
            $table->integer('organization_id')->unsigned();
            $table->timestamps();

            //Foreign keys
            $table->foreign('counselor_id')->references('id')->on('counselors');
            $table->foreign('organization_id')->references('id')->on('organizations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('counsels');
    }
}
