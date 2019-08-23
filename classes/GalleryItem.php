<?php

namespace ZenWare\NovemberGallery\Classes;

use ZenWare\NovemberGallery\Models\Settings;
use System\Classes\PluginManager;
use Config;

//  use Debugbar;   // http://wiltonsoftware.nz/blog/post/debug-october-cms-plugin

/**
 * GalleryItem Model
 */
class GalleryItem
{
	/**
	 * @var \Cms\Classes\ComponentBase Component we are attached to
	 */
	private $component;

	/**
	 * @var string Image title metadata, available for images uploaded using the backend gallery page only
	 */
	public $title;

	/**
	 * @var string Description metadata, available for images uploaded using the backend gallery page only
	 */
	public $description;

	/**
	 * @var int Image sort order, available for images uploaded using the backend gallery page only
	 */
	public $sortOrder = 0;

	/**
	 * @var file Pure PHP file
	 */
	public $file;

	/**
	 * @var System\Models\File October "File" model
	 */
	public $octoberImageFile;

	/**
	 * @var string Image width, see https://www.php.net/manual/en/function.getimagesize.php
	 */
	public $width;

	/**
	 * @var string Image height, see https://www.php.net/manual/en/function.getimagesize.php
	 */
	public $height;

	/**
	 * @var string Image type, see https://www.php.net/manual/en/function.getimagesize.php
	 */
	public $type;

	/**
	 * @var string Will be "horizontal", "vertical", or "square" depending on whether the image is wider than it is tall
	 */
	public $orientation;

	/**
	 * @var string Base name of the file without extension, for example: picture-1
	 */
	public $fileNameWithoutExtension;

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
	 * @var string Gets the path without filename, for example: /var/www/mywebsite.com/public_html/storage/app/media/my-galleries/gallery-1
	 * See: https://www.php.net/manual/en/splfileinfo.getpath.php
	 */
	public $filePath;

	/**
	 * @var string Gets absolute path to file, for example: /var/www/mywebsite.com/public_html/storage/app/media/my-galleries/gallery-1/picture-1.jpg
	 * See: https://www.php.net/manual/en/splfileinfo.getrealpath.php
	 */
	public $fileRealPath;

	/**
	 * @var string Gets the path to the file, for example: /var/www/mywebsite.com/public_html/storage/app/media/my-galleries/gallery-1/picture-1.jpg
	 * See: https://www.php.net/manual/en/splfileinfo.getpathname.php
	 */
	// public $filePathname; -- Redundant!

	/**
	 * @var string Gets file size, in bytes, for example: 404779
	 * See: https://www.php.net/manual/en/splfileinfo.getsize.php
	 */
	public $fileSize;

	/**
	 * @var string Path to file relative to the website, for example: /storage/app/media/my-galleries/gallery-1/picture-1.jpg
	 */
	public $relativeFilePath;

	/**
	 * @var string Gets the time the file was uploaded (or last changed) using filemtime as a PHP DateTime object, you can then: $currentTime->format( 'c' );
	 * See: https://www.php.net/manual/en/splfileinfo.getctime.php
	 */
	public $uploaded;

	/**
	 * @var string URL to file, for example: https://www.mywebsite.com/storage/app/media/my-galleries/gallery-1/picture-1.jpg
	 */
	public $url;

	private function __construct($component)
	{
		$this->component = $component;
	}

	// https://stackoverflow.com/questions/2169448/why-cant-i-overload-constructors-in-php
	public static function createFromPhpFile($component, $file)
	{
		// List of methods available: http://php.net/manual/en/splfileinfo.getfilename.php
		$galleryItem = new GalleryItem($component);
		$galleryItem->file = $file;
		$galleryItem->fileNameWithoutExtension = $file->getBasename('.' . $file->getExtension());
		$galleryItem->fileExtension = $file->getExtension();
		$galleryItem->fileName = $file->getFilename();
		$galleryItem->filePath = $file->getPath();
		$galleryItem->fileRealPath = $file->getRealPath();
		$galleryItem->fileSize = $file->getSize();
		$relativeMediaFilePath = str_replace(Settings::instance()->mediaPath . DIRECTORY_SEPARATOR, '', $file->getRealPath());
		$galleryItem->relativeFilePath = Config::get('cms.storage.media.path') . '/' . $relativeMediaFilePath;
		$galleryItem->uploaded = \DateTime::createFromFormat('U', $file->getMTime());
		$galleryItem->url = url(Config::get('cms.storage.media.path') . '/' . $relativeMediaFilePath);

		list($galleryItem->width, $galleryItem->height, $galleryItem->type, $attr) = getimagesize($galleryItem->fileRealPath);

		if ($galleryItem->width == $galleryItem->height) {
			$galleryItem->orientation = 'square';
		} elseif ($galleryItem->width > $galleryItem->height) {
			$galleryItem->orientation = 'horizontal';
		} else {
			$galleryItem->orientation = 'vertical';
		}

		return $galleryItem;
	}


