<?php

namespace ZenWare\NovemberGallery\Components;

use Cms\Classes\ComponentBase;
use October\Rain\Support\Collection;
use Illuminate\Support\Str;
use ZenWare\NovemberGallery\NovemberHelper;
use ZenWare\NovemberGallery\Models\Settings;
use System\Classes\PluginManager;
use ZenWare\NovemberGallery\Models\Gallery as Galleries;
use ZenWare\NovemberGallery\Classes\Gallery;
use ZenWare\NovemberGallery\Classes\GalleryItem;

use function PHPSTORM_META\elementType;

// use Debugbar;   // http://wiltonsoftware.nz/blog/post/debug-october-cms-plugin

class GalleryHub extends ComponentBase
{
	public $dbg;

	/**
	 * @var October\Rain\Support\Collection Collection of matching galleries. Each item in the collection is an instance of the Gallery class (see above).
	 */
	public $galleries;

	/**
	 * @var string[] This is the result of the File::directories() call that retrieves all subdirectories underneath your gallery root folder. Only populated when the "Hub Type" is set to "All Galleries".
	 */
	public $dirs;

	/**
	 * @var string As set by the user in the component inspector, will be [ALL] if the user selected "All Galleries", or a keyword (which is used to limit the galleries shown)
	 */
	public $hubType;

	/**
	 * @var string If the hub type is set to search by keywords, then this will be set to the selected keyword.
	 */
	public $keyword = false;

	/**
	 * @var string As set in the component inspector, can be one of: default, title, description, slug, publishedon
	 */
	public $sortBy;

	/**
	 * @var string As set in the component inspector, can be either "ASC" or "DESC"
	 */
	public $sortDir;

	/**
	 * @var int Maximum number of galleries to show, as set in the component inspector
	 */
	public $maxItems;

	/**
	 * @var string Link URL template, as set in the component inspector. The placeholder %slug% will be replaced with the slug of the given gallery
	 */
	public $linkUrl;

	/**
	 * @var bool As set in the component inspector
	 */
	public $openInNewTab;

	/** 
	 * @var string How the galleries should be rendered, can be one of: default (unordered list of preview images), titleOnly (unordered list of gallery names), template (use a custom template), custom (no code is generated)
	 */
	public $visualization;

	/**
	 * @var string If "visualization" is set to "template", then the gallery items will be rendered using the template given here. The following placeholders are replaced with actual values: %type%, %url%, %slug%, %folder%, %name%, %description%, %keywords%, %created_at%, %updated_at%, %preview_image_url%, %published%, %preview_image_title%, %preview_image_description%, %preview_image_width%, %preview_image_height%, %preview_image_filename%, %preview_image_filesize%, %items_count%
	 */
	public $visualizationTemplate;
		
	public function componentDetails()
	{
		return [
			'name' => 'zenware.novembergallery::lang.plugin.gallery_hub_component_name',
			'description' => 'zenware.novembergallery::lang.plugin.gallery_hub_component_description'
		];
	}

