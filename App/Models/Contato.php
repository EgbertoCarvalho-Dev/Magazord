<?php

namespace App\Models;

use Doctrine\ORM\Mapping\Id;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use App\Helper\EntityManagerFactory;
use Doctrine\ORM\Mapping\GeneratedValue;


#[Entity]
class Contato
{
    #[Id]
    #[Column(type: Types::INTEGER)]
    #[GeneratedValue(strategy: 'AUTO')]
    private int $id;
    #[Column(type: Types::STRING)]
    private string $tipo;
    #[Column(type: Types::STRING)]
    private string $descricao;
    #[Column(type: Types::INTEGER)]
    private int $idPessoa;


    public function __get($attr)
    {
        return $this->$attr;
    }

    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }


    public function adicionarContato($idPessoa, $tipo, $descricao)
    {
        $contato = new Contato();
        $contato->__set('idPessoa', $idPessoa);
        $contato->__set('tipo', $tipo);
        $contato->__set('descricao', $descricao);

        $entityManager = new EntityManagerFactory();

        $entityManager = $entityManager->getEntityManager();
        $entityManager->persist($contato);
        $entityManager->flush();

        return $contato->__get('id');
    }

    public function lerContato($idPessoa)
    {
        $entityManager = new EntityManagerFactory();
        $entityManager = $entityManager->getEntityManager();

        $productRepository = $entityManager->getRepository('App\Models\Contato');

        return $productRepository->findBy(['idPessoa' => $idPessoa]);
    }

    public function removerContato($idContato)
    {
        $entityManager = new EntityManagerFactory();
        $entityManager = $entityManager->getEntityManager();

        $pessoa = $entityManager->getRepository('App\Models\Contato')->find($idContato);
        if ($pessoa !== null) {
            $entityManager->remove($pessoa);
            $entityManager->flush();

            return true;
        } else {
            return false;
        }
    }
}
