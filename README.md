

![NovemberGallery Banner](/media/november-gallery-octobercms-banner.jpg)

<div align="right"><a href="https://gitter.im/november-gallery/community?utm_source=badge&amp;utm_medium=badge&amp;utm_campaign=pr-badge&amp;utm_content=badge"><img src="https://badges.gitter.im/november-gallery/community.svg" alt="Join the chat at https://gitter.im/november-gallery/community"></a></div>

Check out the live demo site!

A gallery plugin for OctoberCMS that tries to Keep It Simple and Stupid.

 1. Upload your images using the Media Manager built into OctoberCMS
 2. Drop November Gallery onto your page or partial
 3. Select the folder you uploaded your images to and how you want them displayed

Behind the scenes, November Gallery makes use of the [Image Resizer plugin](https://octobercms.com/plugin/toughdeveloper-imageresizer) to generate thumbnails of your images, and the excellent [UniteGallery jQuery Gallery Plugin](https://github.com/vvvmax/unitegallery). 

# Features:

- Four components included: 
	 - **Embedded Gallery** if you wish to show a gallery of images in your page
	 - **Popup Lightbox** for galleries that can be opened from a link or button on your page, with several available styles (wide, compact)
	 - **Video Gallery** for...videos, again, with several "styles" available (thumbs / titles + subtitles / titles only)
	 - **Image List Only** if you want to handle the display of the images yourself and only need a list of image objects that you uploaded to a specific folder using the OctoberCMS Media Manager
 - Various options for the Embedded Gallery that can be configured in the back-end or overridden in the component inspector without writing a line of code: 
	 - tiles (arranged in columns, justified, or laid out in a grid)
	 - carousel
	 - slider
	 - combined (large image + lightbox)
 - Set which folder of images to display in the component configuration panel OR pass it dynamically as a page-variable
 - Responsive/touch enabled/skinnable/themable/gallery buttons/keyboard control etc.

### Limitations / ToDo:
 
 - [X] Test embedding & linking video
 - [X] Get the demo page up and running
 - [ ] Add example for "dynamic" gallery via path variables
 - [ ] Add link to default component templates
 - [ ] Ability to add to pages (not just CMS)
 - [ ] Alternative lightbox/carousel gallery script support
 - [ ] Sort the displayed images by file date, date taken, or filename
 - [ ] Support titles & captions embedded into the image files, or in sidecar files (with support for multiple languages)
 - [ ] Extensive help docs

# Deployment

<blockquote>
<p><strong>Note</strong>: You must have a <code>{% styles %}</code> and <code>{% scripts %}</code> tag in your page header/footer so that the plugin can inject the required assets.</p>
</blockquote>

```html
<head>
    ...
    {% styles %}
</head>
<body>
    ...
    {% scripts %}
</body>
```
For more information see the [OctoberCMS docs](https://octobercms.com/docs/cms/pages#injecting-assets)!

### Installation

To install from your site "backend": go to  **Settings → Updates & Plugins → Install Plugins**  and then search for  "November Gallery".

To install from the  [Marketplace](https://octobercms.com/plugins): click `Add to Project` and select the project you wish to use the plugin on. Once the plugin has been added to your project, from the backend area of your site click the `Check for updates` button on the **Settings → Updates & Plugins** page to pull in the plugin.

To install from [the repository](https://github.com/lieszkol/november-gallery) (not recommended), you'd have to first install the imageresizer plugin.

<details>
<summary>Read more...</summary>

Here's an actual (abridged) transcript of an installation into a fresh install of October (all commands for Ubuntu, make sure adjust to your environment): 

```bash
USER@SERVER:/var/www/novembergallery.zenware.io/public_html# sudo git clone https://github.com/toughdeveloper/oc-imageresizer-plugin.git plugins/toughdeveloper/imageresizer
Cloning into 'plugins/toughdeveloper/imageresizer'...
...
USER@SERVER:/var/www/novembergallery.zenware.io/public_html# sudo git clone https://github.com/lieszkol/november-gallery.git plugins/zenware/novembergallery
Cloning into 'plugins/zenware/novembergallery'...
...
USER@SERVER:/var/www/novembergallery.zenware.io/public_html# sudo chown -R www-data:www-data plugins/toughdeveloper/
USER@SERVER:/var/www/novembergallery.zenware.io/public_html# sudo chown -R www-data:www-data plugins/zenware/
USER@SERVER:/var/www/novembergallery.zenware.io/public_html# sudo -u www-data php artisan plugin:refresh toughdeveloper.imageresizer
Rolled back: ToughDeveloper.ImageResizer
Reinstalling plugin...
ToughDeveloper.ImageResizer
...
USER@SERVER:/var/www/novembergallery.zenware.io/public_html# sudo -u www-data php artisan plugin:refresh zenware.novembergallery
Rolled back: ZenWare.NovemberGallery
Reinstalling plugin...
ZenWare.NovemberGallery
- v1.0.1:  First version of NovemberGallery
```

</details>

# Usage

For further usage examples and documentation please see [The NovemberGallery Manual](https://its.zensoft.hu/books/november-gallery-for-octobercms)

### (1) Prepare and Upload your Images

You will need to 1) create folders for your images 2) resize your images and 3) upload them to your website using OctoberCMS's built-in Media Manager. 

<details>
<summary>Read more...</summary>

Although you can use any folder structure that you'd like, we recommend that you create a folder and create separate folders underneath that folder to store your albums. We also recommend not to use spaces in folder names - it's better to use dashes or underscores instead. Also, it is customary to use lowercase when creating folders for publishing on the web. 

So, your folder structure may look like this:

- my_galleries
	- my_travels
		- 2018-argentina
		- 2015-vietnam
		- 2010-hungary
	- cat_pictures
	- awesome_vacuum_cleaners

Next, prepare your pictures for display on the WWW. First, make sure that your photos are in a format that web browsers understand. This can be .jpg or .png, or .gif (which is more suitable for graphics with fewer colors and geometric lines, such as charts or icons).

Although the plugin will automatically generate thumbnails of your pictures, the full-size images will be displayed as-is. Therefore, it's also a good idea to resize all of your pictures before uploading them to the gallery. A plethora of free options exist to help you with that, I highly recommend [FastStone Image Viewer](https://www.faststone.org) (Windows), [Fast Image Resizer](https://adionsoft.net/) (Windows), or [Image Resizer for Windows](http://www.bricelam.net/ImageResizer/) (Windows). I'm sure there are great options for Mac as well - but [watch a little Louis Rossmann](https://www.youtube.com/user/rossmanngroup) to understand why Macs are evil so if you're on a Mac I'm sorry but I can't help you :-(

A typical screen resolution nowadays is around 1600x1200 pixels - so if you're looking to allow your users to see your pictures in decent quality full-screen, then resize them to fit within these constraints.

Finally, upload your pictures using the OctoberCMS Media manager into the folders you created earlier.
</details>

### (2) Configure The Plugin
Log into your "backend" and go to Settings → November Gallery to configure your defaults. Things to look out for:

 - `Settings` Tab: Select the folder that you created your galleries under from the Base Media Folder drop-down, you can also select a default layout for your galleries. 
- `Thumbnails` Tab: It is recommended to use the image resizer to automatically generate thumbnails of your pictures. For this, make sure that the "Use Image Resizer" option is ON on the Thumbnails plugin configuration tab. You can also set either the width or the height for your thumbnails here.
- `Advanced` Tab: *Inject UniteGallery Assets* should probably be on. If your theme already includes jQuery, then you can set *Inject jQuery* to OFF.

### (3) Drop the Plugin Onto your CMS Page(s)

The plugin provides three components that you can drop onto your CMS Pages/Partials/Layouts.


### [Shared Options]

Property | Inspector Name | Description
--|--|--
`alias`|Alias|Standard OctoberCMS stuff, you refer to the component in  your page via this unique identifier, the default is "embeddedGallery" but you can change it to anything you want (don't use spaces or special characters though!)
`maxItems`|Max Images|The maximum number of images to display
`mediaFolder`|Media Folder|Select the folder that you uploaded the images to in the OctoberCMS Media manager. Only folders under the "Base Media Folder" set on the November Gallery settings page are valid.
<br>
<br>

## Component 1: Embedded Gallery

Use this if you wish to show a gallery of images within your page using various layouts, with optional full-screen (lightbox-style) viewing.

### [Options]
The following are available in addition to the [Shared Options](#shared-options) described above:

Property | Inspector Name | Description
-- | -- | --
`galleryLayout` | Gallery Layout | Select a gallery layout; possible values are:<br><small>- `default` / Default (use the gallery layout set on the plugin settings page)<br>- `gallery_tiles` / Tiles<br>- `gallery_carousel` / Carousel<br>- `gallery_combined` / Combined<br>- `gallery_slider` / Slider<br>Check out <a href="https://novembergallery.zenware.io/demo/embedded-gallery-tiles" target="_blank">the demo site</a> for live examples of each layout.</small>
`tilesLayout` | Tile Layout | Only applicable if the *Gallery Layout* is set to "Tiles"; possible values are:<br><small>- `default` / Default (use the default gallery layout set on the plugin settings page)<br>- `gallery_tiles_columns` / Columns<br>- `gallery_tiles_justified` / Justified<br>- `gallery_tiles_nested` /  Nested<br>- `gallery_tiles_grid` / Grid</small>
`combinedLayout` | Thumbnails Layout | Only applicable if the *Gallery Layout* is set to "Combined"; possible values are:<br><small>- `default` / Default (use the default thumbnails layout set on the plugin settings page)<br>- `gallery_combined_default` / Normal (default)<br>- `gallery_combined_compact` / Compact<br>- `gallery_combined_grid` /  Grid</small>
`additionalGalleryOptions` | Script options | Additional JS options that you want passed onto the UniteGallery script, for example: `theme_panel_position: "bottom"`
`imageResizerWidth` | Thumbnail Width | Width of the generated thumbnail; Leave empty or set to 0 to only constrain the image by height; leave both width and height empty to fall back on the values set on the backend plugin configuration page
`imageResizerHeight` | Thumbnail Height | Height of the generated thumbnail; Leave empty or set to 0 to only constrain the image by height; leave both width and height empty to fall back on the values set on the backend plugin configuration page
`imageResizerMode` | Thumbnail Mode | Select how to resize your images into thumbnails, or select "default" to use the thumbnail mode set on the plugin settings page; possible values are: <small><br>- Default<br>- Exact<br>- Portrait<br>- Landscape<br>- Auto<br>- Crop</small>
`galleryWidth` | Gallery Width | Can be a number (pixel lenght) or a percent (of the parent container). Leave empty to fall back on the values set on the backend plugin configuration page
`galleryHeight` | Gallery Height| Only applies to "Combined" and "Slider" galleries! Can be a number (pixel lenght) or a percent (of the parent container). Leave empty to fall back on the values set on the backend plugin configuration page

For an explanation of page propreties, see [Component: Image List Only](#component-image-list-only). For a more in-depth explanation as well as examples, see [The NovemberGallery Manual](https://its.zensoft.hu/books/november-gallery-for-octobercms)

### [Customizing the Gallery]

You have several options to customize how your gallery looks and behaves, depending on how deep you are willing to go down the rabbit hole:

 1. You can customize the gallery to some extent through the inspector; for example, you can set the gallery layout
 2. You can also add some CSS to control how the thumbnails are displayed
 3. You can add some custom options that will be passed onto the UniteGallery script via the inspector
 4. You can override the component partial

<details>
<summary>Read more...</summary>

**Example 1: Set the thumbnail size for all galleries**

You can set the thumbnail size on the plugin backend settings page: **Settings → November Gallery → Thumbnails**. If you want more control, go to **Settings → Image Resizer Settings**

**Example 2: Set the thumbnail size for an individual gallery**

You can set the thumbnail size for a specific gallery on the component properties page (a.k.a. "Inspector").

**Example 3: Set the gallery dimensions for the "combined" gallery**

In the combined gallery, a large image is displayed along with a row of thumbnails. First, set your thumbnail size using the inspector let's say to 100. 
Then check the [relevant options available](http://unitegallery.net/index.php?page=default-options) for the combined gallery on the UniteGallery plugin page. You can see that the "gallery_width" and "gallery_height" options control the overall size of the gallery. So enter something like the following into the *Script options* component option: `gallery_width:900,gallery_height:700,thumb_fixed_size:false`

The thumbnail size you defined using the inspector will control the size of the generated thumbnails, it will also automatically add a "thumb_height" option to the gallery. You can override this if you wish by manually adding a "thumb_height" option under *Script options*, but this should not be necessary. The `thumb_fixed_size:false` setting enables dynamically sized thumbnails.

**Example 4: Set the spacing between tiled images**

First, review [what options you have for the various tiled galleries](http://unitegallery.net/index.php?page=tiles-columns-options) on the UniteGallery website. You can see that for the Tiles - Columns layout,  you can control the spacing between the columns with the `tiles_space_between_cols:  3` option -- so add it to the *Script options* NovemberGallery component option!

**Example 5: Override the component partial**

It is easy to override the default partial by following the [OctoberCMS documentation](https://octobercms.com/docs/cms/components#overriding-partials). All you have to do is go to your `Partials` and create a folder with the same name as the alias of your gallery. Create a "default.htm" file in that directory and copy the contents of the default component partial for the given gallery type into this folder. 

Gallery Type | Default Component Partial Path
-- | --
Embedded Gallery | /plugins/zenware/novembergallery/components/embeddedgallery/default.htm
Pop-up Lightbox | /plugins/zenware/novembergallery/components/popupgallery/default.htm
Image List Only | /plugins/zenware/novembergallery/components/customgallery/default.htm

</details>
<br>
<br>

## Component 2: Pop-up Lightbox

Use this if you wish to add a lightbox-style 'pop-up' gallery to your page that is only shown when the user clicks on an element (such as a link/button/image).

### [Options]
The following are available in addition to the [Shared Options](#shared-options) described above:

Property | Inspector Name | Description
-- | -- | --
`attachTo` | Attach to | JQuery selector for the element(s) that the user can click on to open the lightbox; for example: `#gallery-button`
`additionalLightboxOptions` | Script options | Additional JS options that you want passed onto the UniteGallery script, for example: `theme_panel_position: "bottom"`


**Example Page**
```html
{% component 'popupLightbox' %}
<button id="gallery-button">Click me!</button>
```

This is a simple example where you place a button onto the page. Select a folder of images from the "Media Folder" drop-down in your inspector, and set the gallery "Attach to" option to `#gallery-button`. Your button should then serve to open a lightbox gallery of all of the images in the selected folder.

For examples on how to customize the gallery, see [Customize the Gallery](#customizing-the-gallery) above.
<br>
<br>

## Component 3: Video Gallery

Use this gallery to display videos inline. You can choose to upload your videos to your website or to show videos hosted on YouTube/Vimeo/Wistia.

### [Options]
The following are available in addition to the [Shared Options](#shared-options) described above:

Property | Inspector Name | Description
-- | -- | --
`videoGalleryItemsSelector` | Gallery Selector/ID | JQuery selector for the element that holds the video items; for example: `#videos`
`videoGalleryLayout` | Gallery Layout | Select a gallery layout; possible values are:<br><small>- `default` / Default (use the gallery layout set on the plugin settings page)<br>- `video_gallery_right_thumb` / Thumbnails <br>- `video_gallery_right_title_only` / Titles Only<br>- `video_gallery_right_no_thumb` / No Thumbnails<br>Check out <a href="https://novembergallery.zenware.io/demo/video-gallery" target="_blank">the demo site</a> for live examples of each layout.</small>
`additionalVideoGalleryOptions` | Script Options | Additional JS options that you want passed onto the UniteGallery script, for example: `theme_autoplay: true`
`imageResizerHeight` | Thumbnail Height | Height of the generated thumbnail; Leave empty or set to 0 to only constrain the image by height; leave both width and height empty to fall back on the values set on the backend plugin configuration page
`imageResizerMode` | Thumbnail Mode | Select how to resize your images into thumbnails, or select "default" to use the thumbnail mode set on the plugin settings page; possible values are: <small><br>- Default<br>- Exact<br>- Portrait<br>- Landscape<br>- Auto<br>- Crop</small>
`galleryWidth` | Gallery Width | Can be a number (pixel lenght) or a percent (of the parent container). Leave empty to fall back on the values set on the backend plugin configuration page
`galleryHeight` | Gallery Height| Only applies to "Combined" and "Slider" galleries! Can be a number (pixel lenght) or a percent (of the parent container). Leave empty to fall back on the values set on the backend plugin configuration page

**Example Page**
```html
{% component 'popupLightbox' %}
<button id="gallery-button">Click me!</button>
```

This is a simple example where you place a button onto the page. Select a folder of images from the "Media Folder" drop-down in your inspector, and set the gallery "Attach to" option to `#gallery-button`. Your button should then serve to open a lightbox gallery of all of the images in the selected folder.

For examples on how to customize the gallery, see [Customize the Gallery](#customizing-the-gallery) above.
<br>
<br>

## Component 4: Image List Only

Use this if you wish to write your own Twig script for displaying your images, and only need a list of images (that can be found in a given folder) to be loaded into a page variable. 

The image list component does not have any options other than the [Shared Options](#shared-options) described above.

**Example Page 1**
```html
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
```html
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

### Page Properties

**`__SELF__.galleryitems`**<br>
Type: [October\Rain\Support\Collection](https://octobercms.com/docs/services/collections)<br>
also see [API Docs](https://octobercms.com/docs/api/october/rain/database/collection),  [Illuminate\Database\Eloquent\Collection](https://laravel.com/api/5.5/Illuminate/Database/Eloquent/Collection.html) and [Illuminate\Support\Collection](https://laravel.com/api/5.5/Illuminate/Support/Collection.html)

Collection of `ZenWare\NovemberGallery\Classes\GalleryItem` classes. Serving it as a collection gives access to a ton functionality that is not available with a simple array. For example, you could choose to sort the images by filename:
```html
{% for galleryitem in customGallery.galleryitems.sortBy('fileName') %}
   <img src="{{ galleryitem.galleryItemSrc }}" />
{% endfor %}
```
<details>
<summary>Read more...</summary>

#### GalleryItem Properties

Property | Type | Description
--|--|--
`file` | [SplFileInfo](https://www.php.net/manual/en/class.splfileinfo.php) | A standard php file information object
`fileBasename` | string | [Base name of the file](https://www.php.net/manual/en/splfileinfo.getbasename.php), for example: picture-1.jpg
`fileATime` | UNIX time | [Last access time of the file](https://www.php.net/manual/en/splfileinfo.getatime.php), for example: 1550704585
`fileCTime` | string | [Inode change time](https://www.php.net/manual/en/splfileinfo.getctime.php), for example: 1550704585
`fileExtension` | string | [File extension](https://www.php.net/manual/en/splfileinfo.getextension.php), for example: jpg
`fileName` | string | [Filename](https://www.php.net/manual/en/splfileinfo.getfilename.php), for example: picture-1.jpg
`fileMTime` | string | [Last modified time](https://www.php.net/manual/en/splfileinfo.getmtime.php), for example: 1550704585
`filePath` | string | [Path without filename](https://www.php.net/manual/en/splfileinfo.getpath.php), for example: <small>/var/www/mywebsite.com/public_html/storage/app/media/my-galleries/gallery-1</small>
`filePathname` | string | [Path to the file](https://www.php.net/manual/en/splfileinfo.getpathname.php), for example: <small>/var/www/mywebsite.com/public_html/storage/app/media/my-galleries/gallery-1/picture-1.jpg</small>
`fileRealPath` | string | [Absolute path to file](https://www.php.net/manual/en/splfileinfo.getrealpath.php), for example: <small>/var/www/mywebsite.com/public_html/storage/app/media/my-galleries/gallery-1/picture-1.jpg</small>
`fileSize` | string | [File size](https://www.php.net/manual/en/splfileinfo.getsize.php), in bytes, for example: 404779
`fileType` | string | [Gile type](https://www.php.net/manual/en/splfileinfo.gettype.php), for example: "file"
`relativeMediaFilePath` | string | Path to file relative to the media folder, for example: /my-galleries/gallery-1/picture-1.jpg
`relativeFilePath` | string | Path to file relative to the website, for example: <small>/storage/app/media/my-galleries/gallery-1/picture-1.jpg</small>
`url` | string | URL to file, for example: <small>https://www.mywebsite.com/storage/app/media/my-galleries/gallery-1/picture-1.jpg</small>

<br>
<blockquote><p><strong>Hint:</strong> To dig into the <code>galleryItems</code> (or any other) variable/collection, you have two optoins. You can simply add <code>{{ dump(embeddedGallery.galleryitems.toArray) }}</code> on your page after the component definition and it will print debug information about that variable straight in your page. Alternatively, you can install the <a href="https://github.com/scottbedard/oc-debugbar-plugin">Debugbar plugin</a> and then add <code>{{ debug(embeddedGallery.galleryitems) }}</code> to your page to show debug information in the Laravel debugbar. Make sure to replace "embeddedGallery" with the alias of your component as set in the component options!</p></blockquote>
<br>

**Additional Page Properties**

**`__SELF__.defaultgalleryoptions`**
Type: string
Used in the embedded gallery default template, this holds any custom script options set for the component in the "Script Options" property, along with any generated options (for example: `gallery_theme: "tiles", tiles_type: "justified"`)

**`__SELF__.defaultlightboxoptions`**
Type: string
Used in the lightbox gallery default template, this holds any custom script options set for the component in the "Script Options" property, along with the following: `gallery_theme: "lightbox"`

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

# Support

Feel free to [file an issue](https://github.com/lieszkol/november-gallery/issues/new). Feature requests are always welcome.

If there's anything you'd like to chat about, please join the NovemberGallery  [Gitter chat](https://gitter.im/november-gallery/community)!

# License

This plugin is available in two editions: 

 1. The Personal Edition is a free plugin meant for non-profit use, such as:
	 2. Building a personal website that is not offering a product or services for sale
	 3. Academic use
	 4. Use by non-profit organizations
 2. The Professional Edition is meant for commercial use, such as:
	 1. A website selling or promoting products or services
	 2. Use by a for-profit organization

Both versions are available from the OctoberCMS Marketplace.

Commercial Use governed by the  [OctoberCMS Marketplace Purchased License](https://octobercms.com/help/license/regular)

# Credits / Major Dependencies

 - [UniteGallery jQuery Gallery Plugin](https://github.com/vvvmax/unitegallery)
 - OctoberCMS [Image Resizer plugin](https://octobercms.com/plugin/toughdeveloper-imageresizer)
 - [OctoberCMS]([https://github.com/octobercms/october](https://github.com/octobercms/october)) :-)

<p align="center">Created by <a href="http://www.lieszkovszky.com/" rel="nofollow">László Lieszkovszky</a> ❖ <a href="http://www.zensoft.hu/" rel="nofollow">ZenSoft Hungary</a></p>
<!--stackedit_data:
eyJoaXN0b3J5IjpbLTg0MDg2Nzk4MCwzNDkyNTMxNjQsLTczMz
c2NDk0Myw0MzA3NTY4MTksMTczMDExMzEyMywzMjA0ODgyMTMs
LTMyOTU2MzI5NiwtMTY0NDI5MDcyMSwtMTE1ODY2ODYyMCw2Nj
MxNDgwNjEsLTE2MzIwOTk3OTMsLTYzMDI1MDc2NiwtMjA1ODUy
NTQ1NCw3NDIxMTU2MiwtMTgyOTg2NDA2MywxOTc1MjkzMjU3LC
0xODgyMjgxNjYyLC0xMTMyODMzMjkyLC0xNTkyNjk5ODI4LC0x
NTc5ODQ3NjJdfQ==
-->