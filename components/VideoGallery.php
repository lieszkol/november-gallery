<?php
namespace ZenWare\NovemberGallery\Components;

use ZenWare\NovemberGallery\Models\Settings;

class VideoGallery extends NovemberGalleryComponentBase {

	public $videogalleryitemsselector;

    /**
     * Name and description to display for this component in the backend "CMS" section in the 
     * Components list.
     * 
     * @return array ['name' => '...', 'description' => '...']
     */
    public function componentDetails() {
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
            'mediaFolder' => [
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
					'video_gallery_right_title_only'=> \Lang::get('zenware.novembergallery::lang.settings.video_gallery_right_title_only'),
					'video_gallery_right_no_thumb'=> \Lang::get('zenware.novembergallery::lang.settings.video_gallery_right_no_thumb'),
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
					'exact'=> \Lang::get('zenware.novembergallery::lang.settings.image_resizer_mode_exact'),
					'portrait'=> \Lang::get('zenware.novembergallery::lang.settings.image_resizer_mode_portrait'),
					'landscape'=> \Lang::get('zenware.novembergallery::lang.settings.image_resizer_mode_landscape'),
					'crop'=> \Lang::get('zenware.novembergallery::lang.settings.image_resizer_mode_crop'),
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
     * Load CSS and JS assets
     */
    public function InjectScripts() {
		if (Settings::instance()->inject_unitegallery_assets) 
		{
	        $this->addCss('assets/unitegallery/dist/css/unite-gallery.css');
			
			$this->addJs('assets/unitegallery/dist/js/unitegallery.min.js');
			
			$this->addJs('assets/unitegallery/dist/themes/video/ug-theme-video.js');

			switch($this->getVideoGalleryLayout()) 
			{
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

	public function getVideoGalleryLayout() 
	{
		if (!empty($this->property('videoGalleryLayout')) && $this->property('videoGalleryLayout') !== 'not_applicable' && $this->property('videoGalleryLayout') !== 'default') 
		{
			return $this->property('videoGalleryLayout');
		}
		elseif (!empty(Settings::instance()->default_video_gallery_layout))
		{
			return Settings::instance()->default_video_gallery_layout;
		}
		return '';
	}
		
	public function onRun() {
		if (!empty($this->property('videoGalleryItemsSelector'))) 
		{
			$this->videogalleryitemsselector = $this->property('videoGalleryItemsSelector');
		}

        parent::onRun();
	}
}