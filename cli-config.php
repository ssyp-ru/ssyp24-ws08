<?php

use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;

require __DIR__ . '/vendor/autoload.php';
require __DIR__.'/src/Environment.php';

$entityManager = Environment::getEntityManager();
$config = new PhpFile('migrations.php');

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));
