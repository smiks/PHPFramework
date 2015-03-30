<?php

class Router {

	protected static $pages;
	protected static $defaultPage;
	protected static $defaultController;

	public function Router() {

	}

	public static function make($pagename, $controller) {
		self::$pages[$pagename] = $controller;
	}

	public static function home($pagename, $controller) {
		self::$defaultPage = $pagename;
		self::$defaultController = $controller;
	}	

	public static function route() {
		$pages = self::$pages;

		/* pages are routed using $_GET['page'] */
		if (!isset($_GET["page"])){
			$_GET["page"] = "";
			$page = self::$defaultPage;
			$pages[$page] = self::$defaultController;
		}
		else {
			$page = $_GET['page'];
		}

		if($pages[$page] != null || file_exists($pages[$page])) {
			require_once $pages[$page];
			$$page = new $page;
		}
		else {
			echo"Page [{$page}] does not exist";
			exit(1);
		}
	}
}