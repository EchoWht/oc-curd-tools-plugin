<?php namespace Blskye\CurdTools\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateBlskyeCurdtoolsData extends Migration
{
    public function up()
    {
        Schema::table('blskye_curdtools_data', function($table)
        {
            $table->increments('id')->change();
        });
    }
    
    public function down()
    {
        Schema::table('blskye_curdtools_data', function($table)
        {
            $table->integer('id')->change();
        });
    }
}
