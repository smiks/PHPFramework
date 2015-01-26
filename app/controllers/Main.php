<?php

require_once 'Controller.php';
require_once 'app/models/user.php';

class Main extends Controller{
	

	public function __construct() {
		$data = array(
				"var1" => "var1_value",
				"var2" => "var2_value"
		);
		
		$user = new user();
		$data = $user->__construct();
		$data = array("ir" => $data);
		$this->show("home.view.php",$data);
	}
	

}