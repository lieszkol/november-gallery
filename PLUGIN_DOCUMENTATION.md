> Aloha! I am Laszlo, the main developer of this plugin. I've worked hard to make this plugin available for you, and you are welcome to use the "Personal" edition for free for non-commercial purposes. I would like to ask you for a favor in return. *Please don't leave a negative review if you encounter issues or find that something is missing.* Contact me first, and give me chance to make it into a five-star product for you.
> 
>  You can reach out to me by clicking "Product Support" on the left, or by raising an issue on [GitHub](https://github.com/lieszkol/november-gallery). Give me a few days to respond - I may get busy with other stuff but I will get back to you and I will genuinely appreciate that you took the time to help me improve this plugin. And if you end up using it on a commercial project, consider purchasing the professional edition - you will be supporting not only my work but October as well. 
>
> ![Me myself and I](https://www.generalcomputing.com/2019/lll_2016_round_120.png)

# November Gallery Pro vs. Personal

This plugin is available in two editions: 

 1. The Personal Edition is a free plugin meant for non-profit use, such as:
	 2. Building a personal website that is not offering a product or services for sale
	 3. Academic use
	 4. Use by non-profit organizations
 2. The Pro Edition is meant for commercial use, such as:
	 1. A website selling or promoting products or services
	 2. Use by a for-profit organization

In terms of functionality, the two plugins are identical.
November Gallery Pro is available from the OctoberCMS Marketplace. 
The Personal Edition is available from [GitHub](https://github.com/lieszkol/november-gallery). You will need to install it yourself - follow the README on the GitHub project page.

# What is November Gallery?

November Gallery is essentially a scaffolding over various Javascript-based visualization libraries. JS is great for displaying the images because it runs in the user's browser and can immediately react to changes in its environment, for example, a user turning their phone from vertical to horizontal, or resizing their browser. What November Gallery does is provide a framework within OctoberCMS for managing your images and building templates that include gallery "definitions". From an admin's/site content editor's perspective, you (1) get a "Gallery" page in your "backend" (that sounds wrong) and (2) you get various components that you can drag-and-drop onto your CMS pages/partials. Additionally, it also provides (3) "Snippets" to use in your "Static" pages (if you have the [Static Pages plugin](https://octobercms.com/plugin/rainlab-pages) installed), and (4) it also integrates with the [RainLab Blog Component](https://octobercms.com/plugin/rainlab-blog), if you have it.
   
For rendering your galleries, November Gallery provides you with various options, but it makes use of two JS libraries to do so. The various components it makes available to you really just help with configuring how the JS scripts are run so that you get a "swiper" or a "popup" gallery etc. You do not have to understand how these JS libraries work, but reading about the available configuration options will enable you to customize your galleries further than if you just use the options available through the November Gallery component property pages. 

# Deployment

> Note: You must have a `{% styles %}` and `{% scripts %}` tag in your layout header/footer so that the plugin can inject the required assets.
```
<head>
   {% styles %}
</head>
<body>
    {% page %}
    {% scripts %}
</body>
```

### Installation

To install from your site "backend": go to  **Settings → Updates & Plugins → Install Plugins**  and then search for  "November Gallery".

To install from the  [Marketplace](https://octobercms.com/plugins): click `Add to Project` and select the project you wish to use the plugin on. Once the plugin has been added to your project, from the backend area of your site click the `Check for updates` button on the **Settings → Updates & Plugins** page to pull in the plugin.

# Component Options

### [Shared Options]{#shared-options}

Property | Inspector Name | Description
--|--|--
`alias`|Alias|Standard OctoberCMS stuff, you refer to the component in  your page via this unique identifier, the default is "embeddedGallery" but you can change it to anything you want (don't use spaces or special characters though!)
`maxItems`|Max Images|The maximum number of images to display
`mediaFolder`|Media Folder|Select the folder that you uploaded the images to in the OctoberCMS Media manager. Only folders under the "Base Media Folder" set on the November Gallery settings page are valid.

## Component 1: Embedded Gallery

Use this if you wish to show a gallery of images within your page using various layouts, with optional full-screen (lightbox-style) viewing.

### [Options]
The following are available in addition to the [Shared Options](#shared-options) described above:

Property | Inspector Name | Description
-- | -- | --
`galleryLayout` | Gallery Layout | Select a gallery layout; possible values are: (1) `default` / Default (use the gallery layout set on the plugin settings page) (2) `gallery_tiles` / Tiles (3) `gallery_carousel` / Carousel (4) `gallery_combined` / Combined (5) `gallery_slider` / Slider
`tilesLayout` | Tile Layout | Only applicable if the *Gallery Layout* is set to "Tiles"; possible values are: (1) `default` / Default (use the default gallery layout set on the plugin settings page) (2) `gallery_tiles_columns` / Columns (3) `gallery_tiles_justified` / Justified (4) `gallery_tiles_nested` /  Nested (5) `gallery_tiles_grid` / Grid
`combinedLayout` | Thumbnails Layout | Only applicable if the *Gallery Layout* is set to "Combined"; possible values are: (1) `default` / Default (use the default thumbnails layout set on the plugin settings page) (2) `gallery_combined_default` / Normal (default) (3) `gallery_combined_compact` / Compact (4) `gallery_combined_grid` /  Grid
`additionalGalleryOptions` | Script options | Additional JS options that you want passed onto the UniteGallery script, for example: `theme_panel_position: 'bottom'`
`imageResizerWidth` | Thumbnail Width | Width of the generated thumbnail; Leave empty or set to 0 to only constrain the image by height; leave both width and height empty to fall back on the values set on the backend plugin configuration page
`imageResizerHeight` | Thumbnail Height | Height of the generated thumbnail; Leave empty or set to 0 to only constrain the image by height; leave both width and height empty to fall back on the values set on the backend plugin configuration page
`imageResizerMode` | Thumbnail Mode | Select how to resize your images into thumbnails, or select "default" to use the thumbnail mode set on the plugin settings page; possible values are: (1) Default (2) Exact (3) Portrait (4) Landscape (5) Auto (6) Crop
`galleryWidth` | Gallery Width | Can be a number (pixel lenght) or a percent (of the parent container). Leave empty to fall back on the values set on the backend plugin configuration page
`galleryHeight` | Gallery Height| Only applies to "Combined" and "Slider" galleries! Can be a number (pixel lenght) or a percent (of the parent container). Leave empty to fall back on the values set on the backend plugin configuration page

## Component 2: Swiper

Use this component to create a modern, responsive "swiper" that can be controlled easily from any device. Note that you can control any of the galleries by touch (or click-and-swipe using a mouse). Various transitions are available: "fade", "slide", "flip", "cube", etc..

### [Options]
The following are available in addition to the [Shared Options](#shared-options) described above:

Property | Inspector Name | Description
-- | -- | --
`effect` | Transition Effect | Tranisition effect. Can be "slide", "fade", "cube", "coverflow" or "flip"
`direction` | Direction | Can be "horizontal" or "vertical"
`speed` | Transition Speed | How long the transition effect lasts, in milliseconds. 1000 = 1 seconds.
`lazyLoad` | Lazy-load images? | Toggle ON to only load the images the user is looking at. Previous and next images are set to pre-load automatically.
`addPagination` | Add pagination? | Toggle ON to show bullets (or anything else) that enable to user to jump to any specific slide.
`addNavigation` | Add navigation? | Toggle ON to show previous-slide and next-slide navigational arrows.
`autoplay` | Auto-play? | Toggle ON to enable automatic advance on the slides. Set the delay below.
`autoplayDelay` | Auto-play Delay | How long each image is shown for, in milliseconds. 1000 = 1 seconds.
`additionalGalleryOptions` | Script options | Additional JS options that you want passed onto the Swiper script, for example: `fadeEffect: {crossFade: true}`

**Example Page**

```
<div style="width: 100%; height: calc(100vh - 70px);">
	{% component 'swiperGallery' %}
</div>
```

The swiper component by default fills whatever space it is in, in this case we set the container DIV to take up 100% of the viewport and be 100vh tall.

## Component 3: Pop-up Lightbox

Use this if you wish to add a lightbox-style 'pop-up' gallery to your page that is only shown when the user clicks on an element (such as a link/button/image).

### [Options]
The following are available in addition to the [Shared Options](#shared-options) described above:

Property | Inspector Name | Description
-- | -- | --
`attachTo` | Attach to | JQuery selector for the element(s) that the user can click on to open the lightbox; for example: `#gallery-button`
`additionalLightboxOptions` | Script options | Additional JS options that you want passed onto the UniteGallery script, for example: `theme_panel_position: 'bottom'`


**Example Page**
```
{% component 'popupLightbox' %}
<button id="gallery-button">Click me!</button>
```

This is a simple example where you place a button onto the page. Select a folder of images from the "Media Folder" drop-down in your inspector, and set the gallery "Attach to" option to `#gallery-button`. Your button should then serve to open a lightbox gallery of all of the images in the selected folder.

## Component 4: Video Gallery

Use this gallery to display videos inline. You can choose to upload your videos to your website or to show videos hosted on YouTube/Vimeo/Wistia.

### [Options]
The following are available in addition to the [Shared Options](#shared-options) described above:

Property | Inspector Name | Description
-- | -- | --
`videoGalleryItemsSelector` | Gallery Selector/ID | JQuery selector for the element that holds the video items; for example: `#videos`
`videoGalleryLayout` | Gallery Layout | Select a gallery layout; possible values are: (1) `default` / Default (use the gallery layout set on the plugin settings page) (2) `video_gallery_right_thumb` / Thumbnails  (3) `video_gallery_right_title_only` / Titles Only (4) `video_gallery_right_no_thumb` / No Thumbnails 
`additionalVideoGalleryOptions` | Script Options | Additional JS options that you want passed onto the UniteGallery script, for example: `theme_autoplay: true`
`imageResizerHeight` | Thumbnail Height | Height of the generated thumbnail; Leave empty or set to 0 to only constrain the image by height; leave both width and height empty to fall back on the values set on the backend plugin configuration page
`imageResizerMode` | Thumbnail Mode | Select how to resize your images into thumbnails, or select "default" to use the thumbnail mode set on the plugin settings page; possible values are: (1) Default (2) Exact (3) Portrait (4) Landscape (5) Auto (6) Crop
`galleryWidth` | Gallery Width | Can be a number (pixel lenght) or a percent (of the parent container). Leave empty to fall back on the values set on the backend plugin configuration page
`galleryHeight` | Gallery Height| Only applies to "Combined" and "Slider" galleries! Can be a number (pixel lenght) or a percent (of the parent container). Leave empty to fall back on the values set on the backend plugin configuration page

## Component 5: Image List Only

Use this if you wish to write your own Twig script for displaying your images, and only need a list of images (that can be found in a given folder) to be loaded into a page variable. 

The image list component does not have any options other than the [Shared Options](#shared-options) described above.

**Example Page 1**
```
<div style="display: flex; flex-wrap: wrap; justify-content: center; align-items: center;">
{% for galleryitem in customGallery.galleryitems %}
    <div>
        <a href="{{ galleryitem.relativeMediaFilePath | media }}" target="_blank">
            <img src="{{ galleryitem.relativeMediaFilePath | media | resize(280, false,  { mode: 'portrait', quality: '90', extension: 'png' }) }}" alt="{{ galleryitem.fileName }}" style="margin: 20px;" />
        </a>
    </div>
{% endfor %}
</div>
```
This example assumes that your gallery component has the alias "customGallery". Thumbnails are generated for the images using the [Image Resizer Plugin](https://octobercms.com/plugin/toughdeveloper-imageresizer) and displayed in a flexbox, with each thumbnail providing a link to the full-resolution image.

**Example Page 2**
```
<div class="container-fluid">
{% for galleryitemchunk in customGallery.galleryitems.sortBy('relativeMediaFilePath').chunk(3) %}
    <div class="row">
        {% for galleryitem in galleryitemchunk %}
            <div class="col-xs-4" style="text-align: center;">
                <a href="{{ galleryitem.relativeMediaFilePath | media }}" target="_blank">
                    <img src="{{ galleryitem.relativeMediaFilePath | media | resize(280, false,  { mode: 'portrait', quality: '90', extension: 'png' }) }}" alt="{{ galleryitem.fileName }}" />
                </a>
            </div>
        {% endfor %}
    </div>
{% endfor %}
</div>
```
Again, we are assuming that your component has the alias "customGallery." The images are [sorted](https://octobercms.com/docs/services/collections#method-sortby) by filename and "[chunked](https://octobercms.com/docs/services/collections#method-chunk)" into groups of 3 images, which are then displayed using the [Bootstrap grid layout](https://getbootstrap.com/docs/4.0/layout/grid/).

Check out the [Demo Site](https://novembergallery.zenware.io/demo/image-list-only) for live examples of the above.

## Page Properties

**`__SELF__.galleryitems`**

Type: [October\Rain\Support\Collection](https://octobercms.com/docs/services/collections) 
also see [API Docs](https://octobercms.com/docs/api/october/rain/database/collection),  [Illuminate\Database\Eloquent\Collection](https://laravel.com/api/5.5/Illuminate/Database/Eloquent/Collection.html) and [Illuminate\Support\Collection](https://laravel.com/api/5.5/Illuminate/Support/Collection.html)

Collection of `ZenWare\NovemberGallery\Classes\GalleryItem` classes. Serving it as a collection gives access to a ton functionality that is not available with a simple array. For example, you could choose to sort the images by filename:
```
{% for galleryitem in customGallery.galleryitems.sortBy('fileName') %}
   <img src="{{ galleryitem.url }}" />
{% endfor %}
```
#### GalleryItem Properties

Property | Type | Description
--|--|--
`file` | [SplFileInfo](https://www.php.net/manual/en/class.splfileinfo.php) | A standard php file information object
`fileExtension` | string | [File extension](https://www.php.net/manual/en/splfileinfo.getextension.php), for example: jpg
`fileName` | string | [Filename](https://www.php.net/manual/en/splfileinfo.getfilename.php), for example: picture-1.jpg
`fileNameWithoutExtension` | string | Base name of the file without extension, for example: picture-1
`filePath` | string | [Path without filename](https://www.php.net/manual/en/splfileinfo.getpath.php), for example: `/var/www/mywebsite.com/public_html/storage/app/media/my-galleries/gallery-1`
`fileRealPath` | string | [Absolute path to file](https://www.php.net/manual/en/splfileinfo.getrealpath.php), for example: `/var/www/mywebsite.com/public_html/storage/app/media/my-galleries/gallery-1/picture-1.jpg`
`fileSize` | string | [File size](https://www.php.net/manual/en/splfileinfo.getsize.php), in bytes, for example: 404779
`relativeMediaFilePath` | string | Path to file relative to the media folder, for example: `/my-galleries/gallery-1/picture-1.jpg`
`relativeFilePath` | string | Path to file relative to the website, for example: `/storage/app/media/my-galleries/gallery-1/picture-1.jpg`
`uploaded` | string | [Last modified time](https://www.php.net/manual/en/splfileinfo.getmtime.php) for files uploaded using the Media Manager, or the upload time for files uploaded using the back-end gallery tab, you can then: `$currentTime->format( 'c' );`
`url` | string | URL to file, for example: `https://www.mywebsite.com/storage/app/media/my-galleries/gallery-1/picture-1.jpg`

> Hint: To dig into the `galleryItems` (or any other) variable/collection, you have two options. You can simply add `{{ dump(embeddedGallery.galleryitems.toArray) }}` on your page after the component definition and it will print debug information about that variable straight in your page. Alternatively, you can install the [Debugbar plugin](https://github.com/scottbedard/oc-debugbar-plugin) and then add `{{ debug(embeddedGallery.galleryitems) }}` to your page to show debug information in the Laravel debugbar. Make sure to replace "embeddedGallery" with the alias of your component as set in the component options!

**Additional Page Properties**

**`__SELF__.defaultgalleryoptions`**
Type: string
Used in the embedded gallery default template, this holds any custom script options set for the component in the "Script Options" property, along with any generated options (for example: `gallery_theme: 'tiles', tiles_type: 'justified'`)

**`__SELF__.defaultlightboxoptions`**
Type: string
Used in the lightbox gallery default template, this holds any custom script options set for the component in the "Script Options" property, along with the following: `gallery_theme: 'lightbox'`

**`__SELF__.customgalleryscript`**
Type: string
The "Custom Gallery Script" set on the plugin backend settings page, if the "Custom Gallery Script" toggle switch is set to "ON".

**`__SELF__.customlightboxscript`**
Type: string
The "Custom Lightbox Script" set on the plugin backend settings page, if the "Custom Lightbox Script" toggle switch is set to "ON".

**`__SELF__.error`**
Type: string
If the plugin encounters an error, you can find the error description here.
</details>

# Known Issues

### Issue including CSS when used in a partial
OctoberCMS has a [known issue](https://stackoverflow.com/questions/53815815/on-octobercms-inject-css-from-partial) where if a component is dropped into a partial then any CSS that is added to the page by the partial is never actually rendered. This only occurs if the partial is directly inside of a layout, and if the `{% styles %}` tag is included before the partial.

Workarounds:

 - Add your `{% styles %}` *after* your `{% partial "..." %}`
 - OR Put your partial inside of a page, and include the page in the layout
 - OR Manually add the required CSS to your layout

# Support

Feel free to [file an issue](https://github.com/lieszkol/november-gallery/issues/new). Feature requests are always welcome.

If there's anything you'd like to chat about, please join the NovemberGallery  [Gitter chat](https://gitter.im/november-gallery/community)!

# Credits / Major Dependencies

 - [UniteGallery jQuery Gallery Plugin](https://github.com/vvvmax/unitegallery)
 - [Swiper](https://idangero.us/swiper/)
 - OctoberCMS [Image Resizer plugin](https://octobercms.com/plugin/toughdeveloper-imageresizer)
 - [OctoberCMS]([https://github.com/octobercms/october](https://github.com/octobercms/october)) :-)

Made with ♥ in Budapest, Hungary by [László Lieszkovszky](https://www.lieszkovszky.com) ❖ [ZenSoft Hungary](https://www.zenware.io)