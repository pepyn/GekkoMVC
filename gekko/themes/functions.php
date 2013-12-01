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


/*
*	Log debugging information
*/

	function get_debug() {

		$gg = CGekko::Instance();

		$html=null;

		//Log ´the amount of queries made

		if(isset($gg->config['debug']['db-num-queries']) && $gg->config['debug']['db-num-queries'] && isset($gg->db)) {

    		$html .= "<p>Database made " . $ly->db->GetNumQueries() . " queries.</p>";

  		}  

  		//Log what queries contained

  		if(isset($gg->config['debug']['db-queries']) && $gg->config['debug']['db-queries'] && isset($gg->db)) {
    		
    		$html .= "<p>Database made the following queries.</p><pre>" . implode('<br/><br/>', $ly->db->GetQueries()) . "</pre>";
  		}	    

  		//Log what Gekko contains

		if(isset($gg->config['debug']['display-gekko'])) {
		
			$html = "<hr><h2>Debugging Log</h2><p>CGekko contains:</p><pre>" . htmlent(print_r($gg, true)) . "</pre>";
		
		}

		return $html;
	}

	/*
	* Render all views
	*/	

	function render_views(){

		return CGekko::Instance()->views->render();
	
	}

	/*
	*	Get messages form flash-session
	*/

	function get_messages_from_session() {

		$messages = CGekko::Instance()->session->GetMessages();
		$html = null;

		if(!empty($messages)) {

			foreach ($messages as $val) {
				$valid = array('info', 'notice', 'success', 'warning', 'error', 'alert');
				$class = (in_array($val['type'], $valid)) ? $val['type'] : 'info';
				$html .= "<div class='$class'>{$val['message']}</div>\n";
			}
		}

		return $html;
	}
?>