<?php

namespace App\Controllers;

use App\Models\Pessoa;
use App\Models\Contato;

class Api
{

    public function adicionarPessoa($args)
    {

        $contatos = $args['contato'];

        $pessoa = new Pessoa();

        $idPessoa = $pessoa->criarPessoa($args['nome'], $args['cpf']);



        foreach ($contatos as $contato) {
            $contatoORM = new Contato();

            $contatoORM->adicionarContato($idPessoa, $contato['tipo'], $contato['descricao']);
        }
        session_start();
        $_SESSION['msg'] = true;
        header('Location: /');
    }
}