	/**
	 * Configuration options that can be set on the component properties page after 
	 * being dropped into a CMS page, this is in addition to any properties defined 
	 * in NovemberGalleryComponentBase.
	 * 
	 * @return array Component properties page configuration options
	 */
	public function defineProperties()
	{
		return [
			'hubType' => [
				'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.hub_type_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.hub_type_label_hint'),
				'default'           => '',
				'type'              => 'dropdown',
				'placeholder'       => \Lang::get('zenware.novembergallery::lang.component_properties.hub_type_label_placeholder')
				// 'validationPattern' => '^[a-zA-Z0-9$\-_.+!*\'(),/]+$',   // https://perishablepress.com/stop-using-unsafe-characters-in-urls/
				// 'validationMessage' => \Lang::get('zenware.novembergallery::lang.component_properties.folder_label_validation_message'),
			],
			'sortBy' => [
				'title'       => \Lang::get('zenware.novembergallery::lang.component_properties.hub_order_galleries_by_label'),
				'description' => \Lang::get('zenware.novembergallery::lang.component_properties.hub_order_galleries_by_label_hint'),
				'type'        => 'dropdown',
				'placeholder' => \Lang::get('zenware.novembergallery::lang.miscellanous.default'),
				'options'     => [
					'default' => \Lang::get('zenware.novembergallery::lang.component_properties.hub_order_galleries_by_option_title'),
					'titleDESC' => \Lang::get('zenware.novembergallery::lang.component_properties.hub_order_galleries_by_option_title')
						. ' ' . \Lang::get('zenware.novembergallery::lang.miscellanous.sort_descending_string'),
					'description' => \Lang::get('zenware.novembergallery::lang.component_properties.hub_order_galleries_by_option_description'),
					'descriptionDESC' => \Lang::get('zenware.novembergallery::lang.component_properties.hub_order_galleries_by_option_description')
						. ' ' . \Lang::get('zenware.novembergallery::lang.miscellanous.sort_descending_string'),
					'slug' => \Lang::get('zenware.novembergallery::lang.component_properties.hub_order_galleries_by_option_slug'),
					'slugDESC' => \Lang::get('zenware.novembergallery::lang.component_properties.hub_order_galleries_by_option_slug')
						. ' ' . \Lang::get('zenware.novembergallery::lang.miscellanous.sort_descending_number'),
					'publishedOn' => \Lang::get('zenware.novembergallery::lang.component_properties.hub_order_galleries_by_option_published_on'),
					'publishedOnDESC' => \Lang::get('zenware.novembergallery::lang.component_properties.hub_order_galleries_by_option_published_on')
						. ' ' . \Lang::get('zenware.novembergallery::lang.miscellanous.sort_descending_number')
				],
			],
			'maxItems' => [
				'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.hub_max_galleries_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.hub_max_galleries_label_hint'),
				'default'           => 100,
				'type'              => 'string',
				'validationPattern' => '^[0-9]+$',
				'validationMessage' => \Lang::get('zenware.novembergallery::lang.component_properties.hub_max_galleries_validation')
			],
			'linkUrl' => [
				'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.hub_visualization_link_url_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.hub_visualization_link_url_hint'),
				'default'           => '',
				'required'			=> true,
				'validationMessage' => \Lang::get('zenware.novembergallery::lang.component_properties.hub_visualization_link_url_required'),
			],
			'openInNewTab' => [
				'title'				=> \Lang::get('zenware.novembergallery::lang.component_properties.hub_visualization_open_in_new_tab_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.hub_visualization_open_in_new_tab_label_hint'),
				'type'				=> 'checkbox',
				'default'			=> false,
				'group' 			=> \Lang::get('zenware.novembergallery::lang.component_properties.group_visualization_label')
			],
			'visualization' => [
				'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.hub_visualization_label'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.hub_visualization_label_hint'),
				'type'        => 'dropdown',
				'placeholder' => \Lang::get('zenware.novembergallery::lang.component_properties.hub_visualization_option_preview_image'),
				'options'     => [
					'default' => \Lang::get('zenware.novembergallery::lang.component_properties.hub_visualization_option_preview_image'),
					'titleOnly' => \Lang::get('zenware.novembergallery::lang.component_properties.hub_visualization_option_title'),
					'template' => \Lang::get('zenware.novembergallery::lang.component_properties.hub_visualization_option_template'),
					'custom' => \Lang::get('zenware.novembergallery::lang.component_properties.hub_visualization_option_custom')
				],
				'group' 			=> \Lang::get('zenware.novembergallery::lang.component_properties.group_visualization_label')
			],
			'template' => [
				'title'             => \Lang::get('zenware.novembergallery::lang.component_properties.hub_visualization_template'),
				'description'       => \Lang::get('zenware.novembergallery::lang.component_properties.hub_visualization_template_hint'),
				'default'           => '',
				'group' 			=> \Lang::get('zenware.novembergallery::lang.component_properties.group_visualization_label')
			],
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

		$this->hubType = $this->property('hubType');

		if (!empty($this->property('hubType')) && $this->property('hubType') != '[ALL]'
			)
		{
			$this->keyword = $this->property('hubType');
		}

		$this->linkUrl = '';
		if (!empty($this->property('linkUrl')) && $this->property('linkUrl') != 'default')
		{
			$this->linkUrl = $this->property('linkUrl');
		} else {
			$this->error = "November Gallery: Please set the link URL in the component inspector!";
		}

		$this->openInNewTab = false;
		if (!empty($this->property('openInNewTab')) && $this->property('openInNewTab') != 'default')
		{
			$this->openInNewTab = (bool)$this->property('openInNewTab');
		}

		$this->visualization = 'title';
		if (!empty($this->property('visualization')) && $this->property('visualization') != 'default')
		{
			$this->visualization = $this->property('visualization');
		}

		$this->visualizationTemplate = '';
		if (!empty($this->property('template')) && $this->property('template') != 'default')
		{
			$this->visualizationTemplate = $this->property('template');
		}

		$this->maxItems = 100;
		if (!empty($this->property('maxItems')) && is_int($this->property('maxItems')))
		{
			$this->maxItems = (int)$this->property('maxItems');
		}
		$this->sortBy = 'name';
		$this->sortDir = 'ASC';
		if (!empty($this->property('sortBy'))
			&& 	$this->property('sortBy') != 'default'
		) 
		{
			if (NovemberHelper::endsWith($this->property('sortBy'), 'DESC')) 
			{
				$this->sortBy = NovemberHelper::trimEnd($this->property('sortBy'), 'DESC');
				$this->sortDirection = 'DESC';
			} 
			else 
			{
				$this->sortBy = $this->property('sortBy');
			}
		}

		// DebugbarDebugbar::info(Settings::instance());
		$this->loadGalleries();
		// Do NOT do this here, because if we have several galleries on the same page, they will all end up rendering the gallery selected in the last component on the page:
		// $this->page['gallery'] = $this->gallery;
	}

	/**
	 * Inject page variables
	 */
	public function onRender()
	{
		// Could inject variables into the page this way: https://stackoverflow.com/questions/48180951/octobercms-how-to-pass-variable-from-page-to-component
		$this->page['novemberGallery_' . $this->alias] = $this->page['galleries'] = $this->galleries;
		
		$result = '';

		switch ($this->visualization) {
			case 'titleOnly':
				$result = $this->renderPartial('@title-only.htm');
				break;
			
			case 'template':
				$result = $this->renderPartial('@custom-template.htm');
				break;

			case 'custom':
				$result = $this->renderPartial('@blank.htm');
				break;
				
			default:
				$result = $this->renderPartial('@default.htm');
				break;
		}

		return $result;
	}

	/**
	 * Load CSS and JS assets
	 */
	public function InjectScripts()
	{ }

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
	 * Retrieve the full path to the gallery taking into account the base folder selected 
	 * in the backend NovemberGallery settings page.
	 * 
	 * This can be called from the front-end with: {{ __SELF__.galleryPath() }}
	 * 
	 * @return string Path to the gallery of images to display
	 */
	protected function getGalleryPath($baseMediaFolder)
	{
		$galleryPath = Settings::instance()->mediaPath;

		if (!empty($baseMediaFolder)) {
			$galleryPath .= $baseMediaFolder;
		}

		return $galleryPath;
	}

	/**
	 * Retrieve a list of all gallery items (images and videos) under the gallery path.
	 * 
	 * @return array Array of filenames (with extension, without path)
	 */
	function loadGalleries()
	{
		$this->galleries = new Collection();

		if (!empty($this->property('hubType')) && $this->property('hubType') == '[ALL]') {
			$galleryPath = $this->getGalleryPath($this->getBaseMediaFolder());
			$this->dbg = $galleryPath;
			if (!\File::exists($galleryPath)) {
				$this->error = "NovemberGallery error: cannot find the path " . $galleryPath;
			}
			$this->dirs     = \File::directories($galleryPath);
			// Debugbar::info("NovemberGallery found files: " . count($dirs));
			$i = 1;
			foreach ($this->dirs as $dir) {
				$subdir = substr($dir, strlen($galleryPath));
				$subdir = substr($subdir, 1);
				$gallery = new Gallery('default');
				$gallery->folder = $dir;
				$gallery->name = $subdir;
				$gallery->type = Gallery::GALLERYTYPE_OCTOBERMEDIAMANAGER;
				$gallery->url =  str_replace('%slug%', $subdir, $this->linkUrl);
				$this->galleries = $this->galleries->merge([$subdir => $gallery]);
				if ($i >= $this->maxItems) break;
				$i++;
			}
		}

		
		$galleryRows = Galleries::orderBy($this->sortBy, $this->sortDir)
				->take($this->maxItems);

		if (!empty($this->keyword))
		{
			$galleryRows = Galleries::where('keywords', 'like', '%' . $this->keyword . '%')
				->orderBy($this->sortBy, $this->sortDir)
				->take($this->maxItems);
		}

		$galleryRows = $galleryRows->get();

		foreach ($galleryRows as $galleryRow)
		{
			$gallery = new Gallery('default');
			$images     = new Collection();

			foreach ($galleryRow->images->take($this->maxItems) as $image) {
				$images->push(GalleryItem::createFromOctoberImageFile($this, $image));
			}
			$gallery->type = Gallery::GALLERYTYPE_BACKENDGALLERY;
			$gallery->name = $galleryRow->name;
			$gallery->slug = $galleryRow->slug;
			$gallery->description = $galleryRow->description;
			$gallery->keywords = $galleryRow->keywords;
			$gallery->publishedAt = $galleryRow->published_at;
			$gallery->published = $galleryRow->published;
			$gallery->createdAt = $galleryRow->created_at;
			$gallery->updatedAt = $galleryRow->updated_at;
			$gallery->url =  str_replace('%slug%', $galleryRow->slug, $this->linkUrl);
			if ($galleryRow->preview_image)
			{
				$gallery->previewImage = GalleryItem::createFromOctoberImageFile($this, $galleryRow->preview_image);
			}
			$gallery->items = $images;

			$this->galleries = $this->galleries->merge([$gallery->slug => $gallery]);
			if ($this->galleries->count() >= $this->maxItems) break;
		}
	}

	/**
	 * Populate the "Hub Type" property with options.
	 * 
	 * See "Dropdown properties" in https://octobercms.com/docs/plugin/components#component-properties
	 * 
	 * @return array List of folders
	 */
	public function getHubTypeOptions()
	{
		$options = collect([
			'[ALL]' => \Lang::get('zenware.novembergallery::lang.component_properties.hub_type_option_all')
		]);

		///$options = $options->merge(['a' => "Another option!"]);

		// $options = NovemberHelper::getSubdirectories(Settings::instance()->base_folder);
		// Debugbar::info(Galleries::select('id', 'name')->orderBy('name')->get()->pluck('name', 'id'));

		//Re-key the collection: https://adamwathan.me/2016/07/14/customizing-keys-when-mapping-collections/
		$galleryKeywords = Galleries::select('keywords')->get()->reduce(function ($galleryKeywords, $gallery) {
			if ($keywordParts = explode(',', $gallery->keywords)) {
				foreach ($keywordParts as $keyword) {
					$keyword = trim($keyword);
					if (!empty($keyword) && !$galleryKeywords->has(strtoupper($keyword)))
					{
						$galleryKeywords->put(strtoupper($keyword), 'Keyword: ' . $keyword);
					}
				}
			}
			return $galleryKeywords;
		}, new Collection());

		$options = $options->merge($galleryKeywords); //->pluck('name', 'id'));

		return $options->toArray();
	}

	/**
	 * Converts the item data to an array, enables end-users to do
	 * {{ dump(embeddedGallery.gallery.toArray) }} or
	 * {{ debug(embeddedGallery.gallery.toArray) }} (with debugbar installed)
	 * @return array Returns the item data as array
	 */
	public function toArray()
	{
		$result = [];
		$properties = (new \ReflectionObject($this))->getProperties(\ReflectionProperty::IS_PUBLIC);
		foreach ($properties as $property) {
			$propertyName = $property->name;
			$result[$propertyName] = $this->$propertyName;
		}
		return $result;
	}
}
