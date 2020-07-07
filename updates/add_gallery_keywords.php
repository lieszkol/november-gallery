<?php

namespace ZenWare\NovemberGallery\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddGalleryKeywords extends Migration
{
	public function up()
	{
		if (!Schema::hasColumn('zenware_novembergallery_gallery', 'keywords')) {
				Schema::table('zenware_novembergallery_gallery', function ($table) {
					$table->string('keywords', 200)->nullable();
				});
		}
	}
	public function down()
	{
		if (Schema::hasColumn('zenware_novembergallery_gallery', 'keywords')) {
			Schema::table('zenware_novembergallery_gallery', function ($table) {
				$table->dropColumn('keywords');
			});
		}
	}
}
