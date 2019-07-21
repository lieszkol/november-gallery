<?php
namespace ZenWare\NovemberGallery\Components;

use ZenWare\NovemberGallery\Models\Settings;
use ToughDeveloper\ImageResizer\Classes\Image;

class PopupGallery extends NovemberGalleryComponentBase {

	public $attachto;

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
			'attach_to' => [
                'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.attach_to'),
                'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.attach_to_hint'),
                'default'           => '#gallery-button'
			],
			'additional_lightbox_options' => [
                'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.additional_lightbox_options'),
                'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.additional_lightbox_options_hint'),
                'default'           => ''
			]
        ]);
    }

    /**
     * Load CSS and JS assets
     */
    public function onRun() {
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

		if (!empty($this->property('attach_to'))) 
		{
			$this->attachto = $this->property('attach_to');
		}

        parent::onRun();
	}
}