<?php namespace Escargotiere\Extender\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class AddFalleriesComplexModeField extends Migration
{
    public function up()
    {
        if (Schema::hasColumn('hounddd_lightgallery_galleries', 'complex_mode')) {
            return;
        }

        Schema::table('hounddd_lightgallery_galleries', function($table)
        {
            $table->boolean('complex_mode')->nullable()->default(false)->after('description');
        });
    }

    public function down()
    {
        if (Schema::hasColumn('hounddd_lightgallery_galleries', 'complex_mode')) {
            Schema::table('hounddd_lightgallery_galleries', function ($table) {
                $table->dropColumn('complex_mode');
            });
        }
    }
}
