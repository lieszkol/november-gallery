<?php
namespace ZenWare\NovemberGallery\Components;

class CustomGallery extends NovemberGalleryComponentBase {

    public function componentDetails() {
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
        return array_merge(parent::defineProperties(), [
            'mediaFolder' => [
                'title'             => 'Media Folder',
                'description'       => 'Select the folder that you uploaded the images to in the OctoberCMS Media manager. Only folders under the base folder set on the November Gallery settings page are valid.',
                'default'           => '',
                'type'              => 'dropdown',
                'placeholder'       => 'Select gallery folder',
                // 'validationPattern' => '^[a-zA-Z0-9$\-_.+!*\'(),/]+$',   // https://perishablepress.com/stop-using-unsafe-characters-in-urls/
                // 'validationMessage' => 'The Media Folder can contain only letters, numbers, or the following URL-safe characters: $-_.+!*\'(),/'
            ]
        ]);
    }

    /**
     * Load CSS and JS assets
     */
    public function InjectScripts() {
	}
}