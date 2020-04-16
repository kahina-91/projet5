<?php

namespace kah;
use kah\app\core\_config\Autoloader;
use kah\app\core\Router;
//use kah\app\core\View;
session_start();
include_once 'app/core/_config/Autoloader.php';
//include_once 'app/core/Router.php';
Autoloader::register();
$router = new Router();
$router->render();

