<?php

use App\Controllers\Api;
use App\Controllers\Home;

require "../vendor/autoload.php";
require "../config.php";
$uri = $_SERVER['REQUEST_URI'];

switch ($uri) {
    case '/':
        $controller = new Home();
        $controller->index();
        break;
    case '/api/adicionarPessoa':

        $controller = new Api();
        $controller->adicionarPessoa($_POST);
        break;

    case '/api/consultarPessoa':
        $controller = new Api();
        $controller->detalharPessoa($_POST['id']);
        break;
    default:
        echo '404 Not Found';
}
