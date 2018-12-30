<?php
ini_set("error_reporting", E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
session_start();
require_once "vendor/autoload.php";
require("config/config.php");


$router = new \Core\Router();
// Add the routes
$router->add('/signin', ['controller' => 'Home', 'action' => 'signin']);
$router->add('/login', ['controller' => 'Home', 'action' => 'login']);
$router->add('/logout', ['controller' => 'Home', 'action' => 'logout']);
$router->add('/dashboard', ['controller' => 'Home', 'action' => 'dashboard']);
$router->add('/', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->dispatch($_SERVER['REQUEST_URI']);
