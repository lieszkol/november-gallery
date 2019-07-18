<?php
namespace ZenWare\NovemberGallery\Components;

use Cms\Classes\ComponentBase;
use ZenWare\NovemberGallery\Models\Settings;
use ToughDeveloper\ImageResizer\Classes\Image;
// use Debugbar;   // http://wiltonsoftware.nz/blog/post/debug-october-cms-plugin
use ZenWare\NovemberGallery\Classes\GalleryItem;
use October\Rain\Support\Collection;
use Config;
abstract class NovemberGalleryComponentBase extends ComponentBase {

    public $galleryitems;
	public $defaultgalleryoptions;
	public $defaultlightboxoptions;
	public $customgalleryscript;
	public $customlightboxscript;
    public $allowedExtensions = array();
    public $error;

    /**
     * Please override this!
     * 
     * @return array ['name' => '...', 'description' => '...']
     */
    abstract public function componentDetails();

    /**
     * Configuration options that can be set on the component properties page after 
     * being dropped into a CMS page.
     * 
     * @return array Component properties page configuration options
     */
    public function defineProperties()
    {
    
        return [
            'maxItems' => [
                 'title'             => 'Max Images',
                 'description'       => 'The maximum number of images to display',
                 'default'           => 100,
                 'type'              => 'string',
                 'validationPattern' => '^[0-9]+$',
                 'validationMessage' => 'The Max Images property can only contain numbers!'
            ]
        ];
    }

    /**
     * Set proprety defaults, such as allowed extensions, and load the list of images to display.
     */
    public function onRun() {
        $this->addCss('assets/css/novembergallery.css');
		
		if (Settings::instance()->inject_jquery) 
		{
	    	$this->addJs('//cdn.jsdelivr.net/npm/jquery@3/dist/jquery.min.js');
		}

        $this->allowedExtensions = array();
        if (Settings::instance()->allowed_extensions_jpg)
        {
            $this->allowedExtensions[] = 'jpg';
            $this->allowedExtensions[] = 'jpeg';
        }
        if (Settings::instance()->allowed_extensions_gif)
        {
            $this->allowedExtensions[] = 'gif';
        }
        if (Settings::instance()->allowed_extensions_png)
        {
            $this->allowedExtensions[] = 'png';
        }
		// Debugbar::info("NovemberGallery allowed extensions is: " . \implode('|', $this->allowedExtensions));
		// Debugbar::info("Config::get('cms.storage.uploads.path') = " . Config::get('cms.storage.uploads.path'));
		// Debugbar::info("Config::get('cms.storage.media.path') = " . Config::get('cms.storage.media.path'));
		// Debugbar::info("url(Config::get('cms.storage.media.path')) = " . url(Config::get('cms.storage.media.path')));
        
		$this->galleryitems = $this->loadMedia();
		
		$this->defaultgalleryoptions = $this->getDefaultGalleryOptions();

		$this->defaultlightboxoptions = $this->getDefaultLightboxOptions();

		if (Settings::instance()->custom_gallery_script && !empty(Settings::instance()->default_gallery_options))
		{
			$this->customgalleryscript = Settings::instance()->default_gallery_options;
		}

		if (Settings::instance()->custom_lightbox_script_enabled && !empty(Settings::instance()->custom_lightbox_script))
		{
			$this->customlightboxscript = Settings::instance()->custom_lightbox_script;
		}
	}

     /**
     * Retrieve the full path to the gallery taking into account the base folder selected 
     * in the backend NovemberGallery settings page.
	 * 
	 * This can be called from the front-end with: {{ __SELF__.galleryPath() }}
     * 
     * @return string Path to the gallery of images to display
     */
    protected function getGalleryPath() {
		$galleryPath = Settings::instance()->mediaPath;
		
        if (!empty(Settings::instance()->base_folder)) {
            $galleryPath .= Settings::instance()->base_folder;
        }
		
        if (!empty($this->property('mediaFolder'))) {
            $galleryPath .= DIRECTORY_SEPARATOR . $this->property('mediaFolder');
		}

        return $galleryPath;
	}
	
