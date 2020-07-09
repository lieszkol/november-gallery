

![NovemberGallery Banner](https://novembergallery.zenware.io/storage/app/media/november-gallery-octobercms-banner.jpg)

<div align="right"><a href="https://gitter.im/november-gallery/community?utm_source=badge&amp;utm_medium=badge&amp;utm_campaign=pr-badge&amp;utm_content=badge"><img src="https://badges.gitter.im/november-gallery/community.svg" alt="Join the chat at https://gitter.im/november-gallery/community"></a></div>

Check out the [live demo site](https://novembergallery.zenware.io)!

A gallery plugin for professional Photographers, Media Artists, Bloggers and Content Publishers.

 1. Upload your images either using the Media Manager built into OctoberCMS or through the dedicated galleries backend page
 3. Drop November Gallery onto your CMS page, partial*, static page, or blog post
 4. Select the folder you uploaded your images to and how you want them displayed using the component inspector, or in your RainLab blog entry

<small><i>*please read the Known Issues section regarding usage in partials!</i></small>

Behind the scenes, November Gallery makes use of the [Image Resizer plugin](https://octobercms.com/plugin/toughdeveloper-imageresizer) to generate thumbnails of your images, and the excellent [UniteGallery jQuery Gallery Plugin](https://github.com/vvvmax/unitegallery) as well as [Swiper](https://idangero.us/swiper/). 

This README is an abridged version of the full documentation that we call [The November Gallery Cookbook](https://its.zensoft.hu/books/november-gallery-cookbook).

# Features:

- Works in Pages, Partials, "Static" Pages, and Blog Posts!
- Six components included: 
	 - **Embedded Gallery** if you wish to show a gallery of images or thumbnails in your page, arranged in various layouts: **tiles** (arranged in columns, justified, or laid out in a grid "masonry style"), **carousel**, **slider**, or **combined** (large image + lightbox)
	 - **Swiper Gallery** for responsive, multi-platform galleries
	 - **Popup Lightbox** for galleries that can be opened from a link or button on your page, with several available styles (wide, compact)
	 - **Video Gallery** for...videos, again, with several "styles" available (thumbs / titles + subtitles / titles only)
	 - **Image List Only** if you want to handle the display of the images yourself and only need a list of image objects
	 - **Gallery Hub** to generate a page with links to all (or only some) of your galleries
 - Set which folder of images to display in the component configuration panel OR pass it dynamically as a page-variable OR set it in your RainLab blog entry
 - Responsive/touch enabled/skinnable/themable/gallery buttons/keyboard control etc.

### Limitations / ToDo:
 
 - [ ] Improve handling of videos uploaded to the site
 - [ ] Add alternative lightbox/carousel gallery script support
 - [ ] Support titles & captions embedded into the image files, or in sidecar files (with support for multiple languages) (titles & captions are only supported when uploading through the backend "Gallery" page)
 - [ ] ~~Cache image data in database instead of reading it all in from the filesystem every time~~ → the new back-end Gallery page is a good alternative to the Media Manager and it makes use of the database

# Deployment, Installation & Usage

Please see the [NovemberGallery manual](https://its.zensoft.hu/books/november-gallery-cookbook/page/installation-deployment)!


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

# License

This plugin is available in two editions: 

 1. The Personal Edition is a free plugin meant for non-profit use, such as:
	 2. Building a personal website that is not offering a product or services for sale
	 3. Academic use
	 4. Use by non-profit organizations
 2. The Professional Edition is meant for commercial use, such as:
	 1. A website selling or promoting products or services
	 2. Use by a for-profit organization

The professional edition is available from the OctoberCMS Marketplace. If you fit the criteria for the personal edition, then you are welcome to download it from GitHub and deploy it manually - as a free product we do not offer any support either with deployment or any issues you might encounter during use.

Commercial Use governed by the  [OctoberCMS Marketplace Purchased License](https://octobercms.com/help/license/regular)

# Credits / Major Dependencies

 - [UniteGallery jQuery Gallery Plugin](https://github.com/vvvmax/unitegallery)
 - [Swiper](https://idangero.us/swiper/)
 - OctoberCMS [Image Resizer plugin](https://octobercms.com/plugin/toughdeveloper-imageresizer)
 - [OctoberCMS]([https://github.com/octobercms/october](https://github.com/octobercms/october)) :-)

<p align="center">Created by <a href="http://www.lieszkovszky.com/" rel="nofollow">László Lieszkovszky</a> ❖ <a href="http://www.zensoft.hu/" rel="nofollow">ZenSoft Hungary</a></p>
<!--stackedit_data:
eyJoaXN0b3J5IjpbLTEwNzgwNzI0NDcsMTIxODQ5NTAxNCwtMT
UzNjYyMjYxOSwtMTkzMjE0OTQ0MCwtNTc4MTEzODc2LDY4Nzc3
MDk5OCwxNjk4MDgxODQ1LC0xMDYwNjQ2MTU1LC05NDkzNTc5MT
QsMTcyODM1OTg4NiwtNjk0NTUyODU5LC0xODI1NjU4NjM2LC03
NjgxOTE1OTQsLTE2NjEwNDI5OTUsNjI3MzM4MDA2LC01NTA2ND
c3ODEsLTk2MDY4NzkzNSwtNTYzOTA1MTc3LC0xOTM5Njk5NDI5
LDM0NTA2NzcxM119
-->