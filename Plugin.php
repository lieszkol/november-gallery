<?php

namespace ZenWare\NovemberGallery;

use System\Classes\PluginBase;
use App;
use Event;
use System\Classes\PluginManager;
use Backend;

// use Debugbar;   // http://wiltonsoftware.nz/blog/post/debug-october-cms-plugin

use ZenWare\NovemberGallery\Models\Settings;

class Plugin extends PluginBase
{
	// public $require = ['ToughDeveloper.ImageResizer'];

	/**
	 * Registers all components provided by this blugin.
	 *
	 * @return array Component path => component name
	 */
	public function registerComponents()
	{
		return [
			'ZenWare\NovemberGallery\Components\EmbeddedGallery' => 'embeddedGallery',
			'ZenWare\NovemberGallery\Components\SwiperGallery' => 'swiperGallery',
			'ZenWare\NovemberGallery\Components\PopupGallery' => 'popupLightbox',
			'ZenWare\NovemberGallery\Components\CustomGallery' => 'customGallery',
			'ZenWare\NovemberGallery\Components\VideoGallery' => 'videoGallery',
			'ZenWare\NovemberGallery\Components\GalleryHub' => 'galleryHub'
		];
	}

	/**
	 * Registers components as snippets. For the life of me I cannot find any documentation on this - but this seems to be the way to do it.
	 * We don't include the customGallery since there's not much a user could do with it on a "Pages page".
	 *
	 * @return array Component path => component name
	 */
	public function registerPageSnippets()
	{
		return [
			'ZenWare\NovemberGallery\Components\EmbeddedGallery' => 'embeddedGallery',
			'ZenWare\NovemberGallery\Components\SwiperGallery' => 'swiperGallery',
			'ZenWare\NovemberGallery\Components\PopupGallery' => 'popupLightbox',
			'ZenWare\NovemberGallery\Components\VideoGallery' => 'videoGallery',
			'ZenWare\NovemberGallery\Components\GalleryHub' => 'galleryHub'
		];
	}

	/**
	 * Registers any back-end settings used by this plugin.
	 *
	 * @return array ['label' => '...', 'description' => '...', ...]
	 */
	public function registerSettings()
	{
		return [
			'settings' => [
				'label'       => 'November Gallery',
				'description' => 'Set the default media folder and other options.',
				'icon'        => 'oc-icon-th',
				'class'       => 'ZenWare\NovemberGallery\Models\Settings',
				'order'       => 500,
				'keywords'    => 'november gallery default medial folder',
				'permissions' => ['zenware.novembergallery.access_settings']
			]
		];
	}

	/**
	 * Registers any back-end permissions used by this plugin.
	 *
	 * @return array Array of permissions
	 */
	public function registerPermissions()
	{
		return [
			'zenware.novembergallery.access_settings' => [
				'tab'   => 'zenware.novembergallery::lang.permission.tab',
				'label' => 'zenware.novembergallery::lang.permission.label',
				'access_galleries' => 'zenware.novembergallery::lang.permission.access_galleries'
			]
		];
	}

	/**
	 * Backend menus and their side-menus
	 */
	public function registerNavigation()
	{
		return [
			'novembergallery' => [
				'label'       => 'zenware.novembergallery::lang.menu.bacendmenuitem_label',
				'url'         => Backend::url('zenware/novembergallery/galleries'),
				'icon'        => 'icon-camera-retro',
				'permissions' => ['zenware.novembergallery.*'],
				'order'       => 200,
				// This is how we would do a side-menu, but really it's unnecessary:
				// 'sideMenu' => [
				// 	'galleries' => [
				// 		'label'       => 'zenware.novembergallery::lang.menu.galleries.sidemenu.galleries_label',
				// 		'icon'        => 'icon-film',
				// 		'url'         => Backend::url('zenware/novembergallery/galleries'),
				// 		'permissions' => ['zenware.novembergallery.access_galleries']
				// 	]
				// 	// 'categories' => [
				// 	// 	'label'       => 'Categories',
				// 	// 	'icon'        => 'icon-copy',
				// 	// 	'url'         => Backend::url('acme/blog/categories'),
				// 	// 	'permissions' => ['acme.blog.access_categories']
				// 	// ]
				// ]
			]
		];
	}

