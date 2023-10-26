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
    case '/api/removerContato':
        $controller = new Api();
        $controller->removerContato($_POST['id']);
        break;
    case '/api/removerPessoa':
        $controller = new Api();
        $controller->removerPessoa($_POST['id']);
    case '/api/pesquisarPessoa':
        $controller = new Api();
        $controller->pesquisarPessoa($_POST['nome']);
    default:
        echo '404 Not Found';
}
