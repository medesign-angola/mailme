<?php

require('headers.php');

require('functions.php');
require('helpers/helper.php');
require_once "router.php";

$requestUri = $_SERVER['REQUEST_URI'];

// dd($requestUri);

$router = new Router;
$router->run($requestUri);