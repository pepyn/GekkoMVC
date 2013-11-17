<?php
// Index.php
// @Author: Pepyn Swagemakers
// 


// ************************************************************************************
// STAGE 1: BOOTSTRAP
// Define and load necessary variables and other 
// components required for the framework to function
//

define ('GEKKO_INSTALL_PATH', dirname(__FILE__));

define ('GEKKO_SITE_PATH', GEKKO_INSTALL_PATH . '/site');

require(GEKKO_INSTALL_PATH.'/src/CGekko/bootstrap.php');

$gg = CGekko::Instance();


// ************************************************************************************
// STAGE 2: FRONT CONTROLLLER ROUTE
// Interprets the request sent through the URL and determines 
// which controller and method to use
//

$gg->FrontControllerRoute();



// ************************************************************************************
// STAGE 3:THEME ENGINE RENDER
// Creates the final Web page output

$gg->ThemeEngineRender();









?>