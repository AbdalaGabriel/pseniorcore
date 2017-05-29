<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutsAndResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tuts_and_resources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('urlfriendly');
            $table->string('en_title');
            $table->string('en_urlfriendly');        
            $table->string('resource')->nullable();
            $table->string('content');
            $table->string('en_content');
            $table->string('cover_image');
            $table->string('meta_description');
            $table->string('en_meta_description');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tuts_and_resources');
    }
}
