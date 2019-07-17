<?php
namespace ZenWare\NovemberGallery\Components;

use ZenWare\NovemberGallery\Models\Settings;
use ToughDeveloper\ImageResizer\Classes\Image;
use Debugbar;

class EmbeddedGallery extends NovemberGalleryComponentBase {

    /**
     * Name and description to display for this component in the backend "CMS" section in the 
     * Components list.
     * 
     * @return array ['name' => '...', 'description' => '...']
     */
    public function componentDetails() {
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
            'mediaFolder' => [
                'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.folder_label'),
                'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.folder_label_hint'),
                'default'           => '',
                'type'              => 'dropdown',
                'placeholder'       => \Lang::get('zenware.novembergallery::lang.component_properties.folder_label_placeholder'),
                'validationPattern' => '^[a-zA-Z0-9$\-_.+!*\'(),/]+$',   // https://perishablepress.com/stop-using-unsafe-characters-in-urls/
                'validationMessage' => \Lang::get('zenware.novembergallery::lang.component_properties.folder_label_validation_message'),
            ],
			'galleryLayout' => [
				'title'       => \Lang::get('zenware.novembergallery::lang.component_properties.gallery_layout_label'),
				'description' => \Lang::get('zenware.novembergallery::lang.component_properties.gallery_layout_hint'),
                'type'        => 'dropdown',
				'placeholder' => \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
				'options'     => [
					'default' => \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
					'gallery_tiles' => \Lang::get('zenware.novembergallery::lang.settings.default_gallery_tiles'),
					'gallery_carousel'=> \Lang::get('zenware.novembergallery::lang.settings.default_gallery_carousel'),
					'gallery_combined'=> \Lang::get('zenware.novembergallery::lang.settings.default_gallery_combined'),
					'gallery_slider'=> \Lang::get('zenware.novembergallery::lang.settings.default_gallery_slider'),
					'gallery_video'=> \Lang::get('zenware.novembergallery::lang.settings.default_gallery_video'),
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
			'additional_gallery_options' => [
                'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.additional_gallery_options'),
                'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.additional_gallery_options_hint'),
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
			$this->addJs('assets/unitegallery/dist/js/unitegallery.min.js');
			switch($this->getGalleryLayout()) 
			{
				case 'gallery_tiles':
					switch($this->getTilesLayout()) 
					{
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
					switch($this->getCombinedLayout()) 
					{
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
        parent::onRun();
	}
}