<?php

namespace kah;
use kah\core\myConfig\Autoloader;
use kah\core\Router;
session_start();
require_once 'app/myConfig/Autoloader.php';
Autoloader::register();
$router = new Router();
$router->render();