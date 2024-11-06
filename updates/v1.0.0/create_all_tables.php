<?php namespace Hounddd\lightGallery\Updates;

use Db;
use Schema;
use Winter\Storm\Database\Updates\Migration;

class CreateAllTables extends Migration
{
    const TABLES = [
        'categories',
        'galleries',
        'galleries_categories'
    ];


    public function up()
    {
        $updateFromRavirajRjgallery = false;

        // Rename raviraj_rjgallery tables
        foreach (self::TABLES as $table) {
            $from = 'raviraj_rjgallery_' . $table;
            $to = 'hounddd_lightgallery_' . $table;

            if (Schema::hasTable($from) && !Schema::hasTable($to)) {
                Schema::rename($from, $to);
                $updateFromRavirajRjgallery = true;
            }
        }

        if ($updateFromRavirajRjgallery === false) {
            Schema::create('hounddd_lightgallery_galleries', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('slug')->nullable()->index();
                $table->text('description')->nullable();
                $table->boolean('published')->default(false);
                $table->timestamp('published_at')->nullable();
                $table->timestamps();
            });

            Schema::create('hounddd_lightgallery_categories', function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('slug')->nullable()->index();
                $table->text('description')->nullable();
                $table->timestamps();
            });

            Schema::create('hounddd_lightgallery_galleries_categories', function ($table) {
                $table->engine = 'InnoDB';
                $table->integer('gallery_id')->unsigned();
                $table->integer('category_id')->unsigned();
                $table->primary(['gallery_id', 'category_id'], 'hounddd_lightgallery_gallery_id_category_id');
            });
        } else {

            if (!Schema::hasColumn('hounddd_lightgallery_categories', 'slug')) {

                Schema::table('hounddd_lightgallery_galleries', function($table)
                {
                    $table->string('slug')->nullable()->index()->after('name');
                    $table->text('description')->nullable()->after('slug');
                });
            }


            Db::table('system_files')->where('attachment_type', 'Raviraj\Rjgallery\Models\Gallery')
                ->update(['attachment_type' => 'Hounddd\lightGallery\Models\Gallery']);
        }

    }

    public function down()
    {
        Schema::dropIfExists('hounddd_lightgallery_galleries');
        Schema::dropIfExists('hounddd_lightgallery_categories');
        Schema::dropIfExists('hounddd_lightgallery_galleries_categories');
    }

}
