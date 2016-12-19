<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('urlfriendly');
            
            $table->string('en_title');
            $table->string('en_urlfriendly');
            $table->string('content');
            $table->string('en_content');
            $table->timestamps();
        });

        // forma de agregar campos!. php artisan migrate.

        Schema::table('posts', function ($table) {
            $table->string('en_urlfriendly');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
