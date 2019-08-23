<?php

namespace ZenWare\NovemberGallery\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateBlogFieldsTable extends Migration
{
	public function up()
	{
		Schema::create('zenware_novembergallery_blog_fields', function ($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('rainlab_blog_posts_id')->unsigned()->index()->nullable();
			$table->string('media_folder')->nullable();
			$table->timestamps();
		});
	}
	public function down()
	{
		Schema::dropIfExists('zenware_novembergallery_blog_fields');
	}
}
