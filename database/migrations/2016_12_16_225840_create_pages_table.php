<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('writable_content');
            $table->string('can_be_deleted');
            
            $table->string('content');
            $table->string('en_content');
            $table->string('urlfirendly');
            $table->string('en_title');
            $table->string('en_urlfriendly');
            $table->timestamps();
            $table->string('reference');
            $table->string('meta_description');
            $table->string('en_meta_description');
            $table->string('jsoneditdata');
            $table->string('htmleditdata');
            
        });


         Schema::table('pages', function ($table) {
            $table->integer('visible_in_menu');
            $table->integer('order_in_menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
