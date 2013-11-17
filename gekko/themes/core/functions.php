<?php
/*
* 	Functions.php
*	Functions for the Gekko core theme
*/

//function that creates a URL from base URL

	function base_url($url){

		return CGekko::Instance()->request->base_url . trim($url, '/');
	}

//Function that returns the URL to the current page
	function current_url(){

		return CGekko::Instance()->request->current_url;
	}

//populating the data array for testing the template file

	/*
	$gg->data['header'] = '<h1>The Gekko Header</h1>';

	$gg->data['main'] = '<p>The Gekko Main. Stay tuned for more fascinating content here!</p>';
	*/

	$gg->data['footer'] = '<p>The Gekko Footer: &copy; Pepyn Swagemakers</p>';


// Log debugging information

	function get_debug() {

		$gg = CGekko::Instance();

		$gg->debug .= "<h2>Debugging information:</h2>";

		$gg->debug .= "<hr><p>The data array contains:</p><pre>" . htmlentities(print_r($gg->config, true)) . "</pre>";

		$gg->debug .= "<hr><p>The request array contains:</p><pre>" . htmlentities(print_r($gg->config, true)) . "</pre>";

		return $gg->debug;

	}
?>