<?php 
namespace ZenWare\NovemberGallery\Models;

use Model;

//https://octobercms.com/docs/api/system/behaviors/settingsmodel
class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];
    
    // Path to media
    public $mediaPath = '';

    // A unique code
    public $settingsCode = 'zensoft_novembergallery_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    /**
     * Initialize properties
     */
    public function __construct(){
        $this->mediaPath = storage_path() . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "media";
        parent::__construct();
    }

    /**
     * Set default settings data, necessary in addition to setting defaults in fields.yaml
     * See https://github.com/octobercms/october/issues/2094
     * > The `default` value controls the form field, when the form renders as a user 
     * > interface (when the `<input />` is displayed). It does not control the PHP API 
     * > (via the `::get` call), so this is expected.
     * https://stackoverflow.com/questions/37640717/setting-a-default-value-on-settings-form-return-null-in-octobercms
     */
    public function initSettingsData()
    {
        // $this->base_folder = "/assets";
        // $this->allowed_extensions3 = 'ogv';
		$this->inject_unitegallery_js = true;
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
	
	public function getBaseVideoFolderOptions($value, $formData)
    {
		return $this->getBaseFolderOptions($value, $formData);
	}

    /*
    protected $casts = [
        'default_offset_x' => 'integer',
        'default_offset_y' => 'integer',
        'default_quality'  => 'integer',
        'default_sharpen'  => 'integer'
    ];
    public $rules = [
        'default_quality'           => 'integer|between:0,100',
        'default_sharpen'           => 'integer|between:0,100',
        'tinypng_developer_key'     => 'required_if:enable_tinypng,1'
    ];
    public $customMessages = [];
    public function __construct(){
        $this->customMessages['valid_tinypng_key'] = Lang::get('toughdeveloper.imageresizer::lang.settings.tinypng_invalid_key');
        parent::__construct();
    }
    public function beforeValidate()
    {
        if ($this->enable_tinypng == 1) {
            $this->rules['tinypng_developer_key'] .= '|valid_tinypng_key';
        }
    }
    // Default setting data
    public function initSettingsData()
    {
        $this->default_extension = 'auto';
        $this->default_mode = 'auto';
        $this->default_offset_x = 0;
        $this->default_offset_y = 0;
        $this->default_quality = 95;
        $this->default_sharpen = 0;
    }
    */
}