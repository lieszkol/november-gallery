<?php namespace ZenWare\NovemberGallery;

use System\Classes\PluginBase;
use App;
use Event;
use Debugbar;
use BackendMenu;

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
            'ZenWare\NovemberGallery\Components\CustomGallery' => 'customGallery'
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
                'label' => 'zenware.novembergallery::lang.permission.label'
            ]
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