	/**
	 *  Custom list types
	 */
	public function registerListColumnTypes()
	{
		// $mediaPath = url(Config::get('cms.storage.media.path'));
		return [
			'strong' => function ($value) {
				return '<strong>' . $value . '</strong>';
			},
			// 'text_preview' => function($value) { $content = mb_substr(strip_tags($value), 0, 150); if(mb_strlen($content) > 150) { return ($content . '...'); } else { return $content; } },
			// 'html_text_preview' => function($value) { return strip_tags(nl2br($value), '<br>'); },
			// 'array_preview' => function($value) { $content = mb_substr(strip_tags( implode(' --- ', $value) ), 0, 150); if(mb_strlen($content) > 150) { return ($content . '...'); } else { return $content; } },
			// 'switch_icon_star' => function($value) { return '<div class="text-center"><span class="'. ($value==1 ? 'oc-icon-circle text-success' : 'text-muted oc-icon-circle text-draft') .'">' . ($value==1 ? e(trans('janvince.smallcontactform::lang.models.message.columns.new')) : e(trans('janvince.smallcontactform::lang.models.message.columns.read')) ) . '</span></div>'; },
			// 'switch_extended_input' => function($value) { if($value){return '<span class="list-badge badge-success"><span class="icon-check"></span></span>';} else { return '<span class="list-badge badge-danger"><span class="icon-minus"></span></span>';} },
			'switch_extended' => function ($value) {
				if ($value) {
					return '<span class="list-badge badge-success"><span class="icon-check"></span></span>';
				} else {
					return '<span class="list-badge badge-danger"><span class="icon-minus"></span></span>';
				}
			},
			'attached_images_count' => function ($value) {
				return (count($value) ? count($value) : 1);
			},
			'record_image_preview' => function ($value) {
				$width = 100;
				$height = 100;
				if ($value) {
					return "<img src='" . $value->getThumb($width, $height) . "' style='width: auto; height: auto; max-width: " . $width . "px; max-height: " . $height . "px'>";
				}
			},
		];
	}

	/**
	 * Load backend js scripts when opening the settings page.
	 * https://octobercms.com/forum/post/how-to-add-javascript-file-to-backend-pages
	 */
	public function boot()
	{
		// Check for Rainlab.Blog plugin
		$pluginManager = PluginManager::instance()->findByIdentifier('Rainlab.Blog');
		if ($pluginManager && !$pluginManager->disabled) {
			// Rainlab Blog Posts integration

			\RainLab\Blog\Models\Post::extend(function ($model) {
				$model->hasOne['novembergalleryfields'] = [
					'ZenWare\NovemberGallery\Models\BlogFields',
					'delete' => 'true',
					'key' => 'rainlab_blog_posts_id',
					'otherKey' => 'id'
				];

				/*
				* From: https://github.com/jan-vince/smallextensions/blob/master/Plugin.php
				* Thsanks jan-vince for making if open-source!
				*/
				$model->bindEvent('model.afterSave', function () use ($model) {
					$model->novembergalleryfields->rainlab_blog_posts_id = $model->id;
					$model->novembergalleryfields->save();
				});

				$model->belongsToMany['novembergalleries'] = [
					'ZenWare\NovemberGallery\Models\Gallery',
					'table'    => 'zenware_novembergallery_galleries_of_post',
					'key'      => 'rainlab_blog_posts_id',
					'otherKey' => 'zenware_novembergallery_gallery_id'
				];
			});

			\RainLab\Blog\Controllers\Posts::extendFormFields(function ($form, $model) {
				if (
					!$model instanceof \RainLab\Blog\Models\Post
					|| !$model->exists
				) {
					return;
				}
			});

			Event::listen('backend.form.extendFields', function ($form) {
				if (!$form->getController() instanceof \RainLab\Blog\Controllers\Posts) {
					return;
				}
				if (!$form->model instanceof \RainLab\Blog\Models\Post) {
					return;
				}
				if ($form->isNested) {
					return;
				}
				/*
				* Custom fields model deferred bind
				*/
				if (!$form->model->novembergalleryfields) {
					$sessionKey = uniqid('session_key', true);
					$form->model->novembergalleryfields = new \ZenWare\NovemberGallery\Models\BlogFields;
				}
				$options = null;
				if (Settings::instance()->base_blogmedia_folder == '<inherit>') {
					$options = NovemberHelper::getSubdirectories(Settings::instance()->base_folder);
				} else {
					$options = NovemberHelper::getSubdirectories(Settings::instance()->base_blogmedia_folder);
				}
				$options = $options->toArray();

				$form->addSecondaryTabFields([
					'novembergalleries' => [
						'label' => 'zenware.novembergallery::lang.rainlab_blog_post.gallery_selector_hint',
						'tab' => 'zenware.novembergallery::lang.rainlab_blog_post.tab_label',
						'type' => 'relation',
						'span'				=> 'left',
					],
					'novembergalleryfields[media_folder]' => [
						'label'             => \Lang::get('zenware.novembergallery::lang.rainlab_blog_post.folder_label'),
						'tab' 				=> 'zenware.novembergallery::lang.rainlab_blog_post.tab_label',
						// 'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.folder_label_hint'),
						'default'           => '',
						'span'				=> 'left',
						'type'              => 'dropdown',
						'deferredBinding' => 'true',
						'placeholder'       => \Lang::get('zenware.novembergallery::lang.component_properties.folder_label_placeholder'),
						'options'		     => $options
					],
				]);
			});
		}

		// Check if we are currently in backend module.
		if (App::runningInBackend()) {
			// Listen for `backend.page.beforeDisplay` event and inject js to current controller instance.
			Event::listen('backend.page.beforeDisplay', function ($controller, $action, $params) {
				if ($controller instanceof \System\Controllers\Settings && is_array($params) && implode('.', $params) === 'zenware.novembergallery.settings') {
					$controller->addJs('/plugins/zenware/novembergallery/assets/js/novembergallery-backend.js');
				}
			});
		}
	}
}
