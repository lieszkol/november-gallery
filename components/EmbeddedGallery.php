<?php

namespace ZenWare\NovemberGallery\Components;

use ZenWare\NovemberGallery\Models\Settings;
use October\Rain\Support\Collection;
use Backend\Facades\BackendAuth;


// use Debugbar;   // http://wiltonsoftware.nz/blog/post/debug-october-cms-plugin

class EmbeddedGallery extends NovemberGalleryComponentBase
{

	public $defaultGalleryOptions;

	public $customGalleryScript;

	/**
	 * Name and description to display for this component in the backend "CMS" section in the 
	 * Components list.
	 * 
	 * @return array ['name' => '...', 'description' => '...']
	 */
	public function componentDetails()
	{
		return [
			'name' => 'zenware.novembergallery::lang.plugin.embedded_gallery_component_name',
			'description' => 'zenware.novembergallery::lang.plugin.embedded_gallery_component_description'
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
			'galleryLayout' => [
				'title'       => \Lang::get('zenware.novembergallery::lang.component_properties.gallery_layout_label'),
				'description' => \Lang::get('zenware.novembergallery::lang.component_properties.gallery_layout_hint'),
				'type'        => 'dropdown',
				'placeholder' => \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
				'options'     => [
					'default' => \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
					'gallery_tiles' => \Lang::get('zenware.novembergallery::lang.settings.default_gallery_tiles'),
					'gallery_carousel' => \Lang::get('zenware.novembergallery::lang.settings.default_gallery_carousel'),
					'gallery_combined' => \Lang::get('zenware.novembergallery::lang.settings.default_gallery_combined'),
					'gallery_slider' => \Lang::get('zenware.novembergallery::lang.settings.default_gallery_slider'),
				]
			],
			'tilesLayout' => [
				'title'       => \Lang::get('zenware.novembergallery::lang.component_properties.gallery_tiles_layout_label'),
				'description' => \Lang::get('zenware.novembergallery::lang.component_properties.gallery_tiles_layout_hint'),
				'type'        => 'dropdown',
				'placeholder' => \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
				'depends'     => ['galleryLayout']
			],
			'combinedLayout' => [
				'title'       => \Lang::get('zenware.novembergallery::lang.component_properties.gallery_combined_layout_label'),
				'description' => \Lang::get('zenware.novembergallery::lang.component_properties.gallery_combined_layout_hint'),
				'type'        => 'dropdown',
				'placeholder' => \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
				'depends'     => ['galleryLayout']
			],
			'additionalGalleryOptions' => [
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
	 * Dynamic options for tilesLayout, options are only available if Gallery Layout is "Tiles"
	 */
	public function getTilesLayoutOptions()
	{
		if (\Request::input('galleryLayout') === 'gallery_tiles') {
			return [
				'default' => \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
				'gallery_tiles_columns' => \Lang::get('zenware.novembergallery::lang.settings.gallery_tiles_layout_columns'),
				'gallery_tiles_justified' => \Lang::get('zenware.novembergallery::lang.settings.gallery_tiles_layout_justified'),
				'gallery_tiles_nested' => \Lang::get('zenware.novembergallery::lang.settings.gallery_tiles_layout_nested'),
				'gallery_tiles_grid' => \Lang::get('zenware.novembergallery::lang.settings.gallery_tiles_layout_grid')
			];
		}

		return [
			'not_applicable' => \Lang::get('zenware.novembergallery::lang.miscellanous.not_applicable')
		];
	}

	/**
	 * Dynamic options for combinedLayout, options are only available if Gallery Layout is "Combined"
	 */
	public function getCombinedLayoutOptions()
	{
		if (\Request::input('galleryLayout') === 'gallery_combined') {
			return [
				'default' => \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
				'gallery_combined_default' => \Lang::get('zenware.novembergallery::lang.settings.gallery_combined_layout_default'),
				'gallery_combined_compact' => \Lang::get('zenware.novembergallery::lang.settings.gallery_combined_layout_compact'),
				'gallery_combined_grid' => \Lang::get('zenware.novembergallery::lang.settings.gallery_combined_layout_grid')
			];
		}

		return [
			'not_applicable' => \Lang::get('zenware.novembergallery::lang.miscellanous.not_applicable')
		];
	}

	/**
	 * Load CSS and JS assets
	 */
	public function InjectScripts()
	{
		if (Settings::instance()->inject_unitegallery_assets) {
			$this->addCss('assets/unitegallery/dist/css/unite-gallery.css');
			$this->addJs('assets/unitegallery/dist/js/unitegallery.min.js');
			switch ($this->getGalleryLayout()) {
				case 'gallery_tiles':
					switch ($this->getTilesLayout()) {
						case 'gallery_tiles_columns':
						case 'gallery_tiles_justified':
						case 'gallery_tiles_nested':
							$this->addJs('assets/unitegallery/dist/themes/tiles/ug-theme-tiles.js');
							break;
						case 'gallery_tiles_grid':
							$this->addJs('assets/unitegallery/dist/themes/tilesgrid/ug-theme-tilesgrid.js');
							break;
					}
					break;
				case 'gallery_carousel':
					$this->addJs('assets/unitegallery/dist/themes/carousel/ug-theme-carousel.js');
					break;
				case 'gallery_combined':
					switch ($this->getCombinedLayout()) {
						case 'gallery_combined_default':
							$this->addJs('assets/unitegallery/dist/themes/default/ug-theme-default.js');
							$this->addCss('assets/unitegallery/dist/themes/default/ug-theme-default.css');
							break;
						case 'gallery_combined_compact':
							$this->addJs('assets/unitegallery/dist/themes/compact/ug-theme-compact.js');
							break;
						case 'gallery_combined_grid':
							$this->addJs('assets/unitegallery/dist/themes/grid/ug-theme-grid.js');
							break;
					}
					break;
				case 'gallery_slider':
					$this->addJs('assets/unitegallery/dist/themes/slider/ug-theme-slider.js');
					break;
				case 'gallery_video':
					$this->addJs('assets/unitegallery/dist/themes/video/ug-theme-video.js');
					$this->addCss('assets/unitegallery/dist/themes/video/skin-right-no-thumb.css');
					$this->addCss('assets/unitegallery/dist/themes/video/skin-right-thumb.css');
					$this->addCss('assets/unitegallery/dist/themes/video/skin-right-title-only.css');
					$this->addCss('assets/unitegallery/dist/themes/video/skin-bottom-text.css');
					break;
			}
		}
	}

	/**
	 * Load Gallery Layout set on component inspector, with fallback to option set on the plugin configuration page
	 */
	public function getGalleryLayout()
	{
		if (!Settings::instance()->custom_gallery_script_enabled && !empty($this->property('galleryLayout')) && $this->property('galleryLayout') !== 'not_applicable' && $this->property('galleryLayout') !== 'default') {
			return $this->property('galleryLayout');
		} elseif (!empty(Settings::instance()->default_gallery)) {
			return Settings::instance()->default_gallery;
		}
		return 'gallery_tiles';
	}

	/**
	 * Load Tiles Layout set on component inspector, with fallback to option set on the plugin configuration page
	 */
	public function getTilesLayout()
	{
		if (!Settings::instance()->custom_gallery_script_enabled && !empty($this->property('tilesLayout')) && $this->property('tilesLayout') !== 'not_applicable' && $this->property('tilesLayout') !== 'default') {
			return $this->property('tilesLayout');
		} elseif (!empty(Settings::instance()->default_gallery_tiles_layout)) {
			return Settings::instance()->default_gallery_tiles_layout;
		}
		return 'gallery_tiles_columns';
	}

	/**
	 * Load Combined Layout set on component inspector, with fallback to option set on the plugin configuration page
	 */
	public function getCombinedLayout()
	{
		if (!Settings::instance()->custom_gallery_script_enabled && !empty($this->property('combinedLayout')) && $this->property('combinedLayout') !== 'not_applicable' && $this->property('combinedLayout') !== 'default') {
			return $this->property('combinedLayout');
		} elseif (!empty(Settings::instance()->gallery_combined_layout)) {
			return Settings::instance()->gallery_combined_layout;
		}
		return 'gallery_combined_default';
	}

	/**
	 * Load page variables etc.
	 */
	public function onRun()
	{
		$user = BackendAuth::getUser();
		if ($user) {
			if (
				Settings::instance()->custom_gallery_script_enabled && !empty($this->property('galleryLayout')) && $this->property('galleryLayout') !== 'not_applicable' && $this->property('galleryLayout') !== 'default'
				&& $this->property('galleryLayout') != Settings::instance()->default_gallery
			) {
				$this->error =  str_replace('[galleryLayout]', $this->property('galleryLayout'), str_replace('[default_gallery]', Settings::instance()->default_gallery, \Lang::get('zenware.novembergallery::lang.error.component_default_gallery_mismatch')));
			} elseif (
				Settings::instance()->custom_gallery_script_enabled && !empty($this->property('tilesLayout')) && $this->property('tilesLayout') !== 'not_applicable' && $this->property('tilesLayout') !== 'default'
				&& $this->property('tilesLayout') != Settings::instance()->default_gallery_tiles_layout
			) {
				$this->error =  str_replace('[tilesLayout]', $this->property('tilesLayout'), str_replace('[default_gallery_tiles_layout]', Settings::instance()->default_gallery_tiles_layout, \Lang::get('zenware.novembergallery::lang.error.component_default_gallery_tiles_layout_mismatch')));
			} elseif (
				Settings::instance()->custom_gallery_script_enabled && !empty($this->property('combinedLayout')) && $this->property('combinedLayout') !== 'not_applicable' && $this->property('combinedLayout') !== 'default'
				&& $this->property('combinedLayout') != Settings::instance()->gallery_combined_layout
			) {
				$this->error =  str_replace('[combinedLayout]', $this->property('combinedLayout'), str_replace('[gallery_combined_layout]', Settings::instance()->gallery_combined_layout, \Lang::get('zenware.novembergallery::lang.error.component_default_gallery_combined_layout_mismatch')));
			}
		}
		$this->defaultGalleryOptions = $this->getDefaultGalleryOptions();
		parent::onRun();
	}

	/**
	 * Inject page variables
	 */
	public function onRender()
	{
		// This MUST be done here instead of in onRun(), because there we don't yet have a $this->id:
		if (Settings::instance()->custom_gallery_script_enabled && !empty(Settings::instance()->default_gallery_options)) {
			$this->customGalleryScript = $this->page['customGalleryScript'] = str_replace("#gallery", '#' . $this->id, Settings::instance()->default_gallery_options);
		}
		parent::onRender();
	}

	/**
	 * Get default options used in the default.htm layout for initialising the gallery.
	 */
	public function getDefaultGalleryOptions()
	{
		$additionalOptions = new Collection();
		switch ($this->getGalleryLayout()) {
			case 'gallery_tiles':
				switch ($this->getTilesLayout()) {
					case 'gallery_tiles_columns':
						if ($this->getThumbnailWidth() !== false) $additionalOptions->put('tiles_col_width',  $this->getThumbnailWidth());
						$additionalOptions->put('gallery_theme', '"tiles"');
						break;
					case 'gallery_tiles_justified':
						if ($this->getThumbnailHeight() !== false) $additionalOptions->put('tiles_justified_row_height', $this->getThumbnailHeight());
						$additionalOptions->put('gallery_theme', '"tiles"');
						$additionalOptions->put('tiles_type', '"justified"');
						break;
					case 'gallery_tiles_nested':
						if ($this->getThumbnailWidth() !== false) $additionalOptions->put('tiles_nested_optimal_tile_width', $this->getThumbnailWidth());
						$additionalOptions->put('gallery_theme', '"tiles"');
						$additionalOptions->put('tiles_type', '"nested"');
						break;
					case 'gallery_tiles_grid':
						if ($this->getThumbnailWidth() !== false) $additionalOptions->put('tile_width', $this->getThumbnailWidth());
						if ($this->getThumbnailHeight() !== false) $additionalOptions->put('tile_height', $this->getThumbnailHeight());
						$additionalOptions->put('gallery_theme', '"tilesgrid"');
						break;
				}
				if ($this->getGalleryWidth() !== false) $additionalOptions->put('gallery_width', $this->getGalleryWidth());
				break;
			case 'gallery_carousel':
				if ($this->getThumbnailWidth() !== false) $additionalOptions->put('tile_width', $this->getThumbnailWidth());
				if ($this->getThumbnailHeight() !== false) $additionalOptions->put('tile_height', $this->getThumbnailHeight());
				$additionalOptions->put('gallery_theme', '"carousel"');
				break;
			case 'gallery_combined':
				switch ($this->getCombinedLayout()) {
					case 'gallery_combined_default':
						break;
					case 'gallery_combined_compact':
						$additionalOptions->put('gallery_theme', '"compact"');
						break;
					case 'gallery_combined_grid':
						$additionalOptions->put('gallery_theme', '"grid"');
						break;
				}
				if ($this->getThumbnailWidth() !== false) $additionalOptions->put('thumb_width', $this->getThumbnailWidth());
				if ($this->getThumbnailHeight() !== false) $additionalOptions->put('thumb_height', $this->getThumbnailHeight());
				if ($this->getGalleryWidth() !== false) $additionalOptions->put('gallery_width', $this->getGalleryWidth());
				if ($this->getGalleryHeight() !== false) $additionalOptions->put('gallery_height', $this->getGalleryHeight());
				break;
			case 'gallery_slider':
				if ($this->getGalleryWidth() !== false) $additionalOptions->put('gallery_width', $this->getGalleryWidth());
				if ($this->getGalleryHeight() !== false) $additionalOptions->put('gallery_height', $this->getGalleryHeight());
				$additionalOptions->put('gallery_theme', '"slider"');
				break;
		}

		$additionalOptions = $additionalOptions->map(function ($item, $key) {
			return $key . ':' . $item;
		})->implode(', ');

		if (!empty($this->property('additionalGalleryOptions'))) {
			if (!empty($additionalOptions)) $additionalOptions = $additionalOptions . ', ';
			$additionalOptions = $additionalOptions . rtrim($this->property('additionalGalleryOptions'), ', \t\n\r');
		}

		return $additionalOptions ?? '';
	}
}
