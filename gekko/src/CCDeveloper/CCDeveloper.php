<?php
//CCDeveloper.php
//A controller class for testing the Gekko Framework

class CCDeveloper extends CObject implements IController {

	//Constructor

	public function __construct() {
		parent::construct();
	}
	//Implementing IController: all controllers must have an index

	public function Index(){
		$this->Menu();
		}
		
	//DisplayObject:

	public function DisplayObject() {

		$this->Menu();

		$this->data['main'] .= <<<EOD
		<h2>Dumping content of CDeveloper:</h2>
		<p>What follows is the content of the controller, including the properties of CObject</p>
EOD;

		$this->data['main'] .= '<pre>' . htmlentities(print_r($this, true)) . '</pre>';
	}

	//Function Links()

	public function Links() {

		$this->Menu();

		//Create a variable that stores the current Url

		$url = 'developer/links';
		$current = $this->request->CreateUrl($url);

		//Create a variable that stores the default url

		$this->request->cleanUrl = false;
		$this->request->querystringUrl = false;
		$default = $this->request->CreateUrl($url);

		//Create a variable that stores the clean url

		$this->request->cleanUrl = true;
		$clean = $this->request->CreateUrl($url);

		//Create a variable that stores the querystring type url

		$this->request->cleanUrl = false;
		$this->request->querystringUrl = true;
		$querystring = $this->request->CreateUrl($url);

		//Add the variables created to the data array so they can be displayed in the content body

		$this->data['main'] .= <<<EOD
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

			$menu = array('developer', 'developer/index', 'developer/links', 'developer/display-object');

			$html=null;

				foreach ($menu as $val) {

					$html .= "<li> <a href='" . $this->request->CreateUrl($val) . "'>" . $val . "</a>";
				}

			$this->data['title'] = "The Developer Controller";

			$this->data['header'] = "<h1>The Developer Controller</h1>";

			$this->data['main'] = "<p>Choose an option:</p><ul>" . $html . "</ul>";
		} # end function Menu()

} # end class
?>