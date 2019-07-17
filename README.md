
![NovemberGallery Banner](http://www.generalcomputing.com/2019/november-gallery-octobercms-banner.jpg)

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
 
 - [ ] Support titles & captions
 - [ ] Test embedding & linking video
 - [ ] Get the demo page up and running
 - [ ] Extensive help docs

## Deployment

### Requirements

If you want the plugin to inject the required scripts and CSS, you must have a `{styles}` tag in the head section of your page or layout: 
```html
<head>
    ...
    {% styles %}
</head>
```
as well as a `{scripts}` tag in the body section:
```html
<body>
    ...
    {% scripts %}
</body>
```
For more information see the [OctoberCMS docs](https://octobercms.com/docs/cms/pages#injecting-assets)!

### Installation

To install from your site "backend": go to  **Settings → Updates & Plugins → Install Plugins**  and then search for  `November Gallery`.

To install from the  [Marketplace](https://octobercms.com/plugins): click "Add to Project" and select the project you wish to use the plugin on, and then from the backend area of your site use the `Check for updates` button on the **Settings → Updates & Plugins** page.

To install from [the repository](https://github.com/lieszkol/november-gallery): clone it into the **/plugins/** folder of your site and then run  `sudo php artisan plugin:refresh zenware.novembergallery`  from your project root.

## Usage



## Support

Feel free to [file an issue](https://github.com/lieszkol/november-gallery/issues/new). Feature requests are always welcome.

If there's anything you'd like to chat about, please feel free to join our  [Gitter chat](https://gitter.im/november-gallery/community)!

## Credits / Major Dependencies

 - [UniteGallery jQuery Gallery Plugin](https://github.com/vvvmax/unitegallery)
 - OctoberCMS [Image Resizer plugin](https://octobercms.com/plugin/toughdeveloper-imageresizer)
 - [OctoberCMS]([https://github.com/octobercms/october](https://github.com/octobercms/october)) :-)

## License

This plugin is available in two editions: 

 A. The Personal Edition is a free plugin meant for non-profit use, such as:
	 2. Building a personal website that is not offering a product or services for sale
	 3. Academic use
	 4. Use by non-profit organizations
 2. The Professional Edition is meant for commercial use, such as:
	 1. 

Both versions are available from the OctoberCMS Marketplace.

Commercial Use governed by the  [OctoberCMS Marketplace Purchased License](https://octobercms.com/help/license/regular)
<!--stackedit_data:
eyJoaXN0b3J5IjpbLTQ3MDc1MjMxLC0xMDEwNjg5NTk2LDIxND
cyMDM4NiwzNjQwOTcxMTYsNjQ1MzI3MTgsLTQ4NTY5NDk0LDY0
NjYzMDUwNSwtMTYyNjQ1MTE5NywzMDE0MjQ5NTcsLTE2NjQ3Mj
cwMjRdfQ==
-->