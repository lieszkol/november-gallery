<?php

namespace ZenWare\NovemberGallery\Models;

use Model;

class BlogFields extends Model
{
	protected $primaryKey = 'id';

	public $table = 'zenware_novembergallery_blog_fields';

	public $timestamps = true;

	protected $guarded = ['*'];

	public $belongsTo = [
		'post' => [
			'RainLab\Blog\Models\Post',
			'key' => 'rainlab_blog_posts_id',
			'otherKey' => 'id'
		],
	];
}
