
if(typeof g_ugFunctions != "undefined")
	g_ugFunctions.registerTheme("lightbox");
else 
	jQuery(document).ready(function(){g_ugFunctions.registerTheme("lightbox")});


/**
 * Grid gallery theme
 */
function UGTheme_lightbox(){

	var t = this;
	var g_gallery = new UniteGalleryMain(), g_objGallery, g_objects, g_objWrapper;
	var g_lightbox = new UGLightbox();
	var g_functions = new UGFunctions(), g_objTileDesign = new UGTileDesign();;
	var g_objNavWrapper, g_objButtonLeft, g_objButtonRight, g_objButtonPlay, g_objPreloader;
	var g_apiDefine = new UG_API();
	
	var g_options = {	};
	
	var g_defaults = {
	};
	
	
	//temp variables
	var g_temp = {
	};
	
	
	/**
	 * Init the theme
	 */
	function initTheme(gallery, customOptions){
		
		g_gallery = gallery;
		
		//set default options
		g_options = jQuery.extend(g_options, g_defaults);
		
		//set custom options
		g_options = jQuery.extend(g_options, customOptions);
		
		//modifyOptions();
		
		//set gallery options
		g_gallery.setOptions(g_options);
		
		g_gallery.setFreestyleMode();
		
		g_objects = gallery.getObjects();
		
		//get some objects for local use
		g_objGallery = jQuery(gallery);		
		g_objWrapper = g_objects.g_objWrapper;
		
		//init objects
		g_lightbox.init(gallery, g_options);
	}
	
	
	/**
	 * set gallery html elements
	 */
	function setHtml(){
				
		//add html elements
		g_objWrapper.addClass("ug-theme-lightbox");
		
		g_lightbox.putHtml();

		//add preloader
		g_objWrapper.append("<div class='ug-tiles-preloader ug-preloader-trans'></div>");
		g_objPreloader = g_objWrapper.children(".ug-tiles-preloader");
		g_objPreloader.fadeTo(0,0);
	}

	/**
	 * actually run the theme
	 */
	function actualRun(){
		
		initEvents();
		
		g_lightbox.run();
	}
	
	
	/**
	 * run the theme
	 */
	function runTheme(){
		
		setHtml();
		
		actualRun();
		
	}
		
	/**
	 * init api functions
	 */
	function initAPIFunctions(event, api){
	}
	
	/**
	 * init buttons functionality and events
	 */
	function initEvents(){
		//init api
		g_objGallery.on(g_apiDefine.events.API_INIT_FUNCTIONS, initAPIFunctions);
	}
	
	/**
	 * destroy the carousel events
	 */
	this.destroy = function(){
		g_lightbox.destroy();
	}
	
	/**
	 * run the theme setting
	 */
	this.run = function(){
		runTheme();
	}
	
	
	/**
	 * init 
	 */
	this.init = function(gallery, customOptions){
		initTheme(gallery, customOptions);
	}
}
