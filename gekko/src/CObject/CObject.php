<?php
/*
*	file: CObject
*
*	Holds an instance of CGekko
*	Enables use of $this in subclasses, declared in constructor function
*
*	@package GekkoCore
*/

class CObject{

//Member variables
	public $config;
	public $request;
	public $data;
	public $db;
	public $views;

// Constructor
	protected function __construct() {

		$gg = CGekko::Instance();

		$this->config = &$gg->config;
		$this->request = &$gg->request;
		$this->data = &$gg->data;
		$this->db = &$gg->db;
		$this->views = &$gg->views;

	}

} # end class
?>