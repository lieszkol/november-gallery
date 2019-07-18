<?php 
namespace ZenWare\NovemberGallery\Classes;

use ZenWare\NovemberGallery\Models\Settings;
use ToughDeveloper\ImageResizer\Classes\Image;
use Config;
// use Debugbar;

/**
 * GalleryItem Model
 */
class GalleryItem
{
	private $component;

    public $file;

	/**
     * @var string Base name of the file, for example: picture-1.jpg
	 * See: https://www.php.net/manual/en/splfileinfo.getbasename.php
     */
	public $fileBasename;

	/**
     * @var string Gets last access time of the file, for example: 1550704585
	 * See: https://www.php.net/manual/en/splfileinfo.getatime.php
     */
	public $fileATime;

	/**
     * @var string Gets the inode change time, for example: 1550704585
	 * See: https://www.php.net/manual/en/splfileinfo.getctime.php
     */
	public $fileCTime;

	/**
     * @var string Gets the file extension, for example: jpg
	 * See: https://www.php.net/manual/en/splfileinfo.getextension.php
     */
	public $fileExtension;

	/**
     * @var string Gets the filename, for example: picture-1.jpg
	 * See: https://www.php.net/manual/en/splfileinfo.getfilename.php
     */
	public $fileName;

	/**
     * @var string Gets the last modified time, for example: 1550704585
	 * See: https://www.php.net/manual/en/splfileinfo.getmtime.php
     */
	public $fileMTime;

	/**
     * @var string Gets the path without filename, for example: /var/www/mywebsite.com/public_html/storage/app/media/my-galleries/gallery-1
	 * See: https://www.php.net/manual/en/splfileinfo.getpath.php
     */
	public $filePath;

	/**
     * @var string Gets the path to the file, for example: /var/www/mywebsite.com/public_html/storage/app/media/my-galleries/gallery-1/picture-1.jpg
	 * See: https://www.php.net/manual/en/splfileinfo.getpathname.php
     */
	public $filePathname;

	/**
     * @var string Gets absolute path to file, for example: /var/www/mywebsite.com/public_html/storage/app/media/my-galleries/gallery-1/picture-1.jpg
	 * See: https://www.php.net/manual/en/splfileinfo.getrealpath.php
     */
	public $fileRealPath;

	/**
     * @var string Gets file size, in bytes, for example: 404779
	 * See: https://www.php.net/manual/en/splfileinfo.getsize.php
     */
	public $fileSize;

	/**
     * @var string Gets file type, for example: "file"
	 * See: https://www.php.net/manual/en/splfileinfo.gettype.php
     */
	public $fileType;

	/**
     * @var string Path to file relative to the media folder, for example: /my-galleries/gallery-1/picture-1.jpg
     */
	public $relativeMediaFilePath;

	/**
     * @var string Path to file relative to the website, for example: /storage/app/media/my-galleries/gallery-1/picture-1.jpg
     */
	public $relativeFilePath;

	/**
     * @var string URL to file, for example: https://www.mywebsite.com/storage/app/media/my-galleries/gallery-1/picture-1.jpg
     */
	public $url;
	
	public function __construct($file, $component)
    {
		$this->component = $component;
		$this->file = $file;
		$this->fileBasename = $file->getBasename();
		$this->fileATime = $file->getATime();
		$this->fileCTime = $file->getCTime();
		$this->fileExtension = $file->getExtension();
		$this->fileName = $file->getFilename();
		$this->fileMTime = $file->getMTime();
		$this->filePath = $file->getPath();
		$this->filePathname = $file->getPathname();
		$this->fileRealPath = $file->getRealPath();
		$this->fileSize = $file->getSize();
		$this->fileType = $file->getType();
		$this->relativeMediaFilePath = str_replace(Settings::instance()->mediaPath . DIRECTORY_SEPARATOR, '', $file->getPathname());
		$this->relativeFilePath = Config::get('cms.storage.media.path') . '/' . $this->relativeMediaFilePath;
		$this->url = url(Config::get('cms.storage.media.path') . '/' . $this->relativeMediaFilePath);
	}

	/**
	 * If plugin is configured to resize images, then return the URL of the resized image; otherwise, return the passed argument unchanged.
	 * 
	 * This is used in the \components\embeddedgallery\default.htm template.
	 */
    public function getGalleryItemSrc() 
    {
        //galleryitem | media | resize(280, false,  { mode: 'portrait', quality: '90', extension: 'png' })
		// Debugbar::info("$this->component->getThumbnailWidth(): " . $this->component->getThumbnailWidth());
		if (Settings::instance()->use_image_resizer) 
        {
            $image = new Image($this->relativeFilePath);
            // https://github.com/toughdeveloper/oc-imageresizer-plugin/blob/master/classes/Image.php
            $options = [];
			if (!empty($this->component->property('image_resizer_mode')) && $this->component->property('image_resizer_mode') !== 'default') 
			{
				$options['mode'] = $this->component->property('image_resizer_mode');
			}
			elseif (!empty(Settings::instance()->image_resizer_mode))
            {
                $options['mode'] = Settings::instance()->image_resizer_mode;
            }
			
			if (!empty(Settings::instance()->image_resizer_quality))
            {
                $options['quality'] = Settings::instance()->image_resizer_quality;
            }
       
			return $image->resize(
				$this->component->getThumbnailWidth(),
				$this->component->getThumbnailHeight(),
                $options);
        }
        else 
        {
            return $this->relativeFilePath;
        }
	}
	
	/**
     * Converts the item data to an array
     * @return array Returns the item data as array
     */
    // public function toArray()
    // {
    //     $result = [];
    //     foreach ($this->fillable as $property) {
    //         $result[$property] = $this->$property;
    //     }
    //     return $result;
    // }
}