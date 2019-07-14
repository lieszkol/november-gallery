
![NovemberGallery Banner](http://www.generalcomputing.com/2019/november-gallery-octobercms-banner.jpg)


A gallery plugin for OctoberCMS that tries to Keep It Simple and Stupid.

 1. Upload your images using the Media Manager built into OctoberCMS
 2. Drop November Gallery onto your page or partial
 3. Select the folder you uploaded your images to and how you want them displayed

Behind the scenes, November Gallery makes use of the [Image Resizer plugin](https://octobercms.com/plugin/toughdeveloper-imageresizer) to generate thumbnails of your images, and the excellent [UniteGallery jQuery Gallery Plugin](https://github.com/vvvmax/unitegallery). 
### Fetaures
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

## Requirements
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
## Installation

Use the package manager [pip](https://pip.pypa.io/en/stable/) to install foobar.

```bash
pip install foobar
```

## Usage

```python
import foobar

foobar.pluralize('word') # returns 'words'
foobar.pluralize('goose') # returns 'geese'
foobar.singularize('phenomena') # returns 'phenomenon'
```

## Support

### Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.
### ToDo

 - Support embedded video

## Credits

Major dependencies:

Show your appreciation to those who have contributed to the project.

### License
[MIT](https://choosealicense.com/licenses/mit/)

### Project Status
<!--stackedit_data:
eyJoaXN0b3J5IjpbMTM1MjA2MjExMSw2NDY2MzA1MDUsLTE2Mj
Y0NTExOTcsMzAxNDI0OTU3LC0xNjY0NzI3MDI0XX0=
-->