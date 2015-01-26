<?php

session_start();
ob_start();


include_once 'config/page_settings.php';
include_once 'config/config.php';
include_once 'config/connect.php';
include_once 'app/controllers/Main.php';





if (!isset($_GET["page"])){
	$_GET["page"] = "";
}

/* routing */
switch ($_GET["page"]){
	case "index":
		$m = new Main();
		break;
	case "login":
		$m->login();
		break;		
	default:
		$m = new Main();
		break;
}
