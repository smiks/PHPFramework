<?php

/* Error Report Settings  */
	/* 0 - no report          */
	/* 1 - warnings only      */
	/* 2 - all errors         */	
	$_ERROR_REPORT = 1; 

/* Debug mode */
	$_DEBUG = false;

/* Allow registration or login */
	$_ALLOW_LOGIN = true;
	$_ALLOW_REGISTRATION = true;

/* Page statistics */
	$_PAGE_LOAD_TIME = true;
	$_NUM_QUERIES = true;
	$_MEMORY_USAGE = true;


/* Toggle CSRF token */
	$_CSRF = true;


/* Previous page */
	$_RefererDomain = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST); /* get domain from $_SERVER['HTTP_REFERER'] */

/* Private Key */
	$_PrivateKey = "mysecret";

/* Domain */
	$_http   = "http://"; // or https://
	$_Domain = "domai.com";

/* static file access */
	$_images = "/static/images/";
	$_css    = "/static/css/";
	$_js     = "/static/js/";
	

if($_ERROR_REPORT== 1) 
{
	ini_set("display_errors", 1);
}
elseif($_ERROR_REPORT == 2) 
{
	ini_set("display_errors", 1);
	error_reporting(E_ALL);
}


if($_DEBUG) {
	ini_set("display_errors", 1);
	error_reporting(E_ALL);
	$_PAGE_LOAD_TIME = true;
	$_NUM_QUERIES = true;
}