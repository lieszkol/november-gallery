<?php

namespace ZenWare\NovemberGallery\Classes;

use ZenWare\NovemberGallery\NovemberHelper;

/**
 * Gallery Model
 */
class Gallery
{
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

	public function __construct($galleryItems, $sortBy)
	{
		$this->items = $galleryItems;
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