	/*
	 * https://github.com/octobercms/library/blob/master/src/Database/Attach/File.php
	 * Also see: https://octobercms.com/docs/database/attachments
	 * https://octobercms.com/docs/database/model#file-attachments
	 * 
	 * System\Models\File {#2747
	 * 	#table: "system_files"
	 * 	+attributes: array:14 [
	 * 		"id" => 404
	 * 		"disk_name" => "5d484a03960a1707954439.jpg"
	 * 		"file_name" => "1014D165M.jpg"
	 * 		"file_size" => 297070
	 * 		"content_type" => "image/jpeg"
	 * 		"title" => "Ki nem élvez egy kis hintózást? És a nagy nap közepén az út egy percnyi pihenést nyújthat a lagzi kezdete előtt."
	 * 		"description" => ""
	 * 		"field" => "images"
	 * 		"attachment_id" => "1"
	 * 		"attachment_type" => "ZenWare\NovemberGallery\Models\Gallery"
	 * 		"is_public" => 1
	 * 		"sort_order" => 1
	 * 		"created_at" => "2019-08-05 15:23:47"
	 * 		"updated_at" => "2019-08-13 20:24:27"
	 * 	]
	 * 	}
	 */
	public static function createFromOctoberImageFile($component, $octoberImageFile)
	{
		$galleryItem = new GalleryItem($component);
		$galleryItem->octoberImageFile = $octoberImageFile;
		$galleryItem->fileNameWithoutExtension = substr($octoberImageFile->disk_name, 0, strlen($octoberImageFile->disk_name) - strlen($octoberImageFile->getExtension()) - 1);
		$galleryItem->fileExtension = $octoberImageFile->getExtension();	// "jpg"
		$galleryItem->fileName = $octoberImageFile->disk_name;
		$galleryItem->filePath = substr($octoberImageFile->getLocalPath(), 0, strlen($octoberImageFile->getLocalPath()) - strlen($octoberImageFile->disk_name) - 1);
		$galleryItem->fileRealPath = $octoberImageFile->getLocalPath();	// "/var/www/yesinbudapest.com/public_html/storage/app/uploads/public/5d4/84a/039/5d484a03960a1707954439.jpg"
		$galleryItem->fileSize = $octoberImageFile->file_size;
		$galleryItem->relativeFilePath = Config::get('cms.storage.uploads.path') . '/' . substr($octoberImageFile->getLocalPath(), strlen(storage_path('app/uploads/')));	// /storage/app/media/my-galleries/gallery-1/picture-1.jpg
		$galleryItem->uploaded = new \DateTime($octoberImageFile->created_at->toDateTimeString());	// created_at is "Argon": https://octobercms.com/docs/api/october/rain/argon/argon
		$galleryItem->url = $octoberImageFile->getPath();		// "https://www.yesinbudapest.com/storage/app/uploads/public/5d4/84a/039/5d484a03960a1707954439.jpg"
		$galleryItem->title = $octoberImageFile->title;
		$galleryItem->description = $octoberImageFile->description;
		$galleryItem->sortOrder = $octoberImageFile->sort_order;
		// Debugbar::info(new \DateTime($octoberImageFile->created_at->toDateTimeString()));

		list($galleryItem->width, $galleryItem->height, $galleryItem->type, $attr) = getimagesize($galleryItem->fileRealPath);
		if ($galleryItem->width == $galleryItem->height) {
			$galleryItem->orientation = 'square';
		} elseif ($galleryItem->width > $galleryItem->height) {
			$galleryItem->orientation = 'horizontal';
		} else {
			$galleryItem->orientation = 'vertical';
		}


		return $galleryItem;
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

		$pluginManager = PluginManager::instance()->findByIdentifier('ToughDeveloper.ImageResizer');
		if (Settings::instance()->use_image_resizer && $pluginManager && !$pluginManager->disabled) {
			$image = new \ToughDeveloper\ImageResizer\Classes\Image($this->relativeFilePath);
			// https://github.com/toughdeveloper/oc-imageresizer-plugin/blob/master/classes/Image.php
			$options = [];
			if (!empty($this->component->property('imageResizerMode')) && $this->component->property('imageResizerMode') !== 'default') {
				$options['mode'] = $this->component->property('imageResizerMode');
			} elseif (!empty(Settings::instance()->image_resizer_mode)) {
				$options['mode'] = Settings::instance()->image_resizer_mode;
			}

			if (!empty(Settings::instance()->image_resizer_quality)) {
				$options['quality'] = Settings::instance()->image_resizer_quality;
			}

			return $image->resize(
				$this->component->getThumbnailWidth(),
				$this->component->getThumbnailHeight(),
				$options
			);
		} elseif (isset($this->octoberImageFile)) {
			return $this->octoberImageFile->getThumb($this->component->getThumbnailWidth(), $this->component->getThumbnailHeight(), ['mode' => 'crop']);
		} else {
			return $this->relativeFilePath;
		}
	}

	/**
	 * Converts the item data to an array, enables end-users to do
	 * {{ dump(embeddedGallery.gallery.items.first.toArray) }} or
	 * {{ debug(embeddedGallery.gallery.items.first.toArray) }} (with debugbar installed)
	 * @return array Returns the item data as array
	 */
	public function toArray()
	{
		// This alternate approach also seems to return private properties such as $this->component:
		// https://vancelucas.com/blog/get-only-public-class-properties-for-the-current-class-in-php/
		// $getFields = function($obj) { return get_object_vars($obj); };
		// return $getFields($this);

		$result = [];
		// From https://stackoverflow.com/questions/13124072/how-to-programmatically-find-public-properties-of-a-class-from-inside-one-of-it:
		$properties = (new \ReflectionObject($this))->getProperties(\ReflectionProperty::IS_PUBLIC);
		foreach ($properties as $property) {
			$propertyName = $property->name;
			$result[$propertyName] = $this->$propertyName;
		}
		return $result;
	}
}
