<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_projects', function (Blueprint $table) {
           $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->timestamps();
        });
        Schema::table('card_projects', function ($table) {
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('client_projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_projects');
    }
}
