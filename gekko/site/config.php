<?php
// Config.php
//
// File is adapted by the user to fit the needs of the site
//

//Set error reporting

	error_reporting(-1);
	ini_set('display_errors', 1);

//Set database(s)
	$gg->config['database'][0]['dsn'] = 'sqlite:' . GEKKO_SITE_PATH . '/data/.ht.sqlite';

//Set debugging
	$gg->config['debug']['session'] = true;
	$gg->config['debug']['timer'] = true;
	$gg->config['debug']['gekko'] = true;
	$gg->config['debug']['display-gekko'] = true;
	$gg->config['debug']['db-num-queries'] = true;
	$gg->config['debug']['db-queries'] = true;

//Handle base URL
	$gg->config['base_url'] = null;

// DEfine what type of URL is used: 
	//default, 0: index.php/controller/method/a/r/g/
	//clean, 1: controller/method/a/r/g/
	//querystring, 2: index.php?q=controller/method/arg/1/2/3

	$gg->config['url_type'] = 1;

// Define name of current session

	$gg->config['session_name'] = preg_replace('/[:\.\/-_]/', '', $_SERVER["SERVER_NAME"]);
	$gg->config['session_key'] = 'gekko';

// Define timezone server is located in

	$gg->config['timezone'] = 'Europe/Stockholm';

//Define character encoding

	$gg->config['character_encoding'] = 'UTF-8';

//Define language

	$gg->config['language'] = 'en';

// Define the controllers, their classname and enable/disable them.

$gg->config['controllers'] = array(
  'index'     => array('enabled' => true,'class' => 'CCIndex'),
  'developer' => array('enabled' => true, 'class' => 'CCDeveloper'),
);

//Theme Settings

	$gg->config['theme'] = array (

		'name' => 'core', #name of the Core theme in the "themes" directory

		);

?>