	/**
     * Get default options used in the default.htm layout for initialising the gallery.
     */
    public function getDefaultGalleryOptions() {
		$additionalOptions = '';

		if (!empty($this->property('additional_gallery_options'))) 
		{
			$additionalOptions = $this->property('additional_gallery_options');
		}
		$additionalOptions = rtrim($additionalOptions, ',');
		if (!empty($additionalOptions)) {
			$additionalOptions = $additionalOptions . ',';
		}

		switch($this->getGalleryLayout()) 
		{
			case 'gallery_tiles':
				switch($this->getTilesLayout()) 
				{
					case 'gallery_tiles_columns':
						if ($this->getThumbnailWidth() !== false) $additionalOptions = 'tiles_col_width: ' . $this->getThumbnailWidth() . ',' . $additionalOptions;
						return 'gallery_theme: "tiles",' . $additionalOptions;
					case 'gallery_tiles_justified': 
						if ($this->getThumbnailHeight() !== false) $additionalOptions = 'tiles_justified_row_height: ' . $this->getThumbnailHeight() . ',' . $additionalOptions;
						return 'gallery_theme: "tiles",	tiles_type: "justified",' . $additionalOptions;
					case 'gallery_tiles_nested': 
						if ($this->getThumbnailWidth() !== false) $additionalOptions = 'tiles_nested_optimal_tile_width: ' . $this->getThumbnailWidth() . ',' . $additionalOptions;
						return 'gallery_theme: "tiles",	tiles_type: "nested",' . $additionalOptions;
					case 'gallery_tiles_grid':
						if ($this->getThumbnailWidth() !== false) $additionalOptions = 'tile_width: ' . $this->getThumbnailWidth() . ',' . $additionalOptions;
						if ($this->getThumbnailHeight() !== false) $additionalOptions = 'tile_height: ' . $this->getThumbnailHeight() . ',' . $additionalOptions;
						return 'gallery_theme: "tilesgrid",' . $additionalOptions;
				}
				break;
			case 'gallery_carousel':
				if ($this->getThumbnailWidth() !== false) $additionalOptions = 'tile_width: ' . $this->getThumbnailWidth() . ',' . $additionalOptions;
				if ($this->getThumbnailHeight() !== false) $additionalOptions = 'tile_height: ' . $this->getThumbnailHeight() . ',' . $additionalOptions;
				return 'gallery_theme: "carousel",' . $additionalOptions;
			case 'gallery_combined':
				switch($this->getCombinedLayout()) 
				{
					case 'gallery_combined_default': 
						if ($this->getThumbnailWidth() !== false) $additionalOptions = 'thumb_width: ' . $this->getThumbnailWidth() . ',' . $additionalOptions;
						if ($this->getThumbnailHeight() !== false) $additionalOptions = 'thumb_height: ' . $this->getThumbnailHeight() . ',' . $additionalOptions;
						return  $additionalOptions;
					case 'gallery_combined_compact': 
						if ($this->getThumbnailWidth() !== false) $additionalOptions = 'thumb_width: ' . $this->getThumbnailWidth() . ',' . $additionalOptions;
						if ($this->getThumbnailHeight() !== false) $additionalOptions = 'thumb_height: ' . $this->getThumbnailHeight() . ',' . $additionalOptions;
						return 'gallery_theme: "compact",' . $additionalOptions;
					case 'gallery_combined_grid':
						if ($this->getThumbnailWidth() !== false) $additionalOptions = 'thumb_width: ' . $this->getThumbnailWidth() . ',' . $additionalOptions;
						if ($this->getThumbnailHeight() !== false) $additionalOptions = 'thumb_height: ' . $this->getThumbnailHeight() . ',' . $additionalOptions;
						return 'gallery_theme: "grid",' . $additionalOptions;
				}
				break;
			case 'gallery_slider':
				return 'gallery_theme: "slider",' . $additionalOptions;
			case 'gallery_video':
				return 'gallery_theme: "video",' . $additionalOptions;
		}
		return '';
	}

	/**
     * Get default options used in the default.htm layout for initialising the lightbox.
     */
    public function getDefaultLightboxOptions() {
		$additionalOptions = '';

		if (!empty($this->property('additional_lightbox_options'))) 
		{
			$additionalOptions = $this->property('additional_lightbox_options');
		}
		$additionalOptions = rtrim($additionalOptions, ',');
		$additionalOptions = $additionalOptions . ',';

		return 'gallery_theme: "lightbox",' . $additionalOptions;
	}

	/** 
	 * Get the width of the thumbnails for this gallery.
	 */
	public function getThumbnailWidth() {
		$width = false;
		if (!empty($this->property('image_resizer_width'))) 
		{
			$width = $this->property('image_resizer_width');
		} 
		elseif (empty($this->property('image_resizer_height')) && !empty(Settings::instance()->image_resizer_width))
		{
			$width = Settings::instance()->image_resizer_width;
		}
		return $width;
	}

	/** 
	 * Get the height of the thumbnails for this gallery.
	 */
	public function getThumbnailHeight() {
		$height = false;
		if (!empty($this->property('image_resizer_height'))) 
		{
			$height = $this->property('image_resizer_height');
		} 
		elseif (empty($this->property('image_resizer_width')) && !empty(Settings::instance()->image_resizer_height)) 
		{
			$height = Settings::instance()->image_resizer_height;
		}
		return $height;
	}

    /**
     * Retrieve a list of all gallery items (images and videos) under the gallery path.
     * 
     * @return array Array of filenames (with extension, without path)
     */
    function loadMedia()
    {
        $galleryPath = $this->getGalleryPath();
        // Debugbar::info("NovemberGallery MediaPath is: {$galleryPath}");

        if (!\File::exists($galleryPath)) {
            $this->error = "NovemberGallery error: cannot find the path " . $galleryPath;
            return array();
        }

        $extensions = $this->allowedExtensions;
        $maxImages = $this->property('maxItems', 100);
        // end of options!    
        
        $files     = \File::allFiles($galleryPath);
        // Debugbar::info("NovemberGallery found files: " . count($files));
        $images     = new Collection();
        $i = 1;
        foreach ($files as $file) {
            if ($file->isFile() && $file->isReadable() && in_array ($file->getExtension(), $extensions)) {
                // List of methods available: http://php.net/manual/en/splfileinfo.getfilename.php
                $images->push(new GalleryItem($file, $this));
            }
            if ($i >= $maxImages) break;
            $i++;
        }    
        return $images; 
    }

