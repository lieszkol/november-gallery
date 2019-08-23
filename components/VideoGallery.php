<?php

namespace ZenWare\NovemberGallery\Components;

use ZenWare\NovemberGallery\Models\Settings;
use October\Rain\Support\Collection;
use ZenWare\NovemberGallery\NovemberHelper;

class VideoGallery extends NovemberGalleryComponentBase
{

	public $videoGalleryItemsSelector;

	public $defaultVideoGalleryOptions;

	public $customVideoGalleryScript;

	/**
	 * Name and description to display for this component in the backend "CMS" section in the 
	 * Components list.
	 * 
	 * @return array ['name' => '...', 'description' => '...']
	 */
	public function componentDetails()
	{
		return [
			'name' => 'zenware.novembergallery::lang.plugin.video_gallery_component_name',
			'description' => 'zenware.novembergallery::lang.plugin.video_gallery_component_description'
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
		return array_merge(parent::defineProperties(), [
			'videoFolder' => [
				'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.folder_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.folder_label_hint'),
				'default'           => '',
				'type'              => 'dropdown',
				'placeholder'       => \Lang::get('zenware.novembergallery::lang.component_properties.folder_label_placeholder'),
				'validationPattern' => '^[a-zA-Z0-9$\-_.+!*\'(),/]+$',   // https://perishablepress.com/stop-using-unsafe-characters-in-urls/
				'validationMessage' => \Lang::get('zenware.novembergallery::lang.component_properties.folder_label_validation_message'),
			],
			'videoGalleryItemsSelector' => [
				'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.video_gallery_items_selector'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.video_gallery_items_selector_hint'),
				'default'           => '#videos'
			],
			'videoGalleryLayout' => [
				'title'       => \Lang::get('zenware.novembergallery::lang.component_properties.gallery_layout_label'),
				'description' => \Lang::get('zenware.novembergallery::lang.component_properties.gallery_layout_hint'),
				'type'        => 'dropdown',
				'placeholder' => \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
				'options'     => [
					'default' => \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
					'video_gallery_right_thumb' => \Lang::get('zenware.novembergallery::lang.settings.video_gallery_right_thumb'),
					'video_gallery_right_title_only' => \Lang::get('zenware.novembergallery::lang.settings.video_gallery_right_title_only'),
					'video_gallery_right_no_thumb' => \Lang::get('zenware.novembergallery::lang.settings.video_gallery_right_no_thumb'),
				]
			],
			'additionalVideoGalleryOptions' => [
				'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.additional_gallery_options'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.additional_gallery_options_hint'),
				'default'           => ''
			],
			'imageResizerWidth' => [
				'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.image_resizer_width_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.image_resizer_width_comment'),
				'default'           => '',
				'type'              => 'string',
				'validationPattern' => '^[0-9]+$',
				'validationMessage' => 'The Thumbnail Width property can only contain numbers!',
				'group' 			=> \Lang::get('zenware.novembergallery::lang.component_properties.group_thumbnails_label')
			],
			'imageResizerHeight' => [
				'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.image_resizer_height_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.image_resizer_height_comment'),
				'default'           => '',
				'type'              => 'string',
				'validationPattern' => '^[0-9]+$',
				'validationMessage' => 'The Thumbnail Width property can only contain numbers!',
				'group' 			=> \Lang::get('zenware.novembergallery::lang.component_properties.group_thumbnails_label')
			],
			'imageResizerMode' => [
				'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.image_resizer_mode_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.image_resizer_mode_hint'),
				'type'        		=> 'dropdown',
				'placeholder' 		=> \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
				'options'     		=> [
					'default' => \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
					'auto' => \Lang::get('zenware.novembergallery::lang.settings.image_resizer_mode_auto'),
					'exact' => \Lang::get('zenware.novembergallery::lang.settings.image_resizer_mode_exact'),
					'portrait' => \Lang::get('zenware.novembergallery::lang.settings.image_resizer_mode_portrait'),
					'landscape' => \Lang::get('zenware.novembergallery::lang.settings.image_resizer_mode_landscape'),
					'crop' => \Lang::get('zenware.novembergallery::lang.settings.image_resizer_mode_crop'),
				],
				'group' 			=> \Lang::get('zenware.novembergallery::lang.component_properties.group_thumbnails_label')
			],
			'galleryWidth' => [
				'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.gallery_width_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.gallery_width_comment'),
				'default'           => '',
				'type'              => 'string',
				'validationPattern' => '^[0-9\%]+$',
				'validationMessage' => 'The Gallery Width property can only contain numbers and an optional percent sign!',
				'group' 			=> \Lang::get('zenware.novembergallery::lang.component_properties.group_gallery_dimensions_label')
			],
			'galleryHeight' => [
				'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.gallery_height_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.gallery_height_comment'),
				'default'           => '',
				'type'              => 'string',
				'validationPattern' => '^[0-9\%]+$',
				'validationMessage' => 'The Gallery Height property can only contain numbers and an optional percent sign!',
				'group' 			=> \Lang::get('zenware.novembergallery::lang.component_properties.group_gallery_dimensions_label')
			]
		]);
	}

	/**
	 * Retrieve a list of folders under the "Base Media Folder" as set on the 
	 * plugin backend settings page. The user can select from this list of folders 
	 * in the component properties page after being dropped into a CMS page.
	 * 
	 * See "Dropdown properties" in https://octobercms.com/docs/plugin/components#component-properties
	 * 
	 * @return array List of folders
	 */
	public function getMediaFolderOptions()
	{
		return NovemberHelper::getSubdirectories(Settings::instance()->base_video_folder)->toArray();
	}

	/**
	 * Get the base media folder
	 * 
	 * @return string Base media folder
	 */
	protected function getBaseMediaFolder()
	{
		if (Settings::instance()->base_video_folder == '<inherit>') {
			if (!empty(Settings::instance()->base_folder)) {
				return Settings::instance()->base_folder;
			}
		} else {
			return Settings::instance()->base_video_folder;
		}
		return null;
	}

	/**
	 * Load page variables etc.
	 */
	public function onRun()
	{
		if (!empty($this->property('videoGalleryItemsSelector'))) {
			$this->videoGalleryItemsSelector = $this->property('videoGalleryItemsSelector');
		}

		$this->defaultVideoGalleryOptions = $this->getDefaultVideoGalleryOptions();

		parent::onRun();
	}

	/**
	 * Inject page variables
	 */
	public function onRender()
	{
		// This MUST be done here instead of in onRun(), because there we don't yet have a $this->id:
		if (Settings::instance()->custom_video_gallery_script_enabled && !empty(Settings::instance()->custom_video_gallery_script)) {
			$this->customVideoGalleryScript = $this->page['customVideoGalleryScript'] = str_replace("#gallery", '#' . $this->id, Settings::instance()->custom_video_gallery_script);
		}
		parent::onRender();
	}

	/**
	 * Load CSS and JS assets
	 */
	public function InjectScripts()
	{
		if (Settings::instance()->inject_unitegallery_assets) {
			$this->addCss('assets/unitegallery/dist/css/unite-gallery.css');
			$this->addJs('assets/unitegallery/dist/js/unitegallery.min.js');
			$this->addJs('assets/unitegallery/dist/themes/video/ug-theme-video.js');

			switch ($this->getVideoGalleryLayout()) {
				case 'video_gallery_right_thumb':
					$this->addCss('assets/unitegallery/dist/themes/video/skin-right-thumb.css');
					break;
				case 'video_gallery_right_title_only':
					$this->addCss('assets/unitegallery/dist/themes/video/skin-right-title-only.css');
					break;
				case 'video_gallery_right_no_thumb':
					$this->addCss('assets/unitegallery/dist/themes/video/skin-right-no-thumb.css');
					break;
				default:
					$this->addCss('assets/unitegallery/dist/themes/video/skin-right-thumb.css');
					break;
			}
		}
	}

	/**
	 * Get default options used in the default.htm layout for initialising the video gallery.
	 * 
	 * @return string Comma-separated list of options
	 */
	public function getDefaultVideoGalleryOptions()
	{
		$additionalOptions = new Collection();

		$additionalOptions->put('gallery_theme', '"video"');

		switch ($this->getVideoGalleryLayout()) {
			case 'video_gallery_right_thumb':
				$additionalOptions->put('theme_skin', '"right-thumb"');
				break;
			case 'video_gallery_right_title_only':
				$additionalOptions->put('theme_skin', '"right-title-only"');
				break;
			case 'video_gallery_right_no_thumb':
				$additionalOptions->put('theme_skin', '"right-no-thumb"');
				break;
		}
		if ($this->getGalleryWidth() !== false) $additionalOptions->put('gallery_width', $this->getGalleryWidth());
		if ($this->getGalleryHeight() !== false) $additionalOptions->put('gallery_height', $this->getGalleryHeight());

		$additionalOptions = $additionalOptions->map(function ($item, $key) {
			return $key . ':' . $item;
		})->implode(', ');

		if (!empty($this->property('additionalVideoGalleryOptions'))) {
			if (!empty($additionalOptions)) $additionalOptions = $additionalOptions . ', ';
			$additionalOptions = $additionalOptions . rtrim($this->property('additionalVideoGalleryOptions'), ', \t\n\r');
		}

		return $additionalOptions ?? '';
	}

	/**
	 * Get the video gallery layout
	 * 
	 * @return string Video gallery layout
	 */
	public function getVideoGalleryLayout()
	{
		if (!empty($this->property('videoGalleryLayout')) && $this->property('videoGalleryLayout') !== 'not_applicable' && $this->property('videoGalleryLayout') !== 'default') {
			return $this->property('videoGalleryLayout');
		} elseif (!empty(Settings::instance()->default_video_gallery_layout)) {
			return Settings::instance()->default_video_gallery_layout;
		}
		return '';
	}
}
