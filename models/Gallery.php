<?php
namespace ZenWare\NovemberGallery\Models;

use Str;
use Model;
use ValidationException;
use Lang;
use URL;
use October\Rain\Router\Helper as RouterHelper;
use Cms\Classes\Page as CmsPage;
use Cms\Classes\Theme;

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
        // ['slug', 'index' => true],
        // 'content',
	];
	
    protected $guarded = [];

	/**
     * The attributes that should be mutated to dates.
     * @var array
     */
    protected $dates = ['published_at'];
	
	/**
     * @var array Relations
     */
    // public $belongsToMany = [
    //     'categories' => [
	// 	'Raviraj\Rjgallery\Models\Category',
	// 	'table' => 'raviraj_rjgallery_galleries_categories',
	// 	'order' => 'name'
	// ]
	// ];
	
	public $attachMany = [
        'images' => ['System\Models\File', 'order' => 'sort_order', 'delete' => true],
	];
	
    public $attachOne = [
        'preview_image' => ['System\Models\File'],
	];
	
    // public function afterDelete()
    // {
    //     $this->records()->detach();
	// }
	
    /**
     *  SCOPES - https://octobercms.com/docs/database/model#query-scopes
     */
    public function scopeIsPublished($query) {
        return $query->where('published', '=', true);
	}
	


	
    // public function afterValidate()
    // {
    //     if ($this->published && !$this->published_at) {
    //         throw new ValidationException([
    //            'published_at' => Lang::get('raviraj.rjgallery::lang.exeption.publish_date_validation')
    //         ]);
    //     }
    // }
    // public function scopeIsPublished($query)
    // {
    //     return $query
    //         ->whereNotNull('published')
    //         ->where('published', true)
    //         ->whereNotNull('published_at')
    //         ->where('published_at', '<', Carbon::now())
    //     ;
    // }
    // /**
    //  * Sets the "url" attribute with a URL to this object
    //  * @param string $pageName
    //  * @param Cms\Classes\Controller $controller
    //  */
    // public function setUrl($pageName, $controller)
    // {
    //     $params = [
    //         'id' => $this->id,
    //         'slug' => $this->slug,
    //     ];
    //     if (array_key_exists('categories', $this->getRelations())) {
    //         $params['category'] = $this->categories->count() ? $this->categories->first()->slug : null;
    //     }
        
    //     return $this->url = $controller->pageUrl($pageName, $params);
    // }
}