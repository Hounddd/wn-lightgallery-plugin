<?php namespace Hounddd\lightGallery\Updates;

use Db;
use Schema;
use Winter\Storm\Database\Updates\Migration;

class CreateImagesTables extends Migration
{
    public function up()
    {
        Schema::create('hounddd_lightgallery_images', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('gallery_id')->unsigned();
            $table->integer('sort_order')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->longtext('description')->nullable();
            $table->text('link')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hounddd_lightgallery_images');
    }

}
