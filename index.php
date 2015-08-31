<?php
/*	author: smiks
	version: 0.7
*/
session_start();
ob_start();
require_once 'config/page_settings.php';
require_once 'config/config.php';
require_once 'config/connect.php';
require_once 'core/Router.php';
require_once 'core/Functions.php';

/* routing */
Router::home('mainExample', 'app/controllers/MainExample.php');
Router::set(array(
	'anotherPageExample' => 'app/controllers/anotherPageExample.php'));
Router::route();