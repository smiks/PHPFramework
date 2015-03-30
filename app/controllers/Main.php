<?php

require_once 'Controller.php';
require_once 'app/models/user.php';
require_once 'core/Cache.php';
require_once 'core/Functions.php';

class Main extends Controller{
	

	public function post() {
		var_dump($_POST);
		$this->checkCSRF($_POST['csrf']);
		$reloadTimer = 5; /* 5 seconds */
		$data = array("reloadTimer" => $reloadTimer);
		$this->show("base.view.php",$data);
		Functions::reload("index.php", $reloadTimer);		
	}


	public function home() {
		global $_Domain, $_RefererDomain;

		$cache = new cache();
		$token = $this->generateCSRF();
		$data = array(
				"var1" => "var1_value",
				"var2" => "var2_value"
		);
		
		$user = new user();
		$data = $user->__construct();
		$cache->setValue("key", "cacheValue");
		$data = array("ir" => $data, "cVal" => $cache->getValue("key"), "token" => $token, "domain" => $_Domain, "previousPage" => $_RefererDomain);
		$this->show("home.view.php",$data);
	}

	public function __construct() {
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->post();
		}
		else{
			$this->home();
		}	
	}
	

}