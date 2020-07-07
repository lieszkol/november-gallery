<?php

namespace ZenWare\NovemberGallery\Components;

class CustomGallery extends NovemberGalleryComponentBase
{

	public function componentDetails()
	{
		return [
			'name' => 'zenware.novembergallery::lang.plugin.custom_gallery_component_name',
			'description' => 'zenware.novembergallery::lang.plugin.custom_gallery_component_description'
		];
	}

	/**
	 * Configuration options that can be set on the component properties page after 
	 * being dropped into a CMS page, this is in addition to any properties defined 
	 * in NovemberGalleryComponentBase.
	 * 
	 * @return array Component properties page configuration options
	 */
	public function defineProperties()
	{
		return array_merge(parent::defineProperties(), []);
	}

	/**
	 * Load CSS and JS assets
	 */
	public function InjectScripts()
	{ }
}
