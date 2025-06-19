<?php
    // error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1); 
    error_reporting(E_ALL);

    require_once('classes/Application.php');
    require_once('classes/Api.php');
    require_once('classes/Record.php');

    new Application();
    new Api();

    if (!Application::instance()->isApi) {
        require('layout/head.php');
        require('layout/body.php');
    } else Api::instance()->execute();
?>