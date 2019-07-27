(function (NovemberGallerySettings, $, undefined) {
	'use strict';

	function updateEditor() {
	
		// https://ace.c9.io/#nav=howto
		// https://octobercms.com/forum/post/codeeditor-insert-text-at-cursor-from-javascript?page=1#post-26532
		// https://github.com/octobercms/october/blob/master/modules/backend/formwidgets/codeeditor/assets/js/codeeditor.js
		// https://stackoverflow.com/questions/25452304/how-to-get-ace-editor-object-from-its-div-id
		var editor = ace.edit('CodeEditor-formDefaultGalleryOptions-default_gallery_options-code');
		var oldValue = editor.getValue();
		
		switch ($('#Form-field-Settings-default_gallery').val()) {
			case 'gallery_tiles':
				switch ($('#Form-field-Settings-default_gallery_tiles_layout').val()) {
					case 'gallery_tiles_columns':
						editor.setValue('jQuery("#gallery").unitegallery({});');
						break;
					case 'gallery_tiles_justified':
						editor.setValue([
							'jQuery("#gallery").unitegallery({',
							'	tiles_type:"justified"',
							'});'].join('\n'));
						break;
					case 'gallery_tiles_nested':
						editor.setValue([
							'jQuery("#gallery").unitegallery({',
							'	tiles_type:"nested"',
							'});'].join('\n'));
						break;
					case 'gallery_tiles_grid':
						editor.setValue('jQuery("#gallery").unitegallery({});');
						break;
				}
				break;
			case 'gallery_carousel':
				editor.setValue('jQuery("#gallery").unitegallery({});');
				break;
			case 'gallery_combined':
				switch ($('#Form-field-Settings-gallery_combined_layout').val()) {
					case 'gallery_combined_default':
						editor.setValue('jQuery("#gallery").unitegallery({});');
						break;
					case 'gallery_combined_compact':
						editor.setValue([
							'jQuery("#gallery").unitegallery({',
							'	gallery_theme: "compact"',
							'});'].join('\n'));
						break;
					case 'gallery_combined_grid':
						editor.setValue([
							'jQuery("#gallery").unitegallery({',
							'	gallery_theme: "grid"',
							'});'].join('\n'));
						break;
				}
				break;
			case 'gallery_slider':
				editor.setValue([
					'jQuery("#gallery").unitegallery({',
					'	gallery_theme: "slider"',
					'});'].join('\n'));
				break;
		}
	}

	function updateVideoEditor() {
	
		var editor = ace.edit('CodeEditor-formCustomVideoGalleryScript-custom_video_gallery_script-code');
		var oldValue = editor.getValue();
		
		switch ($('#Form-field-Settings-default_video_gallery_layout').val()) {
			case 'video_gallery_right_thumb':
				editor.setValue([
					'jQuery("#gallery").unitegallery({',
					'	gallery_theme: "video",',
					'	theme_skin: "right-thumb"',
					'});'].join('\n'));
				break;
				case 'video_gallery_right_title_only':
					editor.setValue([
						'jQuery("#gallery").unitegallery({',
						'	gallery_theme: "video",',
						'	theme_skin: "right-title-only"',
						'});'].join('\n'));
					break;
				case 'video_gallery_right_no_thumb':
					editor.setValue([
						'jQuery("#gallery").unitegallery({',
						'	gallery_theme: "video",',
						'	theme_skin: "right-no-thumb"',
						'});'].join('\n'));
					break;
		}
	}

	$(document).ready(function() {
		$('#Form-field-Settings-default_gallery').change(function() {
			updateEditor();
		});
		$('#Form-field-Settings-default_gallery_tiles_layout').change(function() {
			updateEditor();
		});
		$('#Form-field-Settings-gallery_combined_layout').change(function() {
			updateEditor();
		});
		$('#Form-field-Settings-default_video_gallery_layout').change(function() {
			updateVideoEditor();
		});

		if (!ace.edit('CodeEditor-formDefaultGalleryOptions-default_gallery_options-code').getValue())
		{
			updateEditor();
		}

		if (!ace.edit('CodeEditor-formCustomVideoGalleryScript-custom_video_gallery_script-code').getValue())
		{
			updateVideoEditor();
		}
	});

}(window.NovemberGallerySettings = window.NovemberGallerySettings || {}, jQuery));