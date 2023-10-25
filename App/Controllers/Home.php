<?php

namespace App\Controllers;

use App\Models\Pessoa;

class Home
{
    public function index()
    {

        $pessoa = new Pessoa();
        die();
        require(dirname(__DIR__) . '/Views/default/indexPage.php');
        return;
    }
}
