<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class Environment
{
    public static function enableDotenv():void
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__.'/../');
        $dotenv->load();
        
    }
    public static function getEntityManager(): EntityManager
    {
        self::enableDotenv();
        $path = [__DIR__ . '/Entity'];
        $dbParams = [
            'driver'   => $_ENV['DB_DRIVER'],
            'user'     => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD'],
            'dbname'   => $_ENV['DB_NAME'],
            'host'     => $_ENV['DB_HOST'],
            'port'     => $_ENV['DB_PORT'],
        ];

        $ORMConfig = ORMSetup::createAttributeMetadataConfiguration($path, $_ENV['DEV_MODE']);
        $connection = DriverManager::getConnection($dbParams);
        return new EntityManager($connection,$ORMConfig);
    }

}