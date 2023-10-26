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
        break;
    case '/api/pesquisarPessoa':
        session_start();
        $_SESSION['pesquisa'] = $_POST['nome'];
        header("Location: /");
        break;
    case '/api/atualizarPessoa':
        $controller = new Api();
        $controller->atualizarPessoa($_POST);
        break;
    default:
        echo '404 Not Found';
}
