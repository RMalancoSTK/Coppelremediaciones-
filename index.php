<?php
session_start();
require_once 'autoload.php';

require_once("config/parameters.php");
require_once("config/config.php");

$url = explode("/", URL);

if ($url[0] == "" && $url[1] == "") {
    Utils::validateSession();
    header(LOCATION_DASHBOARD);
}

$routes = new Router();

$method = $_SERVER["REQUEST_METHOD"];

if ($method == "GET") {
    $datos = $_GET;
} else {
    $datos = $_POST;
}

$routes->run($datos);
