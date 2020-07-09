For plugins installed from the marketplace, you can just do *Settings → Updates & Plugins → Check for Updates*.

For plugin installed manually, you can run the following from your project root directory:

```
USER@SERVER:/var/www/vhost/public_html# sudo -u www-data git -C plugins/zenware/novembergallery/ pull 
remote: Enumerating objects: 14, done. 
... 
USER@SERVER:/var/www/vhost/public_html# sudo -u www-data php artisan october:up 
ZenWare.NovemberGallery - v1.0.4: Extend Rainlab Blog integration with support for images in media folders ...
```