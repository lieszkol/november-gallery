
![NovemberGallery Banner](/media/november-gallery-octobercms-banner.jpg)

<div align="right"><a href="https://gitter.im/november-gallery/community?utm_source=badge&amp;utm_medium=badge&amp;utm_campaign=pr-badge&amp;utm_content=badge"><img src="https://badges.gitter.im/november-gallery/community.svg" alt="Join the chat at https://gitter.im/november-gallery/community"></a></div>

Check out the live demo site!

A gallery plugin for OctoberCMS that tries to Keep It Simple and Stupid.

 1. Upload your images using the Media Manager built into OctoberCMS
 2. Drop November Gallery onto your page or partial
 3. Select the folder you uploaded your images to and how you want them displayed

Behind the scenes, November Gallery makes use of the [Image Resizer plugin](https://octobercms.com/plugin/toughdeveloper-imageresizer) to generate thumbnails of your images, and the excellent [UniteGallery jQuery Gallery Plugin](https://github.com/vvvmax/unitegallery). 

## Fetaures:

- Three components included: 
	 - Embedded Gallery if you wish to show a gallery of images in your page
	 - Popup Lightbox for galleries that can be opened from a link or button on your page
	 - Image List Only if you want to handle the display of the images yourself
 - Various options for the Embedded Gallery that can be configured in the back-end without writing a line of code: 
	 - tiles (arranged in columns, justified, or laid out in a grid)
	 - carousel
	 - slider
	 - combined (large image + lightbox)
	 - video
 - Set which folder of images to display in the component configuration panel OR pass it dynamically as a page-variable
 - Responsive/touch enabled/skinnable/themable/gallery buttons/keyboard control etc.

### Limitations / ToDo:
 
 - [ ] Ability to add to pages (not just CMS)
 - [ ] Carousels!
 - [ ] Alternative lightbox gallery script support
 - [ ] Sort the displayed images by file date, date taken, or filename
 - [ ] Support titles & captions embedded into the image files, or in sidecar files (with support for multiple languages)
 - [ ] Test embedding & linking video
 - [ ] Get the demo page up and running
 - [ ] Extensive help docs

## Deployment

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

To install from the  [Marketplace](https://octobercms.com/plugins): click `Add to Project` and select the project you wish to use the plugin on. Once the plugin has been added to your project, from the backend area of your site click the `Check for updates` button on the **Settings → Updates & Plugins** page to pull in the plugin. You may also need to fix your permissions (`chown -R www-data:www-data /srv/www/october/plugins/zenware` on Ubuntu).

To install from [the repository](https://github.com/lieszkol/november-gallery): clone it into the **/plugins/** folder of your site and then run  `sudo php artisan plugin:refresh zenware.novembergallery`  from your project root.

## Usage

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

# Component: Embedded Gallery

Use this if you wish to show a gallery of images within your page using various layouts, with optional full-screen (lightbox-style) viewing.

### [Options]
The following are available in addition to the [Shared Options](#shared-options) described above:
Property | Inspector Name | Description
--|--|--
`galleryLayout`|Gallery Layout|Select a gallery layout.<br>Possible values are:<br>- `default` / Default (use the gallery layout set on the plugin settings page)<br>- `gallery_tiles` / Tiles<br>- `gallery_carousel` / Carousel<br>- `gallery_combined` / Combined<br>- `gallery_slider` / Slider<br>- `gallery_video` / Video<br>Check out <a href="http://unitegallery.net" target="_blank">UniteGallery.net</a> for live examples of each layout.
`tilesLayout`|Tile Layout|Only applicable if the *Gallery Layout* is set to "Tiles"; possible values are:<br>- `default` / Default (use the default gallery layout set on the plugin settings page)<br>- `gallery_tiles_columns` / Columns<br>- `gallery_tiles_justified` / Justified<br>- `gallery_tiles_nested` /  Nested<br>- `gallery_tiles_grid` / Grid
`combinedLayout`|Thumbnails Layout|Only applicable if the *Gallery Layout* is set to "Combined"; possible values are:<br>- `default` / Default (use the default thumbnails layout set on the plugin settings page)<br>- `gallery_combined_default` / Normal (default)<br>- `gallery_combined_compact` / Compact<br>- `gallery_combined_grid` /  Grid
`additional_gallery_options`|Script options|Additional JS options that you want passed onto the UniteGallery script, for example: `theme_panel_position: "bottom"`

For an explanation of page propreties, see [Component: Image List Only](#component-image-list-only). For a more in-depth explanation as well as examples, see [The NovemberGallery Manual](https://its.zensoft.hu/books/november-gallery-for-octobercms)

# Component: Pop-up Lightbox

Use this if you wish to add a lightbox-style 'pop-up' gallery to your page that is only shown when the user clicks on an element (such as a link/button/image).

### [Options]
The following are available in addition to the [Shared Options](#shared-options) described above:
Property | Inspector Name | Description
--|--|--







# Component: Image List Only

Use this if you wish to write your own Twig script for displaying your images, and only need a list of images (that can be found in a given folder) to be loaded into a page variable. 

The image list component does not have any options other than the [Shared Options](#shared-options) described above.

**Example 1**
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

**Example 2**
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

<details>
<summary>Read more...</summary>

### [Page Properties]

**`__SELF__.error`**
Type: string
If the plugin encounters an error, you can find the error description here.

**`__SELF__.galleryitems`**
Type: [October\Rain\Support\Collection](https://octobercms.com/docs/services/collections) also see [API Docs](https://octobercms.com/docs/api/october/rain/database/collection),  [Illuminate\Database\Eloquent\Collection](https://laravel.com/api/5.5/Illuminate/Database/Eloquent/Collection.html) and [Illuminate\Support\Collection](https://laravel.com/api/5.5/Illuminate/Support/Collection.html)

Collection of `ZenWare\NovemberGallery\Classes\GalleryItem` classes. Serving it as a collection gives access to a ton functionality that is not available with a simple array. For example, you could choose to sort the images by filename:
```
{% for galleryitem in customGallery.galleryitems.sortBy('fileName') %}
   <img src="{{ galleryitem.galleryItemSrc }}" />
{% endfor %}
```

#### GalleryItem Properties



Property | Type | Description
--|--|--
`file` | [SplFileInfo](https://www.php.net/manual/en/class.splfileinfo.php) | A standard php file information object
`fileName` | string | The name of the file, with extension
`fileBasename` | string | Base name of the file
`fileATime` | string | Gets last access time of the file
`fileCTime` | string | Gets the inode change time
`fileExtension` | string | Gets the file extension
`fileName` | string | The name of the file, with extension
`fileMTime` | string | Gets the last modified time
`filePath` | string | Gets the path without filename
`filePathname` | string | Gets the path to the file
`fileRealPath` | string | Gets absolute path to file
`fileSize` | string | Gets file size
`fileType` | string | Gets file type
`relativeMediaFilePath` | string | Path to file relative to the media folder

**Hint:** To dig into the `galleryItems` (or any other) variable/collection, you have two optoins. You can simply add `{{ dump(embeddedGallery.galleryitems.toArray) }}` on your page after the component definition and it will print debug information about that variable straight in your page. Alternatively, you can install the <a href="https://github.com/scottbedard/oc-debugbar-plugin">Debugbar plugin</a> and then add `{{ debug(embeddedGallery.galleryitems) }}` to your page to show debug information in the Laravel debugbar. Make sure to replace "embeddedGallery" with the alias of your component as set in the component options!
</details>

## Support

Feel free to [file an issue](https://github.com/lieszkol/november-gallery/issues/new). Feature requests are always welcome.

If there's anything you'd like to chat about, please join the NovemberGallery  [Gitter chat](https://gitter.im/november-gallery/community)!

## License

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

## Credits / Major Dependencies

 - [UniteGallery jQuery Gallery Plugin](https://github.com/vvvmax/unitegallery)
 - OctoberCMS [Image Resizer plugin](https://octobercms.com/plugin/toughdeveloper-imageresizer)
 - [OctoberCMS]([https://github.com/octobercms/october](https://github.com/octobercms/october)) :-)

<p align="center">Created by <a href="http://www.lieszkovszky.com/" rel="nofollow">László Lieszkovszky</a> ❖ <a href="http://www.zensoft.hu/" rel="nofollow">ZenSoft Hungary</a></p>
<!--stackedit_data:
eyJoaXN0b3J5IjpbLTIyMTY3NDczMywtMTQ1MjM2NDU5NSwxND
EzMjM3ODQ5LC0xMzkzMDk4MDc4LDk3Mjc0NTg0NCwyMDM0NjMx
ODQ3LDIwNjUwODkzNTAsLTE0NjI2NDc4MTEsMTI0NzAxNzI0Ny
w3MDAxMjk4MjUsMTA1ODA0MzExNCwxNzc2MjIxMTIwLDE0ODUz
ODkyMzMsLTY4MjQzODk2Nyw1MDI3ODEyNjcsLTI2MjIwNjQwOS
wxNDg4MzAyMDU4LC02NDkzOTIzNzMsLTE2MjM3MTI0MjQsLTE5
NjM4NTk0NjZdfQ==
-->