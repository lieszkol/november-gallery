<?php

namespace ZenWare\NovemberGallery\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateGalleriesOfPostTable extends Migration
{
	public function up()
	{
		Schema::create('zenware_novembergallery_galleries_of_post', function ($table) {
			$table->engine = 'InnoDB';
			$table->integer('zenware_novembergallery_gallery_id')->unsigned();
			$table->integer('rainlab_blog_posts_id')->unsigned();
			$table->primary(['zenware_novembergallery_gallery_id', 'rainlab_blog_posts_id'], 'pk_zenware_novembergallery_galleries_of_post');
			$table->timestamps();
		});
	}
	public function down()
	{
		Schema::dropIfExists('zenware_novembergallery_galleries_of_post');
	}
}
