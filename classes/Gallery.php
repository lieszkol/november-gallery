<?php

namespace ZenWare\NovemberGallery\Classes;

use ZenWare\NovemberGallery\NovemberHelper;

/**
 * Gallery Model
 */
class Gallery
{
	public const GALLERYTYPE_BACKENDGALLERY = 'NOVEMBER_GALLERY';
	public const GALLERYTYPE_OCTOBERMEDIAMANAGER = 'OCTOBER_MEDIA_MANAGER_FOLDER';
	public const GALLERYTYPE_BLOGPOST = 'BLOG_POST';

	/**
	 * @var string Gallery type (indicates how the images were upladed & where they are stored)
	 */
	public $type;

	/**
	 * @var string Folder where the images can be found (available for galleries created using the OctoberCMS "Media Manager")
	 */
	public $folder;
	
	/**
	 * @var string Gallery name (available for galleries created on the "Galleries" back-end page)
	 */
	public $dbg;

	/**
	 * @var string Gallery name (available for galleries created on the "Galleries" back-end page)
	 */
	public $name;

	/**
	 * @var string Gallery slug (available for galleries created on the "Galleries" back-end page)
	 */
	public $slug;

	/**
	 * @var string Gallery description (available for galleries created on the "Galleries" back-end page)
	 */
	public $description;

	/**
	 * @var string Gallery keywords (available for galleries created on the "Galleries" back-end page)
	 */
	public $keywords;

	/**
	 * @var string Gallery published on date (available for galleries created on the "Galleries" back-end page)
	 */
	public $publishedAt;

	/**
	 * @var string Gallery created on date (available for galleries created on the "Galleries" back-end page)
	 */
	public $createdAt;

	/**
	 * @var string Gallery updated on date (available for galleries created on the "Galleries" back-end page)
	 */
	public $updatedAt;

	/**
	 * @var string Gallery preview image (available for galleries created on the "Galleries" back-end page)
	 */
	public $previewImage;

	/**
	 * @var string Gallery active (or not) (available for galleries created on the "Galleries" back-end page)
	 */
	public $published;

	/**
	 * @var array All gallery items
	 */
	public $items;

	/**
	 * @var string Gallery items sort order
	 */
	public $sortBy;

	/**
	 * @var string Can be "ASC" or "DESC" (like in SQL)
	 */
	public $sortDirection = "ASC";

	public function __construct($sortBy)
	{
		if (NovemberHelper::endsWith($sortBy, "DESC")) {
			$this->sortBy = NovemberHelper::trimEnd($sortBy, "DESC");
			$this->sortDirection = "DESC";
		} else {
			$this->sortBy = $sortBy;
		}
	}

	/**
	 * Converts the item data to an array, enables end-users to do
	 * {{ dump(embeddedGallery.gallery.toArray) }} or
	 * {{ debug(embeddedGallery.gallery.toArray) }} (with debugbar installed)
	 * @return array Returns the item data as array
	 */
	public function toArray()
	{
		$result = [];
		$properties = (new \ReflectionObject($this))->getProperties(\ReflectionProperty::IS_PUBLIC);
		foreach ($properties as $property) {
			$propertyName = $property->name;
			$result[$propertyName] = $this->$propertyName;
		}
		return $result;
	}
}
