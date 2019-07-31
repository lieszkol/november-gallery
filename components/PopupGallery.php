<?php
namespace ZenWare\NovemberGallery\Components;

use ZenWare\NovemberGallery\Models\Settings;
use ToughDeveloper\ImageResizer\Classes\Image;
use October\Rain\Support\Collection;

class PopupGallery extends NovemberGalleryComponentBase {

	public $attachto;
	public $defaultlightboxoptions;
	public $customlightboxscript;

    /**
     * Name and description to display for this component in the backend "CMS" section in the 
     * Components list.
     * 
     * @return array ['name' => '...', 'description' => '...']
     */
    public function componentDetails() {
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
            'mediaFolder' => [
                'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.folder_label'),
                'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.folder_label_hint'),
                'default'           => '',
                'type'              => 'dropdown',
                'placeholder'       => \Lang::get('zenware.novembergallery::lang.component_properties.folder_label_placeholder'),
                'validationPattern' => '^[a-zA-Z0-9$\-_.+!*\'(),/]+$',   // https://perishablepress.com/stop-using-unsafe-characters-in-urls/
                'validationMessage' => \Lang::get('zenware.novembergallery::lang.component_properties.folder_label_validation_message'),
            ],
			'lightboxType' => [
				'title'       => \Lang::get('zenware.novembergallery::lang.component_properties.lightbox_type_label'),
				'description' => \Lang::get('zenware.novembergallery::lang.component_properties.lightbox_type_hint'),
                'type'        => 'dropdown',
				'placeholder' => \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
				'options'     => [
					'default' => \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
					'lightbox_type_wide' => \Lang::get('zenware.novembergallery::lang.component_properties.lightbox_type_wide'),
					'lightbox_type_compact'=> \Lang::get('zenware.novembergallery::lang.component_properties.lightbox_type_compact'),
				]
			],
			'attachTo' => [
                'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.attach_to'),
                'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.attach_to_hint'),
                'default'           => '#gallery-button'
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
    public function InjectScripts() {
		if (Settings::instance()->inject_unitegallery_assets) 
		{
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
		
	public function onRun() {
		if (!empty($this->property('attachTo'))) 
		{
			$this->attachto = $this->property('attachTo');
		}

		$this->defaultlightboxoptions = $this->getDefaultLightboxOptions();

		if (Settings::instance()->custom_lightbox_script_enabled && !empty(Settings::instance()->custom_lightbox_script))
		{
			$this->customlightboxscript = str_replace("#gallery", $this->id, Settings::instance()->custom_lightbox_script);
		}

        parent::onRun();
	}

	/**
     * Get default options used in the default.htm layout for initialising the lightbox.
     */
    public function getDefaultLightboxOptions() {		
		$additionalOptions = new Collection();

		$additionalOptions->put('gallery_theme', '"lightbox"');

		switch($this->getLightboxType()) 
		{
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

		if (!empty($this->property('additionalLightboxOptions'))) 
		{
			if (!empty($additionalOptions)) $additionalOptions = $additionalOptions . ', ';
			$additionalOptions = $additionalOptions . rtrim($this->property('additionalLightboxOptions'), ', \t\n\r');
		}

		return $additionalOptions ?? '';
	}

	public function getLightboxType() 
	{
		if (!empty($this->property('lightboxType')) && $this->property('lightboxType') !== 'not_applicable' && $this->property('lightboxType') !== 'default') 
		{
			return $this->property('lightboxType');
		}
		return '';
	}
}