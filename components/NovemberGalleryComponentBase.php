<?php

namespace ZenWare\NovemberGallery\Components;

use Cms\Classes\ComponentBase;
use ZenWare\NovemberGallery\NovemberHelper;
use ZenWare\NovemberGallery\Models\Settings;
use ZenWare\NovemberGallery\Models\Gallery as Galleries;
use System\Classes\PluginManager;
use ZenWare\NovemberGallery\Classes\GalleryItem;
use ZenWare\NovemberGallery\Classes\Gallery;
use October\Rain\Support\Collection;
use Illuminate\Support\Str;

//    use Debugbar;   // http://wiltonsoftware.nz/blog/post/debug-october-cms-plugin

abstract class NovemberGalleryComponentBase extends ComponentBase
{

	public $gallery;

	private $galleryRow;

	public $allowedExtensions = array();

	public $error;

	/**
	 * Please override this!
	 * 
	 * @return array ['name' => '...', 'description' => '...']
	 */
	// This is already declared in ComponentBase.php, so do not redeclare it, 
	// doing so causes a bug in previous versions of php.
	// abstract public function componentDetails();

	/**
	 * Inject gallery scripts and styles. This should be overridden on the component implementation level.
	 */
	abstract public function InjectScripts();

	/**
	 * Configuration options that can be set on the component properties page after 
	 * being dropped into a CMS page.
	 * 
	 * @return array Component properties page configuration options
	 */
	public function defineProperties()
	{

		return [
			'mediaFolder' => [
				'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.folder_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.folder_label_hint'),
				'default'           => '',
				'type'              => 'dropdown',
				'placeholder'       => \Lang::get('zenware.novembergallery::lang.component_properties.folder_label_placeholder'),
				// 'validationPattern' => '^[a-zA-Z0-9$\-_.+!*\'(),/]+$',   // https://perishablepress.com/stop-using-unsafe-characters-in-urls/
				// 'validationMessage' => \Lang::get('zenware.novembergallery::lang.component_properties.folder_label_validation_message'),
			],
			'maxItems' => [
				'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.max_items_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.max_items_hint'),
				'default'           => 100,
				'type'              => 'string',
				'validationPattern' => '^[0-9]+$',
				'validationMessage' => \Lang::get('zenware.novembergallery::lang.component_properties.max_items_validation'),
			],
			'sortBy' => [
				'title'       => \Lang::get('zenware.novembergallery::lang.component_properties.order_images_by_label'),
				'description' => \Lang::get('zenware.novembergallery::lang.component_properties.order_images_by_label_hint'),
				'type'        => 'dropdown',
				'placeholder' => \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
				'options'     => [
					'default' => \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
					'title' => \Lang::get('zenware.novembergallery::lang.component_properties.order_images_by_option_title'),
					'titleDESC' => \Lang::get('zenware.novembergallery::lang.component_properties.order_images_by_option_title')
						. ' ' . \Lang::get('zenware.novembergallery::lang.miscellanous.sort_descending_string'),
					'description' => \Lang::get('zenware.novembergallery::lang.component_properties.order_images_by_option_description'),
					'descriptionDESC' => \Lang::get('zenware.novembergallery::lang.component_properties.order_images_by_option_description')
						. ' ' . \Lang::get('zenware.novembergallery::lang.miscellanous.sort_descending_string'),
					'sortOrder' => \Lang::get('zenware.novembergallery::lang.component_properties.order_images_by_option_sort_order'),
					'width' => \Lang::get('zenware.novembergallery::lang.component_properties.order_images_by_option_width'),
					'widthDESC' => \Lang::get('zenware.novembergallery::lang.component_properties.order_images_by_option_width')
						. ' ' . \Lang::get('zenware.novembergallery::lang.miscellanous.sort_descending_number'),
					'height' => \Lang::get('zenware.novembergallery::lang.component_properties.order_images_by_option_height'),
					'heightDESC' => \Lang::get('zenware.novembergallery::lang.component_properties.order_images_by_option_height')
						. ' ' . \Lang::get('zenware.novembergallery::lang.miscellanous.sort_descending_number'),
					'orientation' => \Lang::get('zenware.novembergallery::lang.component_properties.order_images_by_option_orientation'),
					'orientationDESC' => \Lang::get('zenware.novembergallery::lang.component_properties.order_images_by_option_orientation')
						. ' ' . \Lang::get('zenware.novembergallery::lang.miscellanous.sort_descending_string'),
					'fileName' => \Lang::get('zenware.novembergallery::lang.component_properties.order_images_by_option_file_name'),
					'fileNameDESC' => \Lang::get('zenware.novembergallery::lang.component_properties.order_images_by_option_file_name')
						. ' ' . \Lang::get('zenware.novembergallery::lang.miscellanous.sort_descending_string'),
					'fileSize' => \Lang::get('zenware.novembergallery::lang.component_properties.order_images_by_option_file_size'),
					'fileSizeDESC' => \Lang::get('zenware.novembergallery::lang.component_properties.order_images_by_option_file_size')
						. ' ' . \Lang::get('zenware.novembergallery::lang.miscellanous.sort_descending_number'),
					'uploaded' => \Lang::get('zenware.novembergallery::lang.component_properties.order_images_by_option_uploaded'),
					'uploadedDESC' => \Lang::get('zenware.novembergallery::lang.component_properties.order_images_by_option_uploaded')
						. ' ' . \Lang::get('zenware.novembergallery::lang.miscellanous.sort_descending_date'),
				]
			]
		];
	}

	/**
	 * Set proprety defaults, such as allowed extensions, and load the list of images to display.
	 */
	public function onRun()
	{
		$this->addCss('assets/css/novembergallery.css');

		if (Settings::instance()->inject_jquery) {
			$this->addJs('//cdn.jsdelivr.net/npm/jquery@3/dist/jquery.min.js');
		}

		$this->InjectScripts();

		$this->allowedExtensions = array();
		if (Settings::instance()->allowed_extensions_jpg) {
			$this->allowedExtensions[] = 'jpg';
			$this->allowedExtensions[] = 'jpeg';
		}
		if (Settings::instance()->allowed_extensions_gif) {
			$this->allowedExtensions[] = 'gif';
		}
		if (Settings::instance()->allowed_extensions_png) {
			$this->allowedExtensions[] = 'png';
		}
		// DebugbarDebugbar::info(Settings::instance());
		$this->gallery = new Gallery($this->getSortBy());
		$this->loadMedia();
		// Do NOT do this here, because if we have several galleries on the same page, they will all end up rendering the gallery selected in the last component on the page:
		// $this->page['gallery'] = $this->gallery;
	}

	/**
	 * Inject page variables
	 */
	public function onRender()
	{
		// Could inject variables into the page this way: https://stackoverflow.com/questions/48180951/octobercms-how-to-pass-variable-from-page-to-component
		$this->page['novemberGallery_' . $this->alias] = $this->page['gallery'] = $this->gallery;
		parent::onRender();
	}

	/** 
	 * Get the gallery sort order, which is based on the order of images for images uploaded 
	 * using the backend "Galleries" page, or the filename for images uploaded using the media manager.
	 * 
	 * @return string GalleryItem property name
	 */
	public function getSortBy()
	{
		$sortBy = ($this->getGalleryType() == self::GALLERYTYPE_BACKENDGALLERY) ? 'sortOrder' : 'fileName';
		if (
			!empty($this->property('sortBy'))
			&& 	$this->property('sortBy') != 'default'
		) {
			$sortBy = $this->property('sortBy');
		}
		return $sortBy;
	}

	/** 
	 * Get the width of the thumbnails for this gallery.
	 * 
	 * @return int Width of thumbnails in pixels
	 */
	public function getThumbnailWidth()
	{
		$width = false;
		if (!empty($this->property('imageResizerWidth'))) {
			$width = $this->property('imageResizerWidth');
		} elseif (empty($this->property('imageResizerHeight')) && !empty(Settings::instance()->image_resizer_width)) {
			$width = Settings::instance()->image_resizer_width;
		}
		return $width;
	}

	/** 
	 * Get the height of the thumbnails for this gallery.
	 * 
	 * @return int Height of thumbnails in pixels
	 */
	public function getThumbnailHeight()
	{
		$height = false;
		if (!empty($this->property('imageResizerHeight'))) {
			$height = $this->property('imageResizerHeight');
		} elseif (empty($this->property('imageResizerWidth')) && !empty(Settings::instance()->image_resizer_height)) {
			$height = Settings::instance()->image_resizer_height;
		}
		return $height;
	}

	/** 
	 * Get the height of the thumbnails for this gallery.
	 * 
	 * @return int Width of gallery in pixels
	 */
	public function getGalleryWidth()
	{
		$width = false;
		if (!empty($this->property('galleryWidth'))) {
			$width = $this->property('galleryWidth');
		}
		if (Str::contains($width, '%')) {
			$width = '"' . $width . '"';
		}
		return $width;
	}

	/** 
	 * Get the height of the thumbnails for this gallery.
	 * 
	 * @return int Height of gallery in pixels
	 */
	public function getGalleryHeight()
	{
		$height = false;
		if (!empty($this->property('galleryHeight'))) {
			$height = $this->property('galleryHeight');
		}
		if (Str::contains($height, '%')) {
			$height = '"' . $height . '"';
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
		$maxImages = $this->property('maxItems', 100);
		$page = null;
		if (property_exists($this, 'page')) $page = $this->page;

		
			

		if (
			!empty($this->property('mediaFolder'))
			&& 	$this->property('mediaFolder') == '<post>'
		) {
			// We need to get the gallery from the post object
			// Could also go this route: Debugbar::info($this->page->components['blogPost']); 
			// but then we'd need to figure out the actual component alias instead of "blogPost"
			// In any case the RainLab posts component injects the "post" variable into the page se we can use that:
			$pluginManager = PluginManager::instance()->findByIdentifier('Rainlab.Blog');
			if (
				$pluginManager
				&& 	!$pluginManager->disabled
				&& 	isset($page)
				&& 	!is_null($page->post)	// isset doesn't seem to work here, maybe it's a "magic getter" or some other Laravel/Eloquent voodoo?
				&& 	$page->post instanceof \RainLab\Blog\Models\Post
			) {
				$post = $page->post;
				$images     = new Collection();
				// Another method to check - but this doesn't work: isset($post->relations['novembergalleries'])
				// Some reading: https://github.com/laravel/framework/blob/5.3/src/Illuminate/Database/Eloquent/Model.php#L3239
				// https://stackoverflow.com/questions/23910553/laravel-check-if-related-model-exists
				// https://laracasts.com/discuss/channels/eloquent/this-relationloaded-for-distant-relationships
				if (
					!is_null($post->novembergalleries)	// Could also use $post->relationLoaded('novembergalleries')
					&&	$post->relationLoaded('novembergalleries')
					&& 	$post->novembergalleries
				) {
					foreach ($post->novembergalleries as $gallery) {
						foreach ($gallery->images->take($maxImages) as $image) {
							$images->push(GalleryItem::createFromOctoberImageFile($this, $image));
						}
					}
				}
				if (
					!is_null($post->novembergalleryfields)
					&&	$post->novembergalleryfields->exists()
					&& 	$post->relationLoaded('novembergalleryfields')
					&&	!is_null($post->novembergalleryfields->media_folder)
					&& 	!empty($post->novembergalleryfields->media_folder)
				) {
					$baseMediaFolder = Settings::instance()->base_folder;
					if (Settings::instance()->base_blogmedia_folder != '<inherit>') {
						$baseMediaFolder = Settings::instance()->base_blogmedia_folder;
					}
					$images = $images->merge($this->getImagesInMediaFolder($this->getGalleryPath($baseMediaFolder, $this->page->post->novembergalleryfields->media_folder), $maxImages));
				}
				$this->gallery->items = $images;
				$this->gallery->type = Gallery::GALLERYTYPE_BLOGPOST;
			}
		} elseif ($this->getGalleryType() == self::GALLERYTYPE_BACKENDGALLERY) {
			// We have a gallery uploaded using the NovemberGallery backend menu

			$images     = new Collection();

			if ($this->galleryRow) // && $gallery->count() == 1 does not work for some reason, I am getting "2"??
			{
				foreach ($this->galleryRow->images->take($maxImages) as $image) {
					$images->push(GalleryItem::createFromOctoberImageFile($this, $image));
				}
				$this->gallery->type = Gallery::GALLERYTYPE_BACKENDGALLERY;
				$this->gallery->name = $this->galleryRow->name;
				$this->gallery->slug = $this->galleryRow->slug;
				$this->gallery->description = $this->galleryRow->description;
				$this->gallery->keywords = $this->galleryRow->keywords;
				$this->gallery->publishedAt = $this->galleryRow->published_at;
				$this->gallery->published = $this->galleryRow->published;
				$this->gallery->createdAt = $this->galleryRow->created_at;
				$this->gallery->updatedAt = $this->galleryRow->updated_at;
				if ($this->galleryRow->preview_image)
				{
					$this->gallery->previewImage = GalleryItem::createFromOctoberImageFile($this, $this->galleryRow->preview_image);
				}
			}
			$this->gallery->items = $images;
			/*
			"id" => 7
			"name" => "Budapest"
			"slug" => "budapest"
			"description" => "Europe's most beautiful capital!"
			"sort_order" => null
			"published_at" => null
			"published" => 1
			"created_at" => "2019-08-22 11:26:48"
			"updated_at" => "2019-08-22 11:26:48"
			*/;
		} else {
			// We have a gallery uploaded using the MediaManager
			$this->gallery->name = $this->getRelativeMediaFolder();
			$this->gallery->folder = $this->getGalleryPath($this->getBaseMediaFolder(), $this->getRelativeMediaFolder());
			$this->gallery->items = $this->getImagesInMediaFolder($this->gallery->folder, $maxImages);
			$this->gallery->type = Gallery::GALLERYTYPE_OCTOBERMEDIAMANAGER;
		}
	}

	const GALLERYTYPE_BACKENDGALLERY = 0;
	const GALLERYTYPE_OCTOBERMEDIAMANAGER = 1;
	/**
	 * Get the gallery type, which can be a standard folder of images uploaded using October Media Manager, 
	 * or a gallery created using the dedicated back-end gallery page.
	 * 
	 * @return integer NovemberGalleryComponentBase::GALLERYTYPE_BACKENDGALLERY or NovemberGalleryComponentBase::GALLERYTYPE_OCTOBERMEDIAMANAGER
	 */
	protected function getGalleryType()
	{
		if (
			!empty($this->property('mediaFolder'))
			&& NovemberHelper::startsWith($this->property('mediaFolder'), '[')
			&& NovemberHelper::endsWith($this->property('mediaFolder'), ']')
		) {
			$this->galleryRow = Galleries::find(substr($this->property('mediaFolder'), 1, strlen($this->property('mediaFolder')) - 2));
		} else {
			$this->galleryRow = Galleries::where('slug', $this->property('mediaFolder'))->first();
		}
		if ($this->galleryRow != null){
			return self::GALLERYTYPE_BACKENDGALLERY;
		}
		return self::GALLERYTYPE_OCTOBERMEDIAMANAGER;
	}

	/**
	 * Get the base media folder
	 * 
	 * @return string Base media folder
	 */
	protected function getBaseMediaFolder()
	{
		return Settings::instance()->base_folder;
	}

	/**
	 * Get the subfolder underneath the base media folder
	 * 
	 * @return string Relative media folder
	 */
	protected function getRelativeMediaFolder()
	{
		return $this->property('mediaFolder');
	}

	/**
	 * Retrieve the full path to the gallery taking into account the base folder selected 
	 * in the backend NovemberGallery settings page.
	 * 
	 * This can be called from the front-end with: {{ __SELF__.galleryPath() }}
	 * 
	 * @return string Path to the gallery of images to display
	 */
	protected function getGalleryPath($baseMediaFolder, $relativeMediaFolder)
	{
		$galleryPath = Settings::instance()->mediaPath;

		if (!empty($baseMediaFolder)) {
			$galleryPath .= $baseMediaFolder;
		}

		if (!empty($relativeMediaFolder)) {
			$galleryPath .= DIRECTORY_SEPARATOR . $relativeMediaFolder;
		}

		return $galleryPath;
	}

	/**
	 * Get a collection of images in the specified folder.
	 * 
	 * @return Collection Collection of images
	 */
	protected function getImagesInMediaFolder($galleryPath, $maxImages)
	{
		$extensions = $this->allowedExtensions;
		$images     = new Collection();
		// Debugbar::info("NovemberGallery MediaPath is: {$galleryPath}");

		if (!\File::exists($galleryPath)) {
			$this->error = "NovemberGallery error: cannot find the path " . $galleryPath;
			return array();
		}

		$files     = \File::allFiles($galleryPath);
		// Debugbar::info("NovemberGallery found files: " . count($files));
		$i = 1;
		foreach ($files as $file) {
			if ($file->isFile() && $file->isReadable() && in_array($file->getExtension(), $extensions)) {
				$images->push(GalleryItem::createFromPhpFile($this, $file));
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
		$options = NovemberHelper::getSubdirectories(Settings::instance()->base_folder);
		// Debugbar::info(Galleries::select('id', 'name')->orderBy('name')->get()->pluck('name', 'id'));

		// Re-key the collection: https://adamwathan.me/2016/07/14/customizing-keys-when-mapping-collections/
		$galleries = Galleries::select('id', 'name')->orderBy('name')->get()->reduce(function ($galleries, $gallery) {
			$galleries->put('[' . $gallery->id . ']', $gallery->name);
			return $galleries;
		}, new Collection());

		$pluginManager = PluginManager::instance()->findByIdentifier('Rainlab.Blog');
		if ($pluginManager && !$pluginManager->disabled) {
			$galleries->put('<post>', \Lang::get('zenware.novembergallery::lang.component_properties.folder_type_post'));
		}

		$options = $options->merge($galleries); //->pluck('name', 'id'));

		return $options->toArray();
	}
}
