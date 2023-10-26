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

        $contatos = $contato->lerContato($id);
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
            'id' => $pessoa->id,
            'name' => $pessoa->nome,
            'cpf' => $pessoa->cpf,
            'contacts' => $vectorContacts
        ];
        echo json_encode($vector);
        return;
    }

    public function removerContato($id)
    {
        $contato = new Contato();

        if ($contato->removerContato($id)) {
            $data['status'] = true;
        } else {
            $data['status'] = false;
        }

        header('Content-Type: application/json');

        echo json_encode($data);
    }

    public function removerPessoa($id)
    {
        $pessoa = new Pessoa();

        if ($pessoa->removerPessoa($id)) {
            $data['status'] = true;
        } else {
            $data['status'] = false;
        }

        header('Content-Type: application/json');

        echo json_encode($data);
        return;
    }

    public function pesquisarPessoa($id)
    {
        return;
    }

    public function atualizarPessoa($args)
    {
        $contatos = $args['contato'];
        $pessoa = new Pessoa();

        $pessoa->atualizarPessoa($args['idPessoa'], $args['nome'], $args['cpf']);

        foreach ($contatos as $contato) {
            $contatoORM = new Contato();
            if (isset($contato['id'])) {
                $contatoORM->atualizarContato($contato['id'], $contato['tipo'], $contato['descricao']);
            } else {
                $contatoORM->adicionarContato($args['idPessoa'], $contato['tipo'], $contato['descricao']);
            }
        }
        session_start();
        $_SESSION['msg'] = true;
        header('Location: /');
    }
}
