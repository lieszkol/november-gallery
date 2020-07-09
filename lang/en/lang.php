<?php return [
    'plugin' => [
        'name' => 'November Gallery',
        'long_name' => 'UniteGallery.js + OctoberCMS Media Manager + Image Resizer = NovemberGallery',
        'description' => 'Display your photos in an embedded gallery, as thumbnails "masonry-style", in a responsive "swiper", or as a pop-up lightbox!',
        'long_description' => 'OctoberCMS Media manager + vvvmax/unitegallery + Image Resizer plugin = a highly customizable yet reliable way to display your photos in a gallery. The plugin reads images uploaded using October\'s built-in Media manager, uses the ImageResizer plugin to automatically generate thumbnails, and presents them in a gallery either as tiles (arranged in columns, justified, or laid out in a grid), as a carousel, as a slider, or as a pop-up lightbox that can be opened from a link/button. Some of its awesome features: responsive/touch enabled/skinnable/themable/gallery buttons/keyboard control etc.',
        
		// Components
		'embedded_gallery_component_name' => 'Embedded Gallery',
        'embedded_gallery_component_description' => 'Show a gallery of images in your page using various layouts, with optional full-screen (lightbox-style) viewing.',
        'swiper_gallery_component_name' => 'Swiper Gallery',
        'swiper_gallery_component_description' => 'Show a modern, responsive gallery where the images can be swiped left and right on any device.',
        'popup_gallery_component_name' => 'Popup Lightbox',
        'popup_gallery_component_description' => 'Include a lightbox-style "pop-up" gallery that is only shown when the user clicks on an element (such as a link/button/image).',
        'video_gallery_component_name' => 'Video Gallery',
        'video_gallery_component_description' => 'Show a gallery of YouTube/Vimeo/Wistia videos, or ogv/webm/mp4 videos uploaded to your site.',
        'custom_gallery_component_name' => 'Image List Only',
		'custom_gallery_component_description' => 'Load the list of image files only, without rendering a gallery. Use this if you wish to write your own code for displaying the images.',
		'gallery_hub_component_name' => 'Gallery Hub',
		'gallery_hub_component_description' => 'Gallery of galleries (or sub-folders).'
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
			'keywords_label' => 'Keywords',
			'keywords_placeholder' => 'Enter a list of words, separated by commas',
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

	'rainlab_blog_post' => [
		'gallery_selector_hint' => 'Which galleries would you like to add to this post?',
		'tab_label' => 'Galleries',
		'folder_label' => 'Media Folder',
	],

    'settings' => [
		// Tabs
        'tab_embeddedgallery' => 'Image Gallery',
        'tab_lightbox' => 'Popup Lightbox',
        'tab_videogallery' => 'Video Gallery',
        'tab_blogcomponent' => 'Blog Integration',
        'tab_imageresizer' => 'Thumbnails',
        'tab_advanced' => 'Advanced',
        'tab_documentation' => 'Help!',

		// Image Gallery Options
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
		
		// Section Embedded Gallery Defaults
        'section_swiper_defaults_label' => 'Swiper Defaults',
		// Swiper Effects
		'swiper' => 'Swiper',
        'default_swiper_effect_label' => 'Default Swiper Effect',
        'default_swiper_effect_comment' => 'Check out <a href="https://idangero.us/swiper/demos/" target="_blank">igangero.us/swiper</a> for live demos of each',
		'swiper_effect_slide' => 'Slide',
        'swiper_effect_fade' => 'Fade',
        'swiper_effect_cube' => 'Cube',
        'swiper_effect_coverflow' => 'Coverflow',
        'swiper_effect_flip' => 'Flip',



		// Popup-Lightbox Options
        'section_lightbox_defaults_label' => 'Lightbox Defaults',
		'custom_lightbox_script_enabled_label' => 'Custom Popup Lightbox Script',
        'custom_lightbox_script_enabled_comment' => 'Set your own initialization script and options for the "Popup Lightbox" component',
		'custom_lightbox_script_hint' => 'For available options, see <a href="http://unitegallery.net/index.php?page=carousel-options" target="_blank">UniteGallery.net, Carousel - Including and Options</a>.<br>The gallery ID will be the alias of the component, since we cannot know this beforehand, refer to "#gallery" in your script and it will be replaced with the component alias. So your script might look something like this (setting the width to 100% as an example option): <br><pre>jQuery("#gallery").unitegallery({<br>&nbsp;&nbsp;&nbsp;lightbox_type: "wide"<br>});</pre>',
		'custom_lightbox_script_label' => 'Custom Popup Lightbox Script',



		// Video Gallery Options
        'base_video_folder_label' => 'Base Videos Folder',
        'base_video_folder_comment' => 'Video component will only show subfolders of the folder you select here.',
        'base_video_folder_emptyoption' => '-- Media Root --',
        'base_video_folder_sameasimagegalleryoption' => '-- Image Gallery Base Media Folder --',
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
        


		// Blog Integration Options
        'base_blogmedia_folder_label' => 'Base Media Folder',
        'base_blogmedia_folder_comment' => 'Blog component will only show subfolders of the folder you select here.',
        'base_blogmedia_folder_emptyoption' => '-- Media Root --',
        'base_blogmedia_folder_sameasimagegalleryoption' => '-- Image Gallery Base Media Folder --',



		// Image Resizer Settings
		'section_imager_resizer_label' => 'Image Resizer Settings',
        'use_image_resizer_label' => 'Use Image Resizer for image galleries',
        'use_image_resizer_comment' => 'Use the October Image Resizer plugin, which automatically creates a resized and compressed thumbnail of your original image.',
        'use_image_resizer_disabled' => 'Image resizer seems to be missing or disabled. You must <a href="https://octobercms.com/plugin/toughdeveloper-imageresizer">install it manually</a> from the OctoberCMS Plugin Marketplace!',
        'image_resizer_width_label' => 'Default Width',
        'image_resizer_width_comment' => 'Leave empty or set to 0 to only constrain the image by height; you can override this in the component inspector',
        'image_resizer_height_label' => 'Default Height',
        'image_resizer_height_comment' => 'Leave empty or set to 0 to only constrain the image by width; you can override this in the component inspector',
        
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
		'inject_swiper_assets' => 'Inject Swiper Assets',
		'inject_swiper_assets_comment' => 'Automatically inject Swiper JS and CSS into the page when required (make sure you have a {% scripts %} AS WELL as a {% styles %} somewhere in your layout/page!)',
		'inject_jquery' => 'Inject jQuery',
		'inject_jquery_comment' => 'Automatically inject jQuery into the page (select only if your theme/layout doesn\'t already do so)'

	],
	
    'component_properties' => [
		// Shared options:
		'max_items_label' => 'Max Images',
		'max_items_hint' => 'The maximum number of images/videos to display',
		'max_items_validation' => 'The Max Images property can only contain numbers!',
		'order_images_by_label' => 'Order by',
		'order_images_by_label_hint' => 'Note: Image Title, Description, and Sort Order only work for images uploaded using the Galleries page!',
		'order_images_by_option_title' => 'Image Title',
		'order_images_by_option_description' => 'Image Description',
		'order_images_by_option_sort_order' => 'Image Order in Gallery',
		'order_images_by_option_width' => 'Image Width',
		'order_images_by_option_height' => 'Image Height',
		'order_images_by_option_orientation' => 'Image Orientation',
		'order_images_by_option_file_name' => 'Filename',
		'order_images_by_option_file_size' => 'File Size',
		'order_images_by_option_uploaded' => 'Date/Time Uploaded',

		// Image gallery options:
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
		'folder_type_post' => '> Take from RainLab Post',
		// Script options
		'additional_gallery_options' => 'Script options',
		'additional_gallery_options_hint' => 'Additional JS options that you want passed onto the UniteGallery script, for example: theme_panel_position: "bottom"',
		'additional_lightbox_options' => 'Script options',
		'additional_lightbox_options_hint' => 'Additional JS options that you want passed onto the UniteGallery script, for example: theme_panel_position: "bottom"',
		// Thumbnails
		'group_thumbnails_label' => 'Thumbnails',
		'image_resizer_mode_label' => 'Thumbnail Mode',
        'image_resizer_width_label' => 'Thumbnail Width',
        'image_resizer_width_comment' => 'Leave empty or set to 0 to only constrain the image by height; leave both width and height empty to fall back on the values set on the backend plugin configuration page',
        'image_resizer_height_label' => 'Thumbnail Height',
        'image_resizer_height_comment' => 'Leave empty or set to 0 to only constrain the image by width; leave both width and height empty to fall back on the values set on the backend plugin configuration page',
		'image_resizer_mode_hint' => 'Select how to resize your images into thumbnails, or select "default" to use the thumbnail mode set on the plugin settings page.',
		
		// Pop-up lightbox-specific options:
		'attach_to' => 'Attach to',
		'attach_to_hint' => 'JQuery selector for the element(s) that the user can click on to open the lightbox; for example: #gallery-button',

		// Swiper-specific options:
		'effect_label' => 'Transition Effect',
		'effect_hint' => 'Tranisition effect. Can be "slide", "fade", "cube", "coverflow" or "flip"',
		'effect_validation_message' => 'Transition effect can only contain characters!',
		'swiper_direction_label' => 'Direction',
		'swiper_direction_hint' => 'Can be "horizontal" or "vertical"',
		'swiper_direction_option_horizontal' => 'horizontal',
		'swiper_direction_option_vertical' => 'vertical',
		'swiper_direction_validation_message' => 'Swipe direction can only contain characters!',
		'swiper_speed_label' => 'Transition Speed',
		'swiper_speed_hint' => 'How long the transition effect lasts, in milliseconds. 1000 = 1 seconds.',
		'swiper_speed_validation_message' => 'The Autoplay Delay property can only contain numbers!',
		'lazyload_label' => 'Lazy-load images?',
		'lazyload_hint' => 'Toggle ON to only load the images the user is looking at. Previous and next images are set to pre-load automatically.',
		'addpagination_label' => 'Add pagination?',
		'addpagination_hint' => 'Toggle ON to show bullets (or anything else) that enable to user to jump to any specific slide.',
		'addnavigation_label' => 'Add navigation?',
		'addnavigation_hint' => 'Toggle ON to show previous-slide and next-slide navigational arrows.',
		'autoplay_label' => 'Auto-play?',
		'autoplay_hint' => 'Toggle ON to enable automatic advance on the slides. Set the delay below.',
		'autoplaydelay_label' => 'Auto-play Delay',
		'autoplaydelay_hint' => 'How long each image is shown for, in milliseconds. 1000 = 1 seconds.',
		'autoplaydelay_validation_message' => 'The Autoplay Delay property can only contain numbers!',
		'additional_swiper_options' => 'Additional Swiper Options',
		'additional_swiper_options_hint' => 'Additional JS options that you want passed onto the Swiper script, for example: fadeEffect: {crossFade: true}',
		'group_css_label' => 'CSS',
		'usedescriptionascss_label' => 'Description is Style',
		'usedescriptionascss_hint' => 'Inject the image description as CSS for that image; only works for images uploaded through the backend Gallery page.',
		'mediaquery_label' => 'Media Query',
		'mediaquery_hint' => 'You can set a media query to only apply the style in certain circumstances. Do not include a trailing "{". For example: @media screen and (max-width: 766px) and (orientation: portrait)',

		// Video-gallery-specific options: 
		'video_gallery_items_selector' => 'Gallery Selector/ID',
		'video_gallery_items_selector_hint' => 'Enter the jQuery selector that identifies the <div> that contains your gallery item definitions, for example: #videos. Leave blank if you are selecting a Media Folder instead.',
		
		// Gallery Dimensions
		'group_gallery_dimensions_label' => 'Gallery Dimensions',
		'gallery_width_label' => 'Gallery Width',
        'gallery_width_comment' => 'Can be a number (pixel lenght) or a percent (of the parent container). Leave empty to fall back on the values set on the backend plugin configuration page',
        'gallery_height_label' => 'Gallery Height',
		'gallery_height_comment' => 'Only applies to "Combined" and "Slider" galleries! Can be a number (pixel lenght) or a percent (of the parent container). Leave empty to fall back on the values set on the backend plugin configuration page',
		
		// Gallery Hub:
		'hub_type_label' => 'Hub Type',
		'hub_type_label_hint' => 'Leave blank to show a hub of all galleries, or select one of the options to only show certain galleries.',
		'hub_type_label_placeholder' => 'Select hub type',
		//'hub_type_label_validation_message' => 'The Media Folder can contain only letters, numbers, or the following URL-safe characters: $-_.+!*\'(),/',
		'hub_type_option_all' => 'All Galleries',

		'hub_max_galleries_label' => 'Max Galleries',
		'hub_max_galleries_label_hint' => 'The maximum number of galleries to display (leave blank to show all)',
		'hub_max_galleries_validation' => 'The Max Galleries property can only contain numbers!',

		'hub_order_galleries_by_label' => 'Order by',
		'hub_order_galleries_by_label_hint' => 'Note: Gallery Slug, Gallery Description, and Published On only work for images uploaded using the Galleries page!',
		'hub_order_galleries_by_option_title' => 'Gallery Title or Folder Name (default)',
		'hub_order_galleries_by_option_description' => 'Gallery Description',
		'hub_order_galleries_by_option_slug' => 'Gallery Slug',
		'hub_order_galleries_by_option_published_on' => 'Published On or Folder Creation Date',

		'group_visualization_label' => 'Visualization',

		'hub_visualization_link_url_label' => 'Link URL',
		'hub_visualization_link_url_hint' => 'Set the URL of your galleries. Include the following placeholder, which will be replaced with the "slug" of your gallery: %slug%',
		'hub_visualization_link_url_required' => 'The link URL is required!',

		'hub_visualization_open_in_new_tab_label' => 'Open in new tab?',
		'hub_visualization_open_in_new_tab_label_hint' => 'Should the link open in a new tab or in the current one?',
	
		'hub_visualization_label' => 'Display as',
		'hub_visualization_label_hint' => 'Choose one of the presets, or "template" if you wish to define your own template, or "custom" if you will write your own Twig code to render the gallery links!',
		'hub_visualization_option_preview_image' => 'Links with Preview Image',
		'hub_visualization_option_title' => 'List of Links with Title Only',
		'hub_visualization_option_template' => 'Set the Template Below',
		'hub_visualization_option_custom' => 'Write your own Twig Code (links are not rendered)',

		'hub_visualization_template' => 'Link Template',
		'hub_visualization_template_hint' => 'Choose "Set the Template Below" in "Display as" and set your template, tags such as %type%, %url%, %slug%, %folder%, %name%, %description%, %keywords%, %created_at%, %updated_at%, %preview_image_url% will be replaced with actual values.'
		
	],
    'permission' => [
        'tab' => 'November Gallery',
		'label' => 'Manage Settings',
		'access_galleries' => 'Manage Galleries'
	],
	'error' => [
		'nothing_to_attach_to' => 'NovemberGallery error: when using the Popup Lightbox component, you have to manually create an element on the page and set the "Attach To" property to the ID of that element. This element can be as simple as a button, for example: <pre class="inline"><code>&lt;button id="gallery-button"&gt;Click me!&lt;/button&gt;</code></pre>',
		'cannot_find_element_with_id' => 'NovemberGallery error: Cannot find element with ID <pre class="inline"><code>[attachTo]</code></pre> while rendering popup gallery with alias <i>[alias]</i>!',
		'component_default_gallery_mismatch' => 'NovemberGallery warning: you\'ve turned on the "Custom Embedded Gallery Script" option in the November Gallery backend settings, however, the default Gallery Layout you selected there ([default_gallery]) does not match the gallery layout you selected in the component inspector ([galleryLayout]). The default layout will be used instead. Either turn off the "Custom Embedded Gallery Script" option in the plugin configuration page, or set the Gallery Layout to "Default" in the component inspector.',
		'component_default_gallery_tiles_layout_mismatch' => 'NovemberGallery warning: you\'ve turned on the "Custom Embedded Gallery Script" option in the November Gallery backend settings, however, the default Tile Layout you selected there ([default_gallery_tiles_layout]) does not match the gallery layout you selected in the component inspector ([tilesLayout]). The default layout will be used instead. Either turn off the "Custom Embedded Gallery Script" option in the plugin configuration page, or set the Gallery Layout to "Default" in the component inspector.',
		'component_default_gallery_combined_layout_mismatch' => 'NovemberGallery warning: you\'ve turned on the "Custom Embedded Gallery Script" option in the November Gallery backend settings, however, the default Tile Layout you selected there ([gallery_combined_layout]) does not match the gallery layout you selected in the component inspector ([combinedLayout]). The default layout will be used instead. Either turn off the "Custom Embedded Gallery Script" option in the plugin configuration page, or set the Gallery Layout to "Default" in the component inspector.'
	],
	'miscellanous' => [
        'switch_on' => 'On',
        'switch_off' => 'Off',
		'not_applicable' => 'Not applicable',
		'default' => 'Default',
		'sort_descending_string' => 'Z->A',
		'sort_descending_number' => '9->0',
		'sort_descending_date' => 'Newest First'
	]
];