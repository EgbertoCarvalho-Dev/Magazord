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
        return;
    }

    public function detalharPessoa($id)
    {

        $pessoa = new Pessoa();

        $pessoa = $pessoa->lerPessoa($id);

        $contato = new Contato();

        $contatos = $contato->readContact($id);
        $vectorContacts = [];
        foreach ($contatos as $contato) {
            $vectorContacts[] = [
                'id' => $contato->id,
                'type' => $contato->tipo,
                'description' => $contato->descricao
            ];
        }

        header('Content-Type: application/json');

        $vector = [
            'name' => $pessoa->nome,
            'cpf' => $pessoa->cpf,
            'contacts' => $vectorContacts
        ];
        echo json_encode($vector);
        return;
    }
}
