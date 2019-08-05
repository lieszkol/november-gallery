<?php return [
    'plugin' => [
        'name' => 'November Gallery',
        'long_name' => 'UniteGallery.js + OctoberCMS Media Manager + Image Resizer = NovemberGallery',
        'description' => 'Upload your photos using the October Media manager and display them on your page as an embedded gallery or a pop-up lightbox!',
        'long_description' => 'OctoberCMS Media manager + vvvmax/unitegallery + Image Resizer plugin = a highly customizable yet reliable way to display your photos in a gallery. The plugin reads images uploaded using October\'s built-in Media manager, uses the ImageResizer plugin to automatically generate thumbnails, and presents them in a gallery either as tiles (arranged in columns, justified, or laid out in a grid), as a carousel, as a slider, or as a pop-up lightbox that can be opened from a link/button. Some of its awesome features: responsive/touch enabled/skinnable/themable/gallery buttons/keyboard control etc.',
        
		// Components
		'embedded_gallery_component_name' => 'Embedded Gallery',
        'embedded_gallery_component_description' => 'Show a gallery of images in your page using various layouts, with optional full-screen (lightbox-style) viewing.',
        'popup_gallery_component_name' => 'Popup Lightbox',
        'popup_gallery_component_description' => 'Include a lightbox-style "pop-up" gallery that is only shown when the user clicks on an element (such as a link/button/image).',
        'video_gallery_component_name' => 'Video Gallery',
        'video_gallery_component_description' => 'Show a gallery of YouTube/Vimeo/Wistia videos, or ogv/webm/mp4 videos uploaded to your site.',
        'custom_gallery_component_name' => 'Image List Only',
        'custom_gallery_component_description' => 'Load the list of image files only, without rendering a gallery. Use this if you wish to write your own code for displaying the images.'
	],
	
	'menu' => [
		'bacendmenuitem_label' => 'Galleries',
		'galleries' => [
			'sidemenu' => [
				'galleries_label' => 'Galleries'
			]
		]
	],

	'entities' => [
		'common' => [
			'id_label' => 'ID'
		],
		'gallery_label' => 'Gallery',
		'gallery_new_button' => 'New Gallery',
		'gallery_update_button' => 'Update Gallery',
		'gallery_return_to' => 'Back to Galleries',
		'gallery_confirm_delete' => 'Are you sure you wish to delete this gallery?',
		'gallery' => [
			'name_label' => 'Gallery Name',
			'name_placeholder' => 'Enter Name',
			'slug_label' => 'Slug',
			'slug_placeholder' => 'Enter Slug',
			'images_label' => 'Images',
			'description_label' => 'Description',
			'description_placeholder' => 'Enter Description',
			'published_label' => 'Active',
			'published_at_label' => 'Published On',
			'attached_images_count_label' => '# of Images',
			'created_at_label' => 'Created',
			'updated_at_label' => 'Updated',
			'preview_image_label' => 'Preview Image'
		]
	],

	'lists' => [
		'no_records' => 'Nothing to see here!',
		'delete_selected' => 'Delete Selected',
		'confirm_delete_selected' => 'Are you sure you wish to delete the selected the records?'
	],

	'forms' => [
		'create_label' => 'Create',
		'update_label' => 'Update',
		'preview_label' => 'Preview',
		'tabs' => [
			'items_label' => 'Items',
			'advanced_label' => 'Advanced'
		]
	],

    'settings' => [
		// Tabs
        'tab_embeddedgallery' => 'Embedded Gallery',
        'tab_lightbox' => 'Popup Lightbox',
        'tab_videogallery' => 'Video Gallery',
        'tab_imageresizer' => 'Thumbnails',
        'tab_advanced' => 'Advanced',
        'tab_documentation' => 'Help!',

		// Base Media Folder
        'base_folder_label' => 'Base Media Folder',
        'base_folder_comment' => 'Gallery components will only show subfolders of the folder you select here.',
        'base_folder_emptyoption' => '-- Media Root --',

		// Section Embedded Gallery Defaults
        'section_gallery_defaults_label' => 'Embedded Gallery Defaults',
        
		// Gallery Layout
        'default_gallery_label' => 'Gallery Layout',
        'default_gallery_comment' => 'Check out <a href="http://unitegallery.net" target="_blank">UniteGallery.net</a> for live examples of each',
        'default_gallery_tiles' => 'Tiles',
        'default_gallery_carousel' => 'Carousel',
        'default_gallery_combined' => 'Combined',
        'default_gallery_slider' => 'Slider',
        
		// Custom Gallery Script
		'custom_gallery_script_enabled_label' => 'Custom Embedded Gallery Script',
        'custom_gallery_script_enabled_comment' => 'Set your own initialization script and options for the "Embedded Gallery" component (disables setting various options above)',
        
		'custom_gallery_script_label' => 'Custom Embedded Gallery Script',
		'custom_gallery_script_hint' => 'You can find information about the plethora of options available at <a href="http://unitegallery.net" target="_blank">UniteGallery.net</a>. You can also insert any custom javascript to run before or after the gallery initialization here.<br>The gallery ID will be the alias of the component, since we cannot know this beforehand, refer to "#gallery" in your script and it will be replaced with the component alias. So your script might look something like this (setting the width to 100% as an example option): <br><pre>jQuery("#gallery").unitegallery({<br>&nbsp;&nbsp;&nbsp;gallery_width:"100%"<br>});</pre>',        
		// Tiles Layout
        'gallery_tiles_layout_label' => 'Tile Layout',
        'gallery_tiles_layout_columns' => 'Columns',
        'gallery_tiles_layout_justified' => 'Justified',
        'gallery_tiles_layout_nested' => 'Nested',
        'gallery_tiles_layout_grid' => ' Grid',

		// Combined Layout
        'gallery_combined_layout_label' => 'Thumbnails Layout',
        'gallery_combined_layout_default' => 'Normal (default)',
        'gallery_combined_layout_compact' => 'Compact',
        'gallery_combined_layout_grid' => 'Grid',

		// Lightbox
        'section_lightbox_defaults_label' => 'Lightbox Defaults',

		'custom_lightbox_script_enabled_label' => 'Custom Popup Lightbox Script',
        'custom_lightbox_script_enabled_comment' => 'Set your own initialization script and options for the "Popup Lightbox" component',
                
		'custom_lightbox_script_hint' => 'For available options, see <a href="http://unitegallery.net/index.php?page=carousel-options" target="_blank">UniteGallery.net, Carousel - Including and Options</a>.<br>The gallery ID will be the alias of the component, since we cannot know this beforehand, refer to "#gallery" in your script and it will be replaced with the component alias. So your script might look something like this (setting the width to 100% as an example option): <br><pre>jQuery("#gallery").unitegallery({<br>&nbsp;&nbsp;&nbsp;lightbox_type: "wide"<br>});</pre>',
		'custom_lightbox_script_label' => 'Custom Popup Lightbox Script',

		// Base Video Folder
        'base_video_folder_label' => 'Base Videos Folder',
        'base_video_folder_comment' => 'Video component will only show subfolders of the folder you select here.',
        'base_video_folder_emptyoption' => '-- Media Root --',

        // Video Gallery:
		'section_videogallery_defaults_label' => 'Video Gallery Defaults',

	   	'default_video_gallery_label' => 'Video Gallery Layout',
	   	'default_video_gallery_comment' => 'Check out <a href="http://unitegallery.net" target="_blank">UniteGallery.net</a> for live examples of each',
		'video_gallery_right_thumb' => 'Thumbnails',
        'video_gallery_right_title_only' => 'Titles Only',
        'video_gallery_right_no_thumb' => 'No Thumbnails',

		'custom_video_gallery_script_enabled_label' => 'Custom Video Gallery Script',
        'custom_video_gallery_script_enabled_comment' => 'Set your own initialization script and options for the "Video Gallery" component',
	
		'custom_video_gallery_script_label' => 'Custom Video Gallery Script',
		'custom_video_gallery_script_hint' => 'You can find information about the plethora of options available at <a href="http://unitegallery.net" target="_blank">UniteGallery.net</a>. You can also insert any custom javascript to run before or after the gallery initialization here.<br>The gallery ID will be the alias of the component, since we cannot know this beforehand, refer to "#gallery" in your script and it will be replaced with the component alias. So your script might look something like this (setting the width to 100% as an example option): <br><pre>jQuery("#gallery").unitegallery({<br>&nbsp;&nbsp;&nbsp;gallery_theme: "video",<br>&nbsp;&nbsp;&nbsp;theme_skin: "right-thumb"<br>});</pre>',
        
		// Image Resizer Settings
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

		// Media Formats
        'allowed_extensions_label' => 'Media Formats',
        'allowed_extensions_comment' => 'Refer to WikiPedia for a discussion of <a href="https://en.wikipedia.org/wiki/Comparison_of_web_browsers#Image_format_support" target="_blank">which browser supports which media format</a>.',

		// Inject Assets
		'inject_unitegallery_assets' => 'Inject UniteGallery Assets',
		'inject_unitegallery_assets_comment' => 'Automatically inject UniteGallery JS and CSS into the page when required (make sure you have a {% scripts %} AS WELL as a {% styles %} somewhere in your layout/page!)',
		'inject_jquery' => 'Inject jQuery',
		'inject_jquery_comment' => 'Automatically inject jQuery into the page (select only if your theme/layout doesn\'t already do so)'

	],
	
    'component_properties' => [

		// Gallery Layout
		'gallery_layout_label' => 'Gallery Layout',
        'gallery_layout_hint' => 'Select a gallery layout, or select "default" to use the gallery layout set on the plugin settings page.',
        'gallery_tiles_layout_label' => 'Tile Layout',
        'gallery_tiles_layout_hint' => 'Only applicable if the gallery layout is set to "tiles". Select "default" to use the gallery layout set on the plugin settings page.',
        'gallery_combined_layout_label' => 'Thumbnails Layout',
        'gallery_combined_layout_hint' => 'Only applicable if the gallery layout is set to "combined". Select "default" to use the thumbnails layout set on the plugin settings page.',
		
		// Lihtbox Type
		'lightbox_type_label' => 'Lightbox Type',
		'lightbox_type_hint' => 'Select the lightbox type or leave empty to use the default type ("Wide"). "Wide" is full screen with black background, "Compact" is a smaller image with a border and a transparent gray background.',
		'lightbox_type_wide' => 'Wide',
		'lightbox_type_compact' => 'Compact',

		// Media Folder
		'folder_label' => 'Media Folder or Gallery',
		'folder_label_hint' => 'Select the folder that you uploaded the images to in the OctoberCMS Media manager. Only folders under the base folder set on the November Gallery settings page are valid.',
		'folder_label_placeholder' => 'Select gallery folder',
		'folder_label_validation_message' => 'The Media Folder can contain only letters, numbers, or the following URL-safe characters: $-_.+!*\'(),/',
		
		// Script options
		'additional_gallery_options' => 'Script options',
		'additional_gallery_options_hint' => 'Additional JS options that you want passed onto the UniteGallery script, for example: theme_panel_position: "bottom"',
		'additional_lightbox_options' => 'Script options',
		'additional_lightbox_options_hint' => 'Additional JS options that you want passed onto the UniteGallery script, for example: theme_panel_position: "bottom"',
		
		// Attach to
		'attach_to' => 'Attach to',
		'attach_to_hint' => 'JQuery selector for the element(s) that the user can click on to open the lightbox.',
		
		// Thumbnails
		'group_thumbnails_label' => 'Thumbnails',
		'image_resizer_mode_label' => 'Thumbnail Mode',
        'image_resizer_width_label' => 'Thumbnail Width',
        'image_resizer_width_comment' => 'Leave empty or set to 0 to only constrain the image by height; leave both width and height empty to fall back on the values set on the backend plugin configuration page',
        'image_resizer_height_label' => 'Thumbnail Height',
        'image_resizer_height_comment' => 'Leave empty or set to 0 to only constrain the image by width; leave both width and height empty to fall back on the values set on the backend plugin configuration page',
		'image_resizer_mode_hint' => 'Select how to resize your images into thumbnails, or select "default" to use the thumbnail mode set on the plugin settings page.',
		'video_gallery_items_selector' => 'Gallery Selector/ID',
		'video_gallery_items_selector_hint' => 'Enter the jQuery selector that identifies the <div> that contains your gallery item definitions, for example: #videos. Leave blank if you are selecting a Media Folder instead.',
		
		// Gallery Dimensions
		'group_gallery_dimensions_label' => 'Gallery Dimensions',
		'gallery_width_label' => 'Gallery Width',
        'gallery_width_comment' => 'Can be a number (pixel lenght) or a percent (of the parent container). Leave empty to fall back on the values set on the backend plugin configuration page',
        'gallery_height_label' => 'Gallery Height',
        'gallery_height_comment' => 'Only applies to "Combined" and "Slider" galleries! Can be a number (pixel lenght) or a percent (of the parent container). Leave empty to fall back on the values set on the backend plugin configuration page'
	],
    'permission' => [
        'tab' => 'November Gallery',
		'label' => 'Manage Settings',
		'access_galleries' => 'Manage Galleries'
	],
	'miscellanous' => [
        'switch_on' => 'On',
        'switch_off' => 'Off',
		'not_applicable' => 'Not applicable',
		'default' => 'Default'
	]
];