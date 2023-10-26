<?php

namespace App\Controllers;

use App\Models\Pessoa;

class Home
{
    public function index()
    {
        session_start();

        $msg = false;
        if (isset($_SESSION['msg']) && $_SESSION['msg']) {
            unset($_SESSION['msg']);
            $msg = true;
        }

        $pessoa = new Pessoa();

        $pesquisa = '';
        if (isset($_SESSION['pesquisa'])) {
            $pessoas = $pessoa->pesquisarNome($_SESSION['pesquisa']);
            $pesquisa = $_SESSION['pesquisa'];
            // unset($_SESSION['pesquisa']);
        } else {
            $pessoas = $pessoa->listarPessoas();
        }



        require(dirname(__DIR__) . '/Views/default/Page.php');
        return;
    }
}
