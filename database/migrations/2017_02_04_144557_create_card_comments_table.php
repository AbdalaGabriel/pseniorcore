<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('comment');
            $table->string('status');
            $table->timestamps();
        });
        Schema::table('card_comments', function ($table) {
            $table->integer('card_project_id')->unsigned();
            $table->foreign('card_project_id')->references('id')->on('card_projects')->onDelete('cascade');
        });

        Schema::table('card_comments', function ($table) {
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('card_comments');
    }
}
