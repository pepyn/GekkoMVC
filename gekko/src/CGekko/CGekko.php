<?php
//CGekko
//
class CGekko implements ISingleton {

//Member variables

	private static $instance = null;

//Constructor

	protected function __construct(){

		$gg = &$this;

		require(GEKKO_SITE_PATH.'/config.php');

	}

//Singleton pattern ensures only one instance can exist

	public static function Instance(){

		if(self::$instance == null){

			self::$instance = new CGekko();
		}

		return self::$instance;

	} # end function Instance()

// Frontcontroller function checks the url and outputs the route to the controllers
	
	public function FrontControllerRoute(){

	//Take current URL, divide into controller and method

    $this->request = new CRequest($this->config['url_type']);
    $this->request->Init($this->config['base_url']);
    $controller = $this->request->controller;
    $method     = $this->request->method;
    $arguments  = $this->request->arguments;

	// Is the controller enabled in config.php?
    $controllerExists    = isset($this->config['controllers'][$controller]);
    $controllerEnabled    = false;
    $className             = false;
    $classExists           = false;

    if($controllerExists) {
      $controllerEnabled    = ($this->config['controllers'][$controller]['enabled'] == true);
      $className               = $this->config['controllers'][$controller]['class'];
      $classExists           = class_exists($className);
    }

	//Check for callable method in the controller
	// Check if controller has a callable method in the controller class, if then call it
    if($controllerExists && $controllerEnabled && $classExists) {
      $rc = new ReflectionClass($className);
      if($rc->implementsInterface('IController')) {
        if($rc->hasMethod($method)) {
          $controllerObj = $rc->newInstance();
          $methodObj = $rc->getMethod($method);
          $methodObj->invokeArgs($controllerObj, $arguments);
        } else {
          die("404. " . get_class() . ' error: Controller does not contain method.');
        }
      } else {
        die('404. ' . get_class() . ' error: Controller does not implement interface IController.');
      }
    } 
    else { 
      die('404. Page is not found.');
    }

	} # end function FrontControllerRoute()

// Theme Engine Render renders the Web page view based on the theme selected.

	public function ThemeEngineRender() {

	/*echo "<h1>I'm CGekko::ThemeEngineRender</h1><p>You are most welcome. Nothing to render at the moment</p>";
    echo "<h2>The content of the config array:</h2><pre>", print_r($this->config, true) . "</pre>";
    echo "<h2>The content of the data array:</h2><pre>", print_r($this->data, true) . "</pre>";
    echo "<h2>The content of the request array:</h2><pre>", print_r($this->request, true) . "</pre>"; */

    // Retrieve theme path and settings

		$themeName = $this->config['theme']['name'];

		$themePath = GEKKO_INSTALL_PATH . "/themes/{$themeName}";

		$themeUrl = $this->request->base_url . "themes/{$themeName}";

		//Load stylesheet to the data array

		$this->data['stylesheet'] = "{$themeUrl}/style.css";

		// Include the global functions.php and the functions.php that are part of the theme
    	
    	$gg = &$this;

    	
    	$functionsPath = "{$themePath}/functions.php";
    	
    		if(is_file($functionsPath)) {
      			
      			include $functionsPath;
    		}

    	// Extract $gg->data to own variables and handover to the template file
    	
    	extract($this->data);      
    	
    	include("{$themePath}/default.tpl.php");
  }


} # end class

?>