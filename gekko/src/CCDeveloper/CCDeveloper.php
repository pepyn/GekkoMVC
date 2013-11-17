<?php
//CCDeveloper.php
//A controller class for testing the Gekko Framework

class CCDeveloper implements IController {

	//Implementing IController: all controllers must have an index

	public function Index(){
		$this->Menu();
		}

	//Function Links()

	public function Links() {

		$gg = CGekko::Instance();

		$this->Menu();

		//Create a variable that stores the current Url

		$url = 'developer/links';
		$current = $gg->request->CreateUrl($url);

		//Create a variable that stores the default url

		$gg->request->cleanUrl = false;
		$gg->request->querystringUrl = false;
		$default = $gg->request->CreateUrl($url);

		//Create a variable that stores the clean url

		$gg->request->cleanUrl = true;
		$clean = $gg->request->CreateUrl($url);

		//Create a variable that stores the querystring type url

		$gg->request->cleanUrl = false;
		$gg->request->querystringUrl = true;
		$querystring = $gg->request->CreateUrl($url);

		//Add the variables created to the data array so they can be displayed in the content body

		$gg->data['main'] .= <<<EOD
			<h2>CRequest::CreateUrl()</h2>
			<p>This method creates URLs to the same page, but gets there using different settings.</p>
			<ul>
				<li><a href='$current'>The current URL</a></li>
				<li><a href='$default'>The default URL</a></li>
				<li><a href='$clean'>The clean URL</a></li>
				<li><a href='$querystring'>The querystring URL</a></li>
			</ul>
EOD;

		} # end function Links()

		// Function Menu(): method that shows the menu, same for all methods

		private function Menu(){

			$gg = CGekko::Instance();

			$menu = array('developer', 'developer/index', 'developer/links');

			$html=null;

				foreach ($menu as $val) {

					$html .= "<li> <a href='" . $gg->request->CreateUrl($val) . "'>" . $val . "</a>";
				}

			$gg->data['title'] = "The Developer Controller";

			$gg->data['header'] = "<h1>The Developer Controller</h1>";

			$gg->data['main'] = "<p>Choose an option:</p><ul>" . $html . "</ul>";
		} # end function Menu()

} # end class
?>