<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;

class AbstractController
{
    private const VIEW_DIR = __DIR__.'/../views/';
    protected EntityManager $entityManager;
    
    public function __construct()
    {
        $this->entityManager = \Environment::getEntityManager();
    }
    public function view(string $name, array $params =[]): void
    {
        if ($name !== 'login' && $name!== 'register' && !(isset($_SESSION["USER"]))) {
            header('Location: '. $_ENV['DOMAIN_NAME'] . 'login');
        }
        
        require self::VIEW_DIR . $name . '.view.php';
    }
}
