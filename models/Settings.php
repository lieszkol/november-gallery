<?php

namespace ZenWare\NovemberGallery\Models;

use October\Rain\Support\Collection;
use System\Classes\PluginManager;
use Model;

//https://octobercms.com/docs/api/system/behaviors/settingsmodel
class Settings extends Model
{
	public $implement = [
		\System\Behaviors\SettingsModel::class
	];

	// Path to media
	public $mediaPath = '';

	// A unique code
	public $settingsCode = 'zensoft_novembergallery_settings';

	// Reference to field configuration
	public $settingsFields = 'fields.yaml';

	/**
	 * Initialize properties
	 */
	public function __construct()
	{
		$this->mediaPath = storage_path() . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "media";
		parent::__construct();
	}

	/**
     * Initialize the seed data for this model. This only executes when the
     * model is first created or reset to default.
	 * 
	 * Set default settings data, necessary in addition to setting defaults in fields.yaml
	 * See https://github.com/octobercms/october/issues/2094
	 * > The `default` value controls the form field, when the form renders as a user 
	 * > interface (when the `<input />` is displayed). It does not control the PHP API 
	 * > (via the `::get` call), so this is expected.
	 * https://stackoverflow.com/questions/37640717/setting-a-default-value-on-settings-form-return-null-in-octobercms
	 * 
     * @return void
	 */
	public function initSettingsData()
	{
		// $this->base_folder = "/assets";
		// $this->allowed_extensions3 = 'ogv';
		$this->default_gallery = 'gallery_tiles';
		$this->default_gallery_tiles_layout = 'gallery_tiles_columns';
		$this->gallery_combined_layout = 'gallery_combined_default';
		$this->custom_gallery_script_enabled = false;
		$this->default_gallery_options = 'jQuery("#gallery").unitegallery({});';
		$this->default_swiper_effect = 'slide';
		$this->custom_lightbox_script_enabled = false;
		$this->custom_lightbox_script = 'jQuery("#gallery").unitegallery({});';
		$this->base_video_folder = '<inherit>';
		$this->default_video_gallery_layout = 'video_gallery_right_thumb';
		$this->custom_video_gallery_script_enabled = false;
		$this->custom_video_gallery_script = 'jQuery("#gallery").unitegallery({});';
		$this->base_blogmedia_folder = '<inherit>';
		$this->image_resizer_width = 200;
		$this->use_image_resizer = true;
		$this->image_resizer_mode = 'auto';
		$this->image_resizer_quality = 95;
		$this->allowed_extensions_jpg = true;
		$this->allowed_extensions_gif = true;
		$this->allowed_extensions_png = true;
		$this->inject_unitegallery_assets = true;
		$this->inject_swiper_assets = true;
		$this->inject_jquery = true;

		$this->inject_unitegallery_js = true;
	}

	public function filterFields($fields, $context = null)
    {
		if ($fields->use_image_resizer) {
			$pluginManager = PluginManager::instance()->findByIdentifier('ToughDeveloper.ImageResizer');
			if (!$pluginManager || $pluginManager->disabled) {
				// $fields->use_image_resizer->readOnly = true;
				$fields->image_resizer_disabled_hint->hidden = false;
				$fields->use_image_resizer->hidden = true;
				$fields->image_resizer_mode->hidden = true;
				$fields->image_resizer_quality->hidden = true;
			}
		}
    }

	/**
	 * Retrieve a list of folders in the project Media Manager to populate the "Base Media Folder" 
	 * drop-down in the November Gallery backend settings page.
	 * 
	 * @return array List of folders
	 */
	public function getBaseFolderOptions($value, $formData)
	{
		$mediaPath = $this->mediaPath;
		$mediaPathParts = count(explode(DIRECTORY_SEPARATOR, $mediaPath));

		// https://laravel.com/api/5.7/Illuminate/Contracts/Filesystem/Filesystem.html#method_allDirectories
		$directories = \File::directories($mediaPath);

		// https://laravel.com/docs/5.7/collections
		// https://hotexamples.com/site/file?hash=0xbf04831db113aec866fc4024ff9bb7faaa2503700d9125560cc67bea8cd6b2cb&fullName=src/MediaManager.php&project=talv86/easel
		return collect($directories)->map(function ($directory) {
			return DIRECTORY_SEPARATOR . $directory;
		})->reduce(function ($allDirectories, $directory) use ($mediaPath, $mediaPathParts) {
			$parts = explode(DIRECTORY_SEPARATOR, $directory);
			$name = str_repeat('&nbsp;', (count($parts) - $mediaPathParts) * 3) . basename($directory);

			$relativePath = str_replace(@"{$mediaPath}" . DIRECTORY_SEPARATOR, '', $directory);
			$allDirectories[$relativePath] = $relativePath;
			return $allDirectories;
		}, collect())->sort(); //->prepend('Library', '/');
	}

	/**
	 * Video folder options depend on what subfolders exist underneath the base video folder.
	 * 
	 * @return array List of folders
	 */
	public function getBaseVideoFolderOptions($value, $formData)
	{
		$options     = new Collection();
		$options->put('<inherit>', \Lang::get('zenware.novembergallery::lang.settings.base_video_folder_sameasimagegalleryoption'));
		$options = $options->merge($this->getBaseFolderOptions($value, $formData));
		return $options->toArray();
	}

	/**
	 * Blog media folder options depend on what subfolders exist underneath the base blog media folder.
	 * 
	 * @return array List of folders
	 */
	public function getBaseBlogmediaFolderOptions($value, $formData)
	{
		$options     = new Collection();
		$options->put('<inherit>', \Lang::get('zenware.novembergallery::lang.settings.base_blogmedia_folder_sameasimagegalleryoption'));
		$options = $options->merge($this->getBaseFolderOptions($value, $formData));
		return $options->toArray();
	}

	/*
    protected $casts = [
        'image_resizer_width' => 'integer',
    ];
    public $rules = [
        'image_resizer_quality'           => 'integer|between:0,100',
    ];
    public $customMessages = [];
    public function __construct(){
        $this->customMessages['...'] = Lang::get('...');
        parent::__construct();
    }
    public function beforeValidate()
    {
        if ($this->enable_tinypng == 1) {
            $this->rules['...'] .= '|...';
        }
    }
    */
}
