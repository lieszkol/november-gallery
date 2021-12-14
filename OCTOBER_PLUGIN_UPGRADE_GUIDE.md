> **Upgrading from OctoberCMS v1.x to v2.x:** please make sure to also upgrade to version 2 of this plugin. Additionally, disable or remove the "Image Resizer" plugin if you have it installed.

**OctoberCMS v2+:** Make sure the plugin is added to your project and then run `php artisan project:sync`. Alternatively, you can update only the plugin (provided you've previously added it to your project) using: `composer update zenware/novembergallery-plugin`. Afterwards run `php artisan october:migrate` to run any migrations.

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