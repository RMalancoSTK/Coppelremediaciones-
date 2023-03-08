<?php

function controllersAutoload($classnames)
{
    if (file_exists('controllers/' . $classnames . '.php')) {
        require_once 'controllers/' . $classnames . '.php';
    } elseif (file_exists('models/' . $classnames . '.php')) {
        require_once 'models/' . $classnames . '.php';
    } elseif (file_exists('helpers/' . $classnames . '.php')) {
        require_once 'helpers/' . $classnames . '.php';
    } elseif (file_exists('config/' . $classnames . '.php')) {
        require_once 'config/' . $classnames . '.php';
    } elseif (file_exists('routes/' . $classnames . '.php')) {
        require_once 'routes/' . $classnames . '.php';
    } elseif (file_exists('connection/' . $classnames . '.php')) {
        require_once 'connection/' . $classnames . '.php';
    } elseif (file_exists('core/' . $classnames . '.php')) {
        require_once 'core/' . $classnames . '.php';
    }
}
spl_autoload_register('controllersAutoload');
