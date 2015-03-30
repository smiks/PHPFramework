<?php

class Functions {

	public function __construct(){
	}

	public static function redirect($toUrl) {
		header("Location: {$toURL}");
	}

	public static function reload($toUrl, $time=0) {
		header("refresh:{$time};url={$toUrl}"); 
	}	
}