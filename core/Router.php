<?php

class Router {

	protected static $pages;
	protected static $defaultPage;
	protected static $defaultController;

	public function Router() {

	}

	public static function make($pagename, $controller) {
		trigger_error("Make function is deprecated. Use set(array(pagename => controller)) instead.", E_USER_WARNING);
		$pagename = strtolower($pagename);
		self::$pages[$pagename] = $controller;
	}

	public static function set($pages) {
		self::$pages = $pages;
	}

	public static function home($pagename, $controller) {
		$pagename = strtolower($pagename);
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
			$page = strtolower($_GET['page']);
		}

		if(!is_null($pages[$page]) && file_exists($pages[$page])) {
			require_once $pages[$page];
			$$page = new $page;
			switch($_SERVER['REQUEST_METHOD']){
				case "GET": $$page->get(); break;
				case "POST": $$page->post(); break;
			}
		}
		else {
			$page = urlencode($page);
			header("Location: ../error/404.php?page=$page");
		}
	}
}