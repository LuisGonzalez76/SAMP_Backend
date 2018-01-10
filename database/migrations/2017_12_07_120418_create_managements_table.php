<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('facility_id')->unsigned();
            $table->integer('manager_id')->unsigned();
            $table->timestamps();

            $table->unique(['manager_id','facility_id']);
            //Foreign keys
            $table->foreign('facility_id')->references('id')->on('facilities');
            $table->foreign('manager_id')->references('id')->on('facilities_managers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('managements');
    }
}
