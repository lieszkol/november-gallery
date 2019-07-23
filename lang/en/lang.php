<?php return [
    'plugin' => [
        'name' => 'November Gallery',
        'long_name' => 'UniteGallery.js + OctoberCMS Media Manager + Image Resizer = NovemberGallery',
        'description' => 'Upload your photos using the October Media manager and display them on your page as an embedded gallery or a pop-up lightbox!',
        'long_description' => 'OctoberCMS Media manager + vvvmax/unitegallery + Image Resizer plugin = a highly customizable yet reliable way to display your photos in a gallery. The plugin reads images uploaded using October\'s built-in Media manager, uses the ImageResizer plugin to automatically generate thumbnails, and presents them in a gallery either as tiles (arranged in columns, justified, or laid out in a grid), as a carousel, as a slider, or as a pop-up lightbox that can be opened from a link/button. Some of its awesome features: responsive/touch enabled/skinnable/themable/gallery buttons/keyboard control etc.',
        'embedded_gallery_component_name' => 'Embedded Gallery',
        'embedded_gallery_component_description' => 'Show a gallery of images in your page using various layouts, with optional full-screen (lightbox-style) viewing.',
        'popup_gallery_component_name' => 'Popup Lightbox',
        'popup_gallery_component_description' => 'Include a lightbox-style "pop-up" gallery that is only shown when the user clicks on an element (such as a link/button/image).',
        'custom_gallery_component_name' => 'Image List Only',
        'custom_gallery_component_description' => 'Load the list of image files only, without rendering a gallery. Use this if you wish to write your own code for displaying the images.'
    ],
    'settings' => [
        'switch_on' => 'On',
        'switch_off' => 'Off',

        'tab_default' => 'Settings',
        'tab_imageresizer' => 'Thumbnails',
        'tab_advanced' => 'Advanced',
        'tab_documentation' => 'Help!',

        'base_folder_label' => 'Base Media Folder',
        'base_folder_comment' => 'Gallery components will only show subfolders of the folder you select here.',
        'base_folder_emptyoption' => '-- Media Root --',

        'section_gallery_defaults_label' => 'Embedded Gallery Defaults',
        
        'default_gallery_label' => 'Gallery Layout',
        'default_gallery_comment' => 'Check out <a href="http://unitegallery.net" target="_blank">UniteGallery.net</a> for live examples of each',
        'default_gallery_tiles' => 'Tiles',
        'default_gallery_carousel' => 'Carousel',
        'default_gallery_combined' => 'Combined',
        'default_gallery_slider' => 'Slider',
        'default_gallery_video' => 'Video',
        'default_gallery_options_hint' => 'You can find information about the plethora of options available at <a href="http://unitegallery.net" target="_blank">UniteGallery.net</a>. You can also insert any custom javascript to run before or after the gallery initialization here.<br>The gallery ID will be "gallery" by default, so your script might look something like this (setting the width to 100% as an example option): <br><pre>jQuery("#gallery").unitegallery({<br>&nbsp;&nbsp;&nbsp;gallery_width:"100%"<br>});</pre>',
        'default_gallery_options_label' => 'Custom Gallery Script',

        'custom_gallery_script_label' => 'Custom Gallery Script',
        'custom_gallery_script_comment' => 'Set your own gallery initialization script and options (disables setting various options here)',
        
        'gallery_tiles_layout_label' => 'Tile Layout',
        'gallery_tiles_layout_columns' => 'Columns',
        'gallery_tiles_layout_justified' => 'Justified',
        'gallery_tiles_layout_nested' => 'Nested',
        'gallery_tiles_layout_grid' => ' Grid',

        'gallery_combined_layout_label' => 'Thumbnails Layout',
        'gallery_combined_layout_default' => 'Normal (default)',
        'gallery_combined_layout_compact' => 'Compact',
        'gallery_combined_layout_grid' => 'Grid',

        'section_lightbox_defaults_label' => 'Lightbox Defaults',

		'custom_lightbox_script_enabled_label' => 'Custom Lightbox Script',
        'custom_lightbox_script_enabled_comment' => 'Set your own lightbox initialization script and options',
                
		'custom_lightbox_script_hint' => 'For available options, see <a href="http://unitegallery.net/index.php?page=carousel-options" target="_blank">UniteGallery.net, Carousel - Including and Options</a>.<br>The gallery ID will be "gallery" by default, so your script might look something like this (setting the width to 100% as an example option): <br><pre>jQuery("#gallery").unitegallery({<br>&nbsp;&nbsp;&nbsp;gallery_width:"100%"<br>});</pre>',
		'custom_lightbox_script_label' => 'Custom Lightbox Script',
	

		'section_imager_resizer_label' => 'Image Resizer Settings',
        'use_image_resizer_label' => 'Use Image Resizer',
        'use_image_resizer_comment' => 'Use the October Image Resizer plugin, which automatically creates a resized and compressed thumbnail of your original image.',
        'image_resizer_width_label' => 'Width',
        'image_resizer_width_comment' => 'Leave empty or set to 0 to only constrain the image by height',
        'image_resizer_height_label' => 'Height',
        'image_resizer_height_comment' => 'Leave empty or set to 0 to only constrain the image by width',
        
        'image_resizer_mode_label' => 'Mode',
        'image_resizer_mode_exact' => 'Exact',
        'image_resizer_mode_portrait' => 'Portrait',
        'image_resizer_mode_landscape' => 'Landscape',
        'image_resizer_mode_auto' => 'Auto',
        'image_resizer_mode_crop' => 'Crop',
        'image_resizer_mode_emptyoption' => 'Default (as set in ImageResizer)',

        'image_resizer_quality_label' => 'Quality',
        'image_resizer_quality_comment' => 'The quality of compression *requires cache clear',
        'image_resizer_hint' => 'Please set other options, such as sharpening and compression, on the Image Resizer plugin settings page!',

        'allowed_extensions_label' => 'Media Formats',
        'allowed_extensions_comment' => 'Refer to WikiPedia for a discussion of <a href="https://en.wikipedia.org/wiki/Comparison_of_web_browsers#Image_format_support" target="_blank">which browser supports which media format</a>.',

		'inject_unitegallery_assets' => 'Inject UniteGallery Assets',
		'inject_unitegallery_assets_comment' => 'Automatically inject UniteGallery JS and CSS into the page when required (make sure you have a {% scripts %} AS WELL as a {% styles %} somewhere in your layout/page!)',
		'inject_jquery' => 'Inject jQuery',
		'inject_jquery_comment' => 'Automatically inject jQuery into the page (select only if your theme/layout doesn\'t already do so)'
    ],
    'component_properties' => [
		'gallery_layout_label' => 'Gallery Layout',
        'gallery_layout_hint' => 'Select a gallery layout, or select "default" to use the gallery layout set on the plugin settings page.',
        'gallery_tiles_layout_label' => 'Tile Layout',
        'gallery_tiles_layout_hint' => 'Only applicable if the gallery layout is set to "tiles". Select "default" to use the gallery layout set on the plugin settings page.',
        'gallery_combined_layout_label' => 'Thumbnails Layout',
        'gallery_combined_layout_hint' => 'Only applicable if the gallery layout is set to "combined". Select "default" to use the thumbnails layout set on the plugin settings page.',
        'folder_label' => 'Media Folder',
		'folder_label_hint' => 'Select the folder that you uploaded the images to in the OctoberCMS Media manager. Only folders under the base folder set on the November Gallery settings page are valid.',
		'folder_label_placeholder' => 'Select gallery folder',
		'folder_label_validation_message' => 'The Media Folder can contain only letters, numbers, or the following URL-safe characters: $-_.+!*\'(),/',
		'additional_gallery_options' => 'Script options',
		'additional_gallery_options_hint' => 'Additional JS options that you want passed onto the UniteGallery script, for example: theme_panel_position: "bottom"',
		'additional_lightbox_options' => 'Script options',
		'additional_lightbox_options_hint' => 'Additional JS options that you want passed onto the UniteGallery script, for example: theme_panel_position: "bottom"',
		'attach_to' => 'Attach to',
		'attach_to_hint' => 'JQuery selector for the element(s) that the user can click on to open the lightbox.',
		'group_thumbnails_label' => 'Thumbnails',
		'image_resizer_mode_label' => 'Thumbnail Mode',
        'image_resizer_width_label' => 'Thumbnail Width',
        'image_resizer_width_comment' => 'Leave empty or set to 0 to only constrain the image by height; leave both width and height empty to fall back on the values set on the backend plugin configuration page',
        'image_resizer_height_label' => 'Thumbnail Height',
        'image_resizer_height_comment' => 'Leave empty or set to 0 to only constrain the image by width; leave both width and height empty to fall back on the values set on the backend plugin configuration page',
		'image_resizer_mode_hint' => 'Select how to resize your images into thumbnails, or select "default" to use the thumbnail mode set on the plugin settings page.',
		'group_gallery_dimensions_label' => 'Gallery Dimensions',
		'gallery_width_label' => 'Gallery Width',
        'gallery_width_comment' => 'Can be a number (pixel lenght) or a percent (of the parent container). Leave empty to fall back on the values set on the backend plugin configuration page',
        'gallery_height_label' => 'Gallery Height',
        'gallery_height_comment' => 'Only applies to "Combined" and "Slider" galleries! Can be a number (pixel lenght) or a percent (of the parent container). Leave empty to fall back on the values set on the backend plugin configuration page'
	],
    'permission' => [
        'tab' => 'November Gallery',
        'label' => 'Manage Settings'
	],
	'miscellanous' => [
		'not_applicable' => 'Not applicable',
		'default' => 'Default'
	]
];