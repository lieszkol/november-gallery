<?php 

namespace ZenWare\NovemberGallery;

use System\Classes\PluginBase;
use App;
use Event;
use BackendMenu;
use Backend;
// use Debugbar;   // http://wiltonsoftware.nz/blog/post/debug-october-cms-plugin



use BackendAuth;
use Controller;
use Config;
use System\Classes\PluginManager;
use JanVince\SmallRecords\Models\Settings;
use JanVince\SmallRecords\Models\Area;
use JanVince\SmallRecords\Models\Record;
use JanVince\SmallRecords\Controllers\Records;

class Plugin extends PluginBase
{
    public $require = ['ToughDeveloper.ImageResizer'];

    /**
     * Registers all components provided by this blugin.
     *
     * @return array Component path => component name
     */
     public function registerComponents()
    {
        return [
            'ZenWare\NovemberGallery\Components\EmbeddedGallery' => 'embeddedGallery',
            'ZenWare\NovemberGallery\Components\PopupGallery' => 'popupLightbox',
            'ZenWare\NovemberGallery\Components\CustomGallery' => 'customGallery',
            'ZenWare\NovemberGallery\Components\VideoGallery' => 'videoGallery'
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
            'ZenWare\NovemberGallery\Components\PopupGallery' => 'popupLightbox',
            'ZenWare\NovemberGallery\Components\VideoGallery' => 'videoGallery'
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
	
	public function registerNavigation()
	{
		return [
			'novembergallery' => [
				'label'       => 'zenware.novembergallery::lang.menu.bacendmenuitem_label',
				'url'         => Backend::url('zenware/novembergallery/galleries'),
				'icon'        => 'icon-camera-retro',
				'permissions' => ['zenware.novembergallery.*'],
				'order'       => 99,
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
            'strong' => function($value) { return '<strong>'. $value . '</strong>'; },
            // 'text_preview' => function($value) { $content = mb_substr(strip_tags($value), 0, 150); if(mb_strlen($content) > 150) { return ($content . '...'); } else { return $content; } },
            // 'html_text_preview' => function($value) { return strip_tags(nl2br($value), '<br>'); },
            // 'array_preview' => function($value) { $content = mb_substr(strip_tags( implode(' --- ', $value) ), 0, 150); if(mb_strlen($content) > 150) { return ($content . '...'); } else { return $content; } },
            // 'switch_icon_star' => function($value) { return '<div class="text-center"><span class="'. ($value==1 ? 'oc-icon-circle text-success' : 'text-muted oc-icon-circle text-draft') .'">' . ($value==1 ? e(trans('janvince.smallcontactform::lang.models.message.columns.new')) : e(trans('janvince.smallcontactform::lang.models.message.columns.read')) ) . '</span></div>'; },
            // 'switch_extended_input' => function($value) { if($value){return '<span class="list-badge badge-success"><span class="icon-check"></span></span>';} else { return '<span class="list-badge badge-danger"><span class="icon-minus"></span></span>';} },
            'switch_extended' => function($value) { if($value){return '<span class="list-badge badge-success"><span class="icon-check"></span></span>';} else { return '<span class="list-badge badge-danger"><span class="icon-minus"></span></span>';} },
            'attached_images_count' => function($value){ return (  count($value) ? count($value) : 1); },
            'record_image_preview' => function($value) {
                // $width = Settings::get('records_list_preview_width', 50);
                // $height = Settings::get('records_list_preview_height', 50);
				$width = 100;
				$height = 100;
                if($value){ return "<img src='".$value->getThumb($width, $height)."' style='width: auto; height: auto; max-width: ".$width."px; max-height: ".$height."px'>"; }
            },
            // 'record_image_preview_media' => function($value) use ($mediaPath) {
            //     $width = Settings::get('records_list_preview_width', 50);
            //     $height = Settings::get('records_list_preview_height', 50);
            //     if($value)
            //     {
            //         return "<img src='".$mediaPath.$value."' style='width: auto; height: auto; max-width: ".$width."px; max-height: ".$height."px'>";
            //     }
            // },
            // 'tags_names' => function($values){ $names = []; if( $values->count() > 0 ) { foreach($values as $value) { $names[] = $value->name; } } return implode(', ', $names); },
        ];
    }

    /**
     * Load backend js scripts when opening the settings page.
     * https://octobercms.com/forum/post/how-to-add-javascript-file-to-backend-pages
     */
    public function boot()
    {
        // Check if we are currently in backend module.
        if (!App::runningInBackend()) {
            return;
        }

        // Listen for `backend.page.beforeDisplay` event and inject js to current controller instance.
        Event::listen('backend.page.beforeDisplay', function($controller, $action, $params) {
            if ($controller instanceof \System\Controllers\Settings && is_array($params) && implode('.', $params) === 'zenware.novembergallery.settings') {
                $controller->addJs('/plugins/zenware/novembergallery/assets/js/novembergallery-backend.js');
            }    
        });
    }
}
