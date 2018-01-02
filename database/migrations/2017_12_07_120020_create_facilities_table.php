<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('building');
            $table->string('space')->unique();
            $table->integer('facilityDepartment_code')->unsigned();
            $table->boolean('isActive');
            $table->timestamps();

            $table->unique(['building','space']);

            //Foreign keys
            $table->foreign('facilityDepartment_code')->references('code')->on('facility_departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('facilities');
    }
}
