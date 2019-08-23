<?php

namespace ZenWare\NovemberGallery\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateGalleryTable extends Migration
{
	public function up()
	{
		Schema::create('zenware_novembergallery_gallery', function ($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('name')->nullable()->index();
			$table->string('slug')->nullable()->index();
			$table->text('description')->nullable();
			$table->integer('sort_order')->unsigned()->index()->nullable();
			$table->timestamp('published_at')->nullable();
			$table->boolean('published')->default(false);
			$table->timestamps();
		});

		Schema::table('zenware_novembergallery_gallery', function ($table) {
			$table->unique(['slug'], 'slug_unique');
		});
	}
	public function down()
	{
		Schema::dropIfExists('zenware_novembergallery_gallery');
	}
}
