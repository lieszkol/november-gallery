<?php

namespace ZenWare\NovemberGallery\Components;

use ZenWare\NovemberGallery\Models\Settings;

class SwiperGallery extends NovemberGalleryComponentBase
{

	public $effect;
	public $direction;
	public $speed;
	public $lazyload;
	public $addpagination;
	public $addnavigation;
	public $autoplay;
	public $autoplaydelay;
	public $customGalleryScript;
	public $useDescriptionAsCSS;
	public $mediaQuery;

	/**
	 * Name and description to display for this component in the backend "CMS" section in the 
	 * Components list.
	 * 
	 * @return array ['name' => '...', 'description' => '...']
	 */
	public function componentDetails()
	{
		return [
			'name' => 'zenware.novembergallery::lang.plugin.swiper_gallery_component_name',
			'description' => 'zenware.novembergallery::lang.plugin.swiper_gallery_component_description'
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
			'effect' => [
				'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.effect_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.effect_hint'),
				'type'        		=> 'dropdown',
				'placeholder' 		=> \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
				'options'     		=> [
					'default' => \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
					'slide' => \Lang::get('zenware.novembergallery::lang.settings.swiper_effect_slide'),
					'fade' => \Lang::get('zenware.novembergallery::lang.settings.swiper_effect_fade'),
					'cube' => \Lang::get('zenware.novembergallery::lang.settings.swiper_effect_cube'),
					'coverflow' => \Lang::get('zenware.novembergallery::lang.settings.swiper_effect_coverflow'),
					'flip' => \Lang::get('zenware.novembergallery::lang.settings.swiper_effect_flip'),
				],
				'validationPattern' => '^[a-zA-Z]+$',
				'validationMessage' => \Lang::get('zenware.novembergallery::lang.component_properties.effect_validation_message'),
			],
			'direction' => [
				'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.swiper_direction_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.swiper_direction_hint'),
				'type'        		=> 'dropdown',
				'default' 			=> 'horizontal',
				'options'     		=> [
					'horizontal' => \Lang::get('zenware.novembergallery::lang.component_properties.swiper_direction_option_horizontal'),
					'vertical' => \Lang::get('zenware.novembergallery::lang.component_properties.swiper_direction_option_vertical'),
				],
				'validationPattern' => '^[a-zA-Z]+$',
				'validationMessage' => \Lang::get('zenware.novembergallery::lang.component_properties.swiper_direction_validation_message'),
			],
			'speed' => [
				'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.swiper_speed_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.swiper_speed_hint'),
				'default'           => '300',
				'type'              => 'string',
				'validationPattern' => '^[0-9]+$',
				'validationMessage' => \Lang::get('zenware.novembergallery::lang.component_properties.swiper_speed_validation_message'),
			],
			'lazyLoad' => [
				'title'				=> \Lang::get('zenware.novembergallery::lang.component_properties.lazyload_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.lazyload_hint'),
				'type'				=> 'checkbox',
				'default'			=> true,
			],
			'addPagination' => [
				'title'				=> \Lang::get('zenware.novembergallery::lang.component_properties.addpagination_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.addpagination_hint'),
				'type'				=> 'checkbox',
				'default'			=> true,
			],
			'addNavigation' => [
				'title'				=> \Lang::get('zenware.novembergallery::lang.component_properties.addnavigation_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.addnavigation_hint'),
				'type'				=> 'checkbox',
				'default'			=> true,
			],
			'autoplay' => [
				'title'				=> \Lang::get('zenware.novembergallery::lang.component_properties.autoplay_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.autoplay_hint'),
				'type'				=> 'checkbox',
				'default'			=> true,
			],
			'autoplayDelay' => [
				'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.autoplaydelay_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.autoplaydelay_hint'),
				'default'           => '5000',
				'type'              => 'string',
				'validationPattern' => '^[0-9]+$',
				'validationMessage' => \Lang::get('zenware.novembergallery::lang.component_properties.autoplaydelay_validation_message'),
			],
			'additionalGalleryOptions' => [
				'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.additional_swiper_options'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.additional_swiper_options_hint'),
				'default'           => ''
			],
			'useDescriptionAsCSS' => [
				'title'				=> \Lang::get('zenware.novembergallery::lang.component_properties.usedescriptionascss_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.usedescriptionascss_hint'),
				'type'				=> 'checkbox',
				'default'			=> false,
				'group' 			=> \Lang::get('zenware.novembergallery::lang.component_properties.group_css_label')
			],
			'mediaQuery' => [
				'title'				=> \Lang::get('zenware.novembergallery::lang.component_properties.mediaquery_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.mediaquery_hint'),
				'type'              => 'string',
				'group' 			=> \Lang::get('zenware.novembergallery::lang.component_properties.group_css_label')
			],
		]);
	}

	/**
	 * Load CSS and JS assets
	 */
	public function InjectScripts()
	{
		if (Settings::instance()->inject_swiper_assets) {
			$this->addJs('assets/swiper/swiper.min.js');
			$this->addCss('assets/swiper/swiper.min.css');
		}
	}

	/**
	 * Set proprety defaults, such as allowed extensions, and load the list of images to display.
	 */
	public function onRun()
	{

		$this->effect = $this->getEffect();
		$this->direction = $this->property('direction');
		$this->speed = $this->property('speed');
		$this->lazyload = $this->property('lazyLoad');
		$this->addpagination = $this->property('addPagination');
		$this->addnavigation = $this->property('addNavigation');
		$this->autoplay = $this->property('autoplay');
		$this->autoplaydelay = $this->property('autoplayDelay');
		$this->defaultGalleryOptions = $this->getDefaultGalleryOptions();
		$this->useDescriptionAsCSS = $this->property('useDescriptionAsCSS');
		$this->mediaQuery = $this->property('mediaQuery');
		parent::onRun();
	}

	/**
	 * Get the swipe effect
	 * 
	 * @return string Swipe effect
	 */
	public function getEffect()
	{
		if (!empty($this->property('effect')) && $this->property('effect') !== 'default') {
			return $this->property('effect');
		} elseif (!empty(Settings::instance()->default_swiper_effect)) {
			return Settings::instance()->default_swiper_effect;
		}
		return '';
	}

	/**
	 * Get default options used in the default.htm layout for initialising the gallery.
	 * 
	 * @return string Comma-separated list of options
	 */
	public function getDefaultGalleryOptions()
	{
		$additionalOptions = '';

		if (!empty($this->property('additionalGalleryOptions'))) {
			if (!empty($additionalOptions)) $additionalOptions = $additionalOptions . ', ';
			$additionalOptions = $additionalOptions . rtrim($this->property('additionalGalleryOptions'), ', \t\n\r');
		}

		return $additionalOptions ?? '';
	}
}
