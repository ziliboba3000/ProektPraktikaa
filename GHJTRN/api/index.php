<?php
    header("Access-Control-Allow-Origin: http://localhost");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Headers: Content-Type, *");

    require('../classes/Api.php');
    require('../classes/Application.php');

    $interface = isset($_GET['interface']) ? $_GET['interface'] : '';
    $method = isset($_GET['method']) ? $_GET['method'] : '';

    define('API', new Api($interface, $method, $_POST ?? $_GET));
    // define('APP', new Application($interface, $method, $_POST ?? $_GET));
    API->execute();
?>