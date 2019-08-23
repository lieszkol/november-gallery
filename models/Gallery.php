<?php

namespace ZenWare\NovemberGallery\Models;

use Model;
use System\Classes\PluginManager;

class Gallery extends Model
{
	use \October\Rain\Database\Traits\Validation;

	public $table = 'zenware_novembergallery_gallery';
	public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

	public $timestamps = true;

	/*
     * Validation
     */
	public $rules = [
		'name' => 'required|between:3,64',
		'slug' => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:zenware_novembergallery_gallery'],
	];


	public $translatable = [
		'name',
		'description'
	];

	protected $guarded = [];

	/**
	 * The attributes that should be mutated to dates.
	 * @var array
	 */
	protected $dates = ['published_at'];

	public $attachMany = [
		'images' => ['System\Models\File', 'order' => 'sort_order', 'delete' => true],
	];

	public $attachOne = [
		'preview_image' => ['System\Models\File'],
	];

	public $belongsToMany = [];

	/**
	 * Initialize properties
	 */
	public function __construct()
	{
		$pluginManager = PluginManager::instance()->findByIdentifier('Rainlab.Blog');
		if ($pluginManager && !$pluginManager->disabled) {
			$this->belongsToMany = [
				'posts' => [
					'RainLab\Blog\Models\Post',
					'table' => 'zenware_novembergallery_galleries_of_post',
					'key'      => 'zenware_novembergallery_gallery_id',
					'otherKey' => 'rainlab_blog_posts_id'
				]
			];
		}
		parent::__construct();
	}

	// public function afterDelete()
	// {
	//     $this->records()->detach();
	// }

	/**
	 *  SCOPES - https://octobercms.com/docs/database/model#query-scopes
	 */
	public function scopeIsPublished($query)
	{
		return $query
			->whereNotNull('published')
			->where('published', true);
			//         ->whereNotNull('published_at')
			//         ->where('published_at', '<', Carbon::now())
	}

	// public function afterValidate()
	// {
	//     if ($this->published && !$this->published_at) {
	//         throw new ValidationException([
	//            'published_at' => Lang::get('...')
	//         ]);
	//     }
	// }

	/**
	 * Sets the "url" attribute with a URL to this object
	 * @param string $pageName
	 * @param Cms\Classes\Controller $controller
	 */
	public function setUrl($pageName, $controller)
	{
		$params = [
			'id' => $this->id,
			'slug' => $this->slug,
		];

		return $this->url = $controller->pageUrl($pageName, $params);
	}
}
