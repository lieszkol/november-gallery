**Upgrading from OctoberCMS v1.x to v2.x:** 

> Please make sure to also upgrade to version 2 of this plugin. Additionally, disable or remove the "Image Resizer" plugin if you have it installed. 

1. Make sure you are using the latest version of composer: `composer update`
2. Your composer.json may be locking you to version 1 of this plugin ("zenware/novembergallery-plugin": "^1.0"), to fix this run: `composer require zenware/novembergallery-plugin ^2.0.1`
3. The OctoberCMS admin page will not show the current version number of the plugin until you run: `php artisan october:migrate`

If you run into issues you can try `composer clear-cache`. If composer hangs, or you are running into errors, try adding the "-vvv" tag to the failing composer command to get detailed debug info, for example: `composer update -vvv`. When opening a support ticket please include the results of the failing composer commant.

**OctoberCMS v2+:** Make sure the plugin is added to your project and then run `php artisan project:sync`. Alternatively, you can update only the plugin (provided you've previously added it to your project) using: `composer update zenware/novembergallery-plugins`. Afterwards run `php artisan october:migrate` to run any migrations.

**OctoberCMS v1+ & WinterCMS:** For plugins installed from the marketplace, you can just do *Settings → Updates & Plugins → Check for Updates*.

For plugin installed manually, you can run the following from your project root directory:

```
USER@SERVER:/var/www/vhost/public_html# sudo -u www-data git -C plugins/zenware/novembergallery/ pull 
remote: Enumerating objects: 14, done. 
...

   IN OCTOBERCMS v1.x:

USER@SERVER:/var/www/vhost/public_html# sudo -u www-data php artisan october:up 
ZenWare.NovemberGallery - v1.0.4: Extend Rainlab Blog integration with support for images in media folders ...
   
   IN OCTOBERCMS v2+:

USER@SERVER:/var/www/vhost/public_html# sudo -u www-data php artisan october:migrate 
ZenWare.NovemberGallery - v1.0.4: Extend Rainlab Blog integration with support for images in media folders ...
```