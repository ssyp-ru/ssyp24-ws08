<?php
namespace App\Service;

class BaseService
{
    protected $entityManager;
    
    public function __construct()
    {
        $this->entityManager = \Environment::getEntityManager();
    }
}
