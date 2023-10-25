<?php

namespace App\Models;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Base
{
    protected $entityManager;
    public function __construct()
    {
        $paths = [str_replace('\\', '/', __DIR__) . "/tmp/Entities"];

        echo '<pre>';
        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);

        //aqui configuramos a conexão com banco de dados
        $params = [
            'url' => "mysql://" . USERNAME . ":" . PASSWORD . "@" . HOSTNAME . "/" . DATABASE
        ];

        //Obter a instância da classe Entity Manager
        $this->entityManager = EntityManager::create($params, $config);
    }
}
