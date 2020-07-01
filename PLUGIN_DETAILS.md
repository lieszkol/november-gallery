Check out the [live demo site](https://novembergallery.zenware.io)!

A gallery plugin for professional Photographers, Media Artists, Bloggers and Content Publishers.

> November Gallery enables you to display folders of images that you've uploaded to your website as galleries. This greatly helps digital publishers since they no longer have to rely on a clunky "Gallery" interface to upload their images, they can use FTP or whatever tool of their choice. BUT a "Clunky" back-end gallery interface is still provided if you wish to add titles and subtitles to your images, and it adds some other features not available with "folder-based" galleries. Once uploaded, you can select from many different ways to present your images to your visitors, such as: in-page gallery, clickable tiles laid out masonry style, a pop-up "light-box" type gallery, a responsive "swiper", etc. You can also show videos.

 1. Upload your images either using the Media Manager built into OctoberCMS or through the dedicated galleries backend page
 3. Drop November Gallery onto your page or partial or static page
 4. Select the folder you uploaded your images to and how you want them displayed using the component inspector, or in your RainLab blog entry

Behind the scenes, November Gallery makes use of the [Image Resizer plugin](https://octobercms.com/plugin/toughdeveloper-imageresizer) to generate thumbnails of your images, and the excellent [UniteGallery jQuery Gallery Plugin](https://github.com/vvvmax/unitegallery) as well as [Swiper](https://idangero.us/swiper/). 

*Please note that November Gallery is in no way affiliated with OctoberCMS, I just really liked the idea of naming things after months and November is one of my favorites!*

# Features:

- Works in Pages, Partials, "Static" Pages, and Blog Posts!
- Five components included: 
	 - **Embedded Gallery** if you wish to show a gallery of images or thumbnails in your page, arranged in various layouts: **tiles** (arranged in columns, justified, or laid out in a grid "masonry style"), **carousel**, **slider**, or **combined** (large image + lightbox)
	 - **Swiper Gallery** for responsive, multi-platform galleries
	 - **Popup Lightbox** for galleries that can be opened from a link or button on your page, with several available styles (wide, compact)
	 - **Video Gallery** for...videos, again, with several "styles" available (thumbs / titles + subtitles / titles only)
	 - **Image List Only** if you want to handle the display of the images yourself and only need a list of image objects
- Set which folder of images to display in the component configuration panel OR pass it dynamically as a page-variable OR set it in your RainLab blog entry
- Responsive/touch enabled/skinnable/themable/gallery buttons/keyboard control etc.

# Usage

### (1) Prepare and Upload your Images

You can choose to upload your images either using the "Gallery" page in the October back-end, or you can use the built-in Media Manager. 

> Hint: The dedicated back-end November Gallery management page gives you more options for giving your images titles and subtitles, and you can also arrange the order easily; on the other hand, if you ever end up deleting the plugin, October will also delete all of your albums created there. Use the October built-in Media Manager to upload your images if you don't need the extra features provided by the November Gallery management page. Going the Media Manager route also allows you to upload hundreds of images using an FTP client or other file manager; this is not possible through the Gallery page.


Although the plugin will automatically generate thumbnails of your pictures, the full-size images will be displayed as-is. Therefore, it's a good idea to resize all of your pictures before uploading them to the gallery. A plethora of free options exist to help you with that, we ♥ [FastStone Image Viewer](https://www.faststone.org) (Windows), [Fast Image Resizer](https://adionsoft.net/) (Windows), and [Image Resizer for Windows](http://www.bricelam.net/ImageResizer/). There are great options out there for Mac as well. A typical screen resolution nowadays is around 1920 x 1680 pixels - so if you're looking to allow your users to see your pictures in top quality full-screen, then resize them to fit within these constraints.

Also, make sure that your photos are in a format that web browsers understand, such as .jpg or .png, or .gif (the latter is more suitable for graphics with fewer colors and geometric lines, such as charts or icons).

Finally, upload your pictures using the "Gallery" admin area, or through the October Media manager into the folders you created earlier.

#### Uploading through the back-end Gallery management page

This is fairly self-explanatory. Log into your site back-end and find the "Gallery" button at the top. Create an album, and upload your pictures!

#### Uploading through the Media Manager

Images must be organized into folders. Although you can use any folder structure that you'd like, we recommend that you create a "root" folder and create separate folders underneath it to store your albums. You can optionally create separate "root" folders to store your images, videos, and blog pictures. Avoid using spaces or special characters in your folder names. Your folder structure may look like this:

- my_galleries
	- my_travels
		- 2018-argentina
		- 2015-vietnam
		- 2010-hungary
	- cat_pictures
	- awesome_vacuum_cleaners

#### Uploading using FTP

This is the most robust way for uploading many pictures at once to your site. Use an FTP client such as [FileZilla](https://filezilla-project.org/) (Windows) or [WinSCP](https://winscp.net/)  (Windows) or [Panic Transmit 5](https://panic.com/transmit/) (Mac) and connect to your server. Your media files will be located in `public_html/storage/app/media`. You can create new folders through FTP as well, and if you then use the back-end media manager, you'll see them. 

### (2) Configure The Plugin
Log into your "backend" and go to Settings → November Gallery to configure your defaults. Things to look out for:

 - `Settings` Tab: Select the folder that you created your galleries under from the Base Media Folder drop-down, you can also select a default layout for your galleries. 
- `Thumbnails` Tab: It is recommended to use the image resizer to automatically generate thumbnails of your pictures. For this, make sure that the "Use Image Resizer" option is ON on the Thumbnails plugin configuration tab. You can also set either the width or the height for your thumbnails here.
- `Advanced` Tab: *Inject UniteGallery Assets* should probably be on. If your theme already includes jQuery, then you can set *Inject jQuery* to OFF.

### (3) Drop the Plugin Onto your CMS Page(s)

The plugin provides four components that you can drop onto your CMS Pages/Partials/Layouts, it also works as a "Snippet" in static pages. Each option on the component inspector comes with (i) hints, so you should have no trouble understanding how to use it. Please see the *Documentation* tab for a description of each component option.

## Components

### The Embedded Gallery Component
 
This gallery makes use of UniteGallery JS. Use it to show a gallery of thumbnails, or a gallery "embedded" into your page, with optional full-screen (lightbox-style) viewing.

> Hint: Use the Embedded Gallery for fix-size galleries or for showing clickable thumbnails arranged as tiles

Several gallery layouts are available:

#### Tiles

This gallery displays your images as clickable "tiles" that open a popup lightbox. It really looks best if your images have differing dimensions, some tall, some landscape, some square, etc. You can choose from four tile layouts: Columns, Justified, Nested, and Grid.

#### Carousel

This gallery displays your images in a row that (optionally) scrolls by itself.

#### Combined

This gallery combines a large image with a row of thumbnails. It works best if your images are relatively small and have the same dimensions. There are three themes available: Normal, Compact, and Grid.

#### Slider

This gallery is similar to the "Combined" gallery without a strip of thumbnails.

### The Swiper Component

This makes use of Swiper. Use it to create a modern, responsive "swiper" that can be controlled easily from any device. Note that you can control any of the galleries by touch (or click-and-swipe using a mouse). Various transitions are available: "fade", "slide", "flip", "cube", etc..

> Hint: The Swiper Component is really geared towards responsive galleries because by default it fills whatever container it is in. 

### The Popup Lightbox Component

This makes use of a custom UniteGallery JS theme. Use it to create a pop-up lightbox of images that can be opened from a link or button (or any other clickable component) on the page. Two styles are available: "Wide" and "Compact".

### The Video Gallery Component

Again, this makes use of UniteGallery JS. Use it to display videos inline. You can choose to upload your videos to your website or to show videos hosted on YouTube/Vimeo/Wistia.

### Image List Only Component

Well, we probably could have given this component a better name. This component only loads the list of image files into a page variable, without rendering a gallery. Use this if you wish to write your own code for displaying the images, or if you wish to make use of some other JS library to render them.

# Where to now?

Install the plugin and give it a test drive! 

You can also read:
   
- The [November Gallery Cookbook](https://its.zensoft.hu/books/november-gallery-cookbook)
- The [November Gallery Demo Site](https://novembergallery.zenware.io/)
- The [November Gallery Source Code on GitHub](https://github.com/lieszkol/november-gallery)
- Our [OctoberCMS Blog Quick Start Guide](https://kb.zensoft.hu/octobercms-blog-quick-start-guide/)
- Our introduction to [The OctoberCMS Ecosystem](https://kb.zensoft.hu/the-octobercms-ecosystem/)
<!--stackedit_data:
eyJoaXN0b3J5IjpbNjc3NDg0Njk0LDMxODkzOTI2MCwtNjUxND
AyN119
-->