<?php

namespace App\Models;

use Doctrine\ORM\Mapping\Id;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use App\Helper\EntityManagerFactory;
use Doctrine\ORM\Mapping\GeneratedValue;

#[Entity]
class Pessoa
{
    #[Id]
    #[Column(type: Types::INTEGER)]
    #[GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[Column(type: Types::STRING)]
    private string $nome;

    #[Column(type: Types::STRING)]
    private string $cpf;

    public function __get($attr)
    {
        return $this->$attr;
    }

    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }

    public function criarPessoa($nome, $cpf)
    {

        $pessoa = new Pessoa();
        $pessoa->__set('nome', $nome);
        $pessoa->__set('cpf', $cpf);

        $entityManager = new EntityManagerFactory();

        $entityManager = $entityManager->getEntityManager();
        $entityManager->persist($pessoa);
        $entityManager->flush();

        return $pessoa->__get('id');
    }

    public function listarPessoas()
    {
        $entityManager = new EntityManagerFactory();

        $entityManager = $entityManager->getEntityManager();

        $productRepository = $entityManager->getRepository('App\Models\Pessoa');

        $queryBuilder = $productRepository->createQueryBuilder('p');

        $queryBuilder->select('p');

        return $queryBuilder->getQuery()->getResult();
    }

    public function lerPessoa($id)
    {
        $entityManager = new EntityManagerFactory();
        $entityManager = $entityManager->getEntityManager();

        $productRepository = $entityManager->getRepository('App\Models\Pessoa');

        return $productRepository->find($id);
    }

    public function removerPessoa($idContato)
    {
        $entityManager = new EntityManagerFactory();
        $entityManager = $entityManager->getEntityManager();

        $pessoa = $entityManager->getRepository('App\Models\Pessoa')->find($idContato);
        if ($pessoa !== null) {
            $entityManager->remove($pessoa);
            $entityManager->flush();

            return true;
        } else {
            return false;
        }
    }

    public function pesquisarNome($pesquisa)
    {
        $entityManager = new EntityManagerFactory();
        $entityManager = $entityManager->getEntityManager();
        $query = $entityManager->createQuery('
                                                SELECT p
                                                FROM App\Models\Pessoa p
                                                WHERE p.nome LIKE :nome
                                            ')->setParameter('nome', '%' . $pesquisa . '%');

        return $query->getResult();
    }

    public function atualizarPessoa($idPessoa, $nome, $cpf)
    {
        $entityManager = new EntityManagerFactory();
        $entityManager = $entityManager->getEntityManager();

        $pessoa = $entityManager->getRepository('App\Models\Pessoa')->find($idPessoa);

        $pessoa->__set('nome', $nome);
        $pessoa->__set('cpf', $cpf);

        $entityManager->flush();
    }
}
