<?php 

namespace ZenWare\NovemberGallery;

use ZenWare\NovemberGallery\Models\Settings;

class NovemberHelper 
{
	public static function getSubdirectories($baseFolder)
    {
        $mediaPath = Settings::instance()->mediaPath;
        if (!empty($baseFolder)) {
            $mediaPath .= $baseFolder;
        }

        // https://laravel.com/api/5.7/Illuminate/Contracts/Filesystem/Filesystem.html#method_allDirectories
        $directories = \File::directories($mediaPath);

        // https://laravel.com/docs/5.7/collections
        // https://hotexamples.com/site/file?hash=0xbf04831db113aec866fc4024ff9bb7faaa2503700d9125560cc67bea8cd6b2cb&fullName=src/MediaManager.php&project=talv86/easel
        $matches = collect($directories)->reduce(function ($allDirectories, $directory) use ($mediaPath) {
            $relativePath = str_replace(@"{$mediaPath}" . DIRECTORY_SEPARATOR, '', $directory);
            $allDirectories[$relativePath] = '/' . $relativePath;
            return $allDirectories;
        }, collect())->sort();

        if ($matches->count() == 0) {
            if (!empty(Settings::instance()->base_folder)) {
                return collect([DIRECTORY_SEPARATOR => "Your base folder (" . Settings::instance()->base_folder . ") does not contain any subfolders!"]);
            }
            return collect([DIRECTORY_SEPARATOR => "Create folders for your media first!"]);
        }
        return $matches;
    }

	public static function endsWith($string, $endString) 
	{ 
		$len = strlen($endString); 
		if ($len == 0) { 
			return true; 
		} 
		return (substr($string, -$len) === $endString); 
	} 

	public static function startsWith ($string, $startString) 
	{ 
		$len = strlen($startString); 
		return (substr($string, 0, $len) === $startString); 
	} 
}