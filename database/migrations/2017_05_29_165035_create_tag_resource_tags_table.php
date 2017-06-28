<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagResourceTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_resource_tags', function (Blueprint $table) {
             $table->integer('tuts_and_resource_id')->unsigned()->index();
            $table->integer('tuts_and_resources_tag_id')->unsigned()->index();

            $table->foreign('tuts_and_resource_id')->references('id')->on('tuts_and_resources')->onDelete('cascade');
            $table->foreign('tuts_and_resources_tag_id')->references('id')->on('tuts_and_resources_tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_resource_tags');
    }
}
