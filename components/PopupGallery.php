<?php

namespace ZenWare\NovemberGallery\Components;

use ZenWare\NovemberGallery\Models\Settings;
use October\Rain\Support\Collection;
use Backend\Facades\BackendAuth;

class PopupGallery extends NovemberGalleryComponentBase
{

	public $attachTo;

	public $defaultLightboxOptions;

	public $customLightboxScript;

	public $errorMessages;

	/**
	 * Name and description to display for this component in the backend "CMS" section in the 
	 * Components list.
	 * 
	 * @return array ['name' => '...', 'description' => '...']
	 */
	public function componentDetails()
	{
		return [
			'name' => 'zenware.novembergallery::lang.plugin.popup_gallery_component_name',
			'description' => 'zenware.novembergallery::lang.plugin.popup_gallery_component_description'
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
			'lightboxType' => [
				'title'       => \Lang::get('zenware.novembergallery::lang.component_properties.lightbox_type_label'),
				'description' => \Lang::get('zenware.novembergallery::lang.component_properties.lightbox_type_hint'),
				'type'        => 'dropdown',
				'placeholder' => \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
				'options'     => [
					'default' => \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
					'lightbox_type_wide' => \Lang::get('zenware.novembergallery::lang.component_properties.lightbox_type_wide'),
					'lightbox_type_compact' => \Lang::get('zenware.novembergallery::lang.component_properties.lightbox_type_compact'),
				]
			],
			'attachTo' => [
				'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.attach_to'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.attach_to_hint'),
				'default'           => ''
			],
			'additionalLightboxOptions' => [
				'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.additional_lightbox_options'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.additional_lightbox_options_hint'),
				'default'           => ''
			]
		]);
	}

	/**
	 * Load CSS and JS assets
	 */
	public function InjectScripts()
	{
		if (Settings::instance()->inject_unitegallery_assets) {
			$this->addCss('assets/unitegallery/dist/css/unite-gallery.css');

			// $this->addJs('assets/unitegallery/dist/js/unitegallery.min.js');

			$this->addJs('assets/unitegallery/source/unitegallery/js/ug-common-libraries.js');
			$this->addJs('assets/unitegallery/source/unitegallery/js/ug-functions.js');
			$this->addJs('assets/unitegallery/source/unitegallery/js/ug-thumbsgeneral.js');
			$this->addJs('assets/unitegallery/source/unitegallery/js/ug-thumbsstrip.js');
			$this->addJs('assets/unitegallery/source/unitegallery/js/ug-touchthumbs.js');
			$this->addJs('assets/unitegallery/source/unitegallery/js/ug-panelsbase.js');
			$this->addJs('assets/unitegallery/source/unitegallery/js/ug-strippanel.js');
			$this->addJs('assets/unitegallery/source/unitegallery/js/ug-gridpanel.js');
			$this->addJs('assets/unitegallery/source/unitegallery/js/ug-thumbsgrid.js');
			$this->addJs('assets/unitegallery/source/unitegallery/js/ug-tiles.js');
			$this->addJs('assets/unitegallery/source/unitegallery/js/ug-tiledesign.js');
			$this->addJs('assets/unitegallery/source/unitegallery/js/ug-avia.js');
			$this->addJs('assets/unitegallery/source/unitegallery/js/ug-slider.js');
			$this->addJs('assets/unitegallery/source/unitegallery/js/ug-sliderassets.js');
			$this->addJs('assets/unitegallery/source/unitegallery/js/ug-touchslider.js');
			$this->addJs('assets/unitegallery/source/unitegallery/js/ug-zoomslider.js');
			$this->addJs('assets/unitegallery/source/unitegallery/js/ug-video.js');
			$this->addJs('assets/unitegallery/source/unitegallery/js/ug-gallery.js');
			$this->addJs('assets/unitegallery/source/unitegallery/js/ug-lightbox.js');
			$this->addJs('assets/unitegallery/source/unitegallery/js/ug-carousel.js');
			$this->addJs('assets/unitegallery/source/unitegallery/js/ug-api.js');

			$this->addJs('assets/unitegallery/source/unitegallery/themes/lightbox/ug-theme-lightbox.js');
		}
	}

	/**
	 * Set proprety defaults, such as allowed extensions, and load the list of images to display.
	 */
	public function onRun()
	{
		if (!empty($this->property('attachTo'))) {
			$this->attachTo = $this->property('attachTo');
		} else {
			$user = BackendAuth::getUser();
			if ($user) {
				$this->error = \Lang::get('zenware.novembergallery::lang.error.nothing_to_attach_to');
			}
		}

		$this->defaultLightboxOptions = $this->getDefaultLightboxOptions();

		parent::onRun();
	}

	/**
	 * Inject page variables
	 */
	public function onRender()
	{
		$this->errorMessages = [
			'nothing_to_attach_to' => \Lang::get('zenware.novembergallery::lang.error.nothing_to_attach_to'),
			'cannot_find_element_with_id' => str_replace('[alias]', $this->alias, str_replace('[attachTo]', $this->attachTo, \Lang::get('zenware.novembergallery::lang.error.cannot_find_element_with_id')))
		];

		// This MUST be done here instead of in onRun(), because there we don't yet have a $this->id:
		if (Settings::instance()->custom_lightbox_script_enabled && !empty(Settings::instance()->custom_lightbox_script)) {
			$this->customLightboxScript = $this->page['customLightboxScript'] = str_replace("#gallery", '#' . $this->id, Settings::instance()->custom_lightbox_script);
		}
		parent::onRender();
	}

	/**
	 * Get default options used in the default.htm layout for initialising the lightbox.
	 * 
	 * @return string Comma-separated list of options
	 */
	public function getDefaultLightboxOptions()
	{
		$additionalOptions = new Collection();

		$additionalOptions->put('gallery_theme', '"lightbox"');

		switch ($this->getLightboxType()) {
			case 'lightbox_type_wide':
				$additionalOptions->put('lightbox_type', '"wide"');
				break;
			case 'lightbox_type_compact':
				$additionalOptions->put('lightbox_type', '"compact"');
				break;
		}

		$additionalOptions = $additionalOptions->map(function ($item, $key) {
			return $key . ':' . $item;
		})->implode(', ');

		if (!empty($this->property('additionalLightboxOptions'))) {
			if (!empty($additionalOptions)) $additionalOptions = $additionalOptions . ', ';
			$additionalOptions = $additionalOptions . rtrim($this->property('additionalLightboxOptions'), ', \t\n\r');
		}

		return $additionalOptions ?? '';
	}

	/**
	 * Get the lightbox type
	 * 
	 * @return string Lightbox type
	 */
	public function getLightboxType()
	{
		if (!empty($this->property('lightboxType')) && $this->property('lightboxType') !== 'not_applicable' && $this->property('lightboxType') !== 'default') {
			return $this->property('lightboxType');
		}
		return '';
	}
}
