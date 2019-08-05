<?php
namespace ZenWare\NovemberGallery\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use ZenWare\NovemberGallery\Models\Gallery;
use Flash;

class Galleries extends Controller
{
    public $implement = [
		'Backend\Behaviors\ListController',
    	'Backend\Behaviors\FormController',
		];

    public $listConfig = 'config_list.yaml';
	public $formConfig = 'config_form.yaml';
	
	// public $requiredPermissions = ['zenware.novembergallery.access_galleries'];
	
    public function __construct() {
        parent::__construct();
        BackendMenu::setContext('ZenWare.NovemberGallery', 'novembergallery', 'galleries');
    }
}