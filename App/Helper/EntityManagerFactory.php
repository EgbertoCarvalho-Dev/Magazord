<?php

namespace App\Helper;

use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;


class EntityManagerFactory
{

    public function getEntityManager()
    {
        $paths = [str_replace('\\', '/', __DIR__) . "/tmp/Entities"];

        $isDevMode = false;

        // the connection configuration
        $dbParams = [
            'driver'   => 'pdo_mysql',
            'user'     => USERNAME,
            'password' => PASSWORD,
            'dbname'   => DATABASE,
        ];

        $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
        $connection = DriverManager::getConnection($dbParams, $config);
        return new EntityManager($connection, $config);
    }
}
