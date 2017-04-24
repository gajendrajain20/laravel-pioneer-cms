<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminCreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function(Blueprint $table){
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->string('slug')->unique();
            $table->string('title');
            $table->string('meta_title')->nullable();
            $table->string('description');
            $table->string('meta_description')->nullable();
            $table->string('url');
            $table->string('image')->nullable();
            $table->tinyInteger('show_featured_image')->default('0');
            $table->integer('views');
            $table->tinyInteger('status');
            $table->dateTime('published_on');
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
        Schema::drop('videos');
    }
}
