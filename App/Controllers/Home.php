<?php

namespace App\Controllers;

use App\Models\Pessoa;

class Home
{
    public function index()
    {

        $pessoa = new Pessoa();

        $pessoas = $pessoa->listarPessoas();

        require(dirname(__DIR__) . '/Views/default/Page.php');
        return;
    }
}
