<?php

use App\Controllers\Home;

require "../vendor/autoload.php";
require "../config.php";
$uri = $_SERVER['REQUEST_URI'];

switch ($uri) {
    case '/':
        $controller = new Home();
        $controller->index();
        break;
    default:
        echo '404 Not Found';
}
