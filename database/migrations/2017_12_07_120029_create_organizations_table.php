<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('organizationName');
            $table->string('organizationInitials');
            $table->integer('organizationType_code')->unsigned();
            $table->string('url')->nullable();
            $table->boolean('isActive');
            $table->timestamps();

            //Foreign keys
            $table->foreign('organizationType_code')->references('code')->on('organization_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('organizations');
    }
}
