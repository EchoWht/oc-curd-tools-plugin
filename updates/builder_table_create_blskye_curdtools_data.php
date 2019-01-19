<?php namespace Blskye\CurdTools\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateBlskyeCurdtoolsData extends Migration
{
    public function up()
    {
        Schema::create('blskye_curdtools_data', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id')->unsigned();
            $table->string('title');
            $table->string('endpoint');
            $table->string('model', 50);
            $table->string('description')->nullable();
            $table->text('custom_format')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->primary(['id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('blskye_curdtools_data');
    }
}
