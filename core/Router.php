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
		if (isset($_GET["page"])){
			$page = strtolower($_GET["page"]);
		}
		else {
			$page = self::$defaultPage;
			$pages[$page] = self::$defaultController;
		}

		if(!file_exists($pages[$page])){
			$cont = strtoupper($page[0]).substr($page, 1);
			echo"File [{$pages[$page]}] is not found.";
			return;
		}

		if(!is_null($pages[$page]) && file_exists($pages[$page])) {
			require_once $pages[$page];
			if(!class_exists($page)){
				$cont = strtoupper($page[0]).substr($page, 1);
				echo"Class [{$page}] is not found in controller {$cont}.php";
				return;
			}
			$$page = new $page;
			switch($_SERVER['REQUEST_METHOD']){
				case "GET": $$page->get(); break;
				case "POST": $$page->post(); break;
			}
		}
		else {
			$page = urlencode($page);
			header("Location: /error/404.php?page=$page");
		}
	}
}