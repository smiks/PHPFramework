<?php
session_start();
ob_start();
require_once 'config/page_settings.php';
require_once 'config/config.php';
require_once 'config/connect.php';
require_once 'core/Router.php';
require_once 'core/Functions.php';

/* routing */
Router::home('main', 'app/controllers/SignIn.php');
Router::make('main', 'app/controllers/SignIn.php');
Router::route();