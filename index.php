<?php

/*namespace kah;
use kah\app\myConfig\Autoloader;
use kah\app\core\Router;*/
//use kah\app\core\View;
session_start();
require_once 'app/myConfig/Autoloader.php';
//include_once 'app/core/Router.php';
Autoloader::register();
$router = new Router();
$router->render();

