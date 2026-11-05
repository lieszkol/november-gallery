**Upgrading to OctoberCMS v4.x (Laravel 13 / PHP 8.2+):**

> November Gallery **v3.0.1 or later** is required for OctoberCMS v4. Earlier versions break under v4 because the Swiper component was missing a property declaration, and gallery image URLs were built from the `system.storage.media.path` config value, which OctoberCMS v4 no longer sets explicitly (core now reads it with a built-in default). On v3 and earlier these produced working galleries; on v4 they cause a 500 on swiper pages and 404s on every gallery image.

1. Update the plugin to the latest version (marketplace: *Settings → Updates & Plugins → Check for Updates*; or `composer require zenware/novembergallery-plugin ^4.0`).
2. Run `php artisan october:migrate`.
3. **Re-check your plugin settings after the upgrade.** A major OctoberCMS upgrade can clear the `system_settings` table. If galleries show "cannot find the path" or images 404, go to *Settings → November Gallery* and re-set **Base Media Folder** (and the video base folder) to the folder that contains your galleries — this is backend configuration and is not restored by composer or migrations.

---

**Upgrading from OctoberCMS v1.x to v2.x:** 

> Please make sure to also upgrade to version 2 of this plugin. Additionally, disable or remove the "Image Resizer" plugin if you have it installed. 

1. Make sure you are using the latest version of composer: `composer update`
2. Your composer.json may be locking you to version 1 of this plugin ("zenware/novembergallery-plugin": "^1.0"), to fix this run: `composer require zenware/novembergallery-plugin ^2.0.1`
3. The OctoberCMS admin page will not show the current version number of the plugin until you run: `php artisan october:migrate`

If you run into issues you can try `composer clear-cache`. If composer hangs, or you are running into errors, try adding the "-vvv" tag to the failing composer command to get detailed debug info, for example: `composer update -vvv`. When opening a support ticket please include the results of the failing composer command.

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