    /**
     * Retrieve a list of folders under the "Base Media Folder" as set on the 
     * plugin backend settings page. The user can select from this list of folders 
     * in the component properties page after being dropped into a CMS page.
     * 
	 * See "Dropdown properties" in https://octobercms.com/docs/plugin/components#component-properties
	 * 
     * @return array List of folders
     */
    public function getMediaFolderOptions()
    {
        $mediaPath = Settings::instance()->mediaPath;
        if (!empty(Settings::instance()->base_folder)) {
            $mediaPath .= Settings::instance()->base_folder;
        }

        // https://laravel.com/api/5.7/Illuminate/Contracts/Filesystem/Filesystem.html#method_allDirectories
        $directories = \File::directories($mediaPath);

        // https://laravel.com/docs/5.7/collections
        // https://hotexamples.com/site/file?hash=0xbf04831db113aec866fc4024ff9bb7faaa2503700d9125560cc67bea8cd6b2cb&fullName=src/MediaManager.php&project=talv86/easel
        $matches = collect($directories)->reduce(function ($allDirectories, $directory) use ($mediaPath) {
            $relativePath = str_replace(@"{$mediaPath}" . DIRECTORY_SEPARATOR, '', $directory);
            $allDirectories[$relativePath] = $relativePath;
            return $allDirectories;
        }, collect())->sort()->toArray();

        if (count($matches) == 0) {
            if (!empty(Settings::instance()->base_folder)) {
                return [DIRECTORY_SEPARATOR => "Your base folder (" . Settings::instance()->base_folder . ") does not contain any subfolders!"];
            }
            return [DIRECTORY_SEPARATOR => "Create folders for your media first!"];
        }
        return $matches;
    }

	public function getTilesLayoutOptions()
	{
		if (\Request::input('galleryLayout') === 'gallery_tiles') {
			return [
				'default' => \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
				'gallery_tiles_columns'=> \Lang::get('zenware.novembergallery::lang.settings.gallery_tiles_layout_columns'),
                'gallery_tiles_justified'=> \Lang::get('zenware.novembergallery::lang.settings.gallery_tiles_layout_justified'),
                'gallery_tiles_nested'=> \Lang::get('zenware.novembergallery::lang.settings.gallery_tiles_layout_nested'),
                'gallery_tiles_grid'=> \Lang::get('zenware.novembergallery::lang.settings.gallery_tiles_layout_grid')
			];
		}
		
		return [
			'not_applicable' => \Lang::get('zenware.novembergallery::lang.miscellanous.not_applicable')
		];
	}

	public function getCombinedLayoutOptions()
	{
		if (\Request::input('galleryLayout') === 'gallery_combined') {
			return [
				'default' => \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
				'gallery_combined_default'=> \Lang::get('zenware.novembergallery::lang.settings.gallery_combined_layout_default'),
                'gallery_combined_compact'=> \Lang::get('zenware.novembergallery::lang.settings.gallery_combined_layout_compact'),
                'gallery_combined_grid'=> \Lang::get('zenware.novembergallery::lang.settings.gallery_combined_layout_grid')
			];
		}
		
		return [
			'not_applicable' => \Lang::get('zenware.novembergallery::lang.miscellanous.not_applicable')
		];
	}

	public function getGalleryLayout() 
	{
		$galleryLayout = 'gallery_tiles';
		if (!empty($this->property('galleryLayout')) && $this->property('galleryLayout') !== 'not_applicable' && $this->property('galleryLayout') !== 'default') 
		{
			$galleryLayout = $this->property('galleryLayout');
		}
		elseif (!empty(Settings::instance()->default_gallery))
		{
			$galleryLayout = Settings::instance()->default_gallery;
		}
		return $galleryLayout;
	}

	public function getTilesLayout() 
	{
		if (!empty($this->property('tilesLayout')) && $this->property('tilesLayout') !== 'not_applicable' && $this->property('tilesLayout') !== 'default') 
		{
			return $tilesLayout = $this->property('tilesLayout');
		}
		elseif (!empty(Settings::instance()->gallery_tiles_layout))
		{
			return Settings::instance()->gallery_tiles_layout;
		}
		return 'gallery_tiles_columns';
	}

	public function getCombinedLayout() 
	{
		if (!empty($this->property('combinedLayout')) && $this->property('combinedLayout') !== 'not_applicable' && $this->property('combinedLayout') !== 'default') 
		{
			return $this->property('combinedLayout');
		}
		elseif (!empty(Settings::instance()->gallery_combined_layout))
		{
			return Settings::instance()->gallery_combined_layout;
		}
		return 'gallery_combined_default';
	}
}