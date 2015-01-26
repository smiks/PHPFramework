<?php

class PageSettings {


	public $_ERROR_REPORT;
	public $_ALLOW_REGISTRATION;
	public $_ALLOW_LOGIN;
	public $_DEBUG;
	public $_PAGE_LOAD_TIME;
	public $_NUM_QUERIES;
	public $_CSRF;

	public function __construct() {	
		/* Error Report Settings  */
			/* 0 - no report          */
			/* 1 - warnings only      */
			/* 2 - all errors         */	
			$_ERROR_REPORT = 1; 

		/* Debug mode */
			$_DEBUG = true;

		/* Allow registration or login */
			$_ALLOW_LOGIN = true;
			$_ALLOW_REGISTRATION = true;

		/* Page statistics */
			$_PAGE_LOAD_TIME = false;
			$_NUM_QUERIES = false;


		/* Toggle CSRF token */
			$_CSRF = true;



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
	}



}