<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'sistema_versiones');
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_CHAR", "utf8");

// Constantes de la configuración de la aplicación
define("CONTROLLER_DEFAULT", "DashboardController");
define("ACTION_DEFAULT", "inicio");
define("BASE_URL", getBaseUrl());

// titulo de app o nombre de la empresa
define("TITLE_APP", "Remediaciones");

function getBaseUrl()
{
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https://' ? 'https://' : 'http://';
    $host     = $_SERVER['HTTP_HOST'];
    $script   = $_SERVER['SCRIPT_NAME'];
    $dir      = $_SERVER['SERVER_PORT'] == 8080 ? rtrim(dirname($script), '/\\') : '';
    return $protocol . $host . $dir . '/';
}

// location all urls pages
define("LOCATION_BASE_URL", "Location: " . BASE_URL); // base url
define("LOCATION_LOGIN", LOCATION_BASE_URL . "login/index"); // login
define("LOCATION_DASHBOARD", LOCATION_BASE_URL . "home/dashboard"); // dashboard

define("ERROR_PAGE", "Error 404: Página no encontrada");
