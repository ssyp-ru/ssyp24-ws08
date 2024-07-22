<?php
namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\EntityRepository;

/**
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[] findAll()
 * @method User[] findBy(array $criteria, array $orderBy = null, $limit =null, $offset = null)
 */
class UserRepository extends EntityRepository
{
    public function __construct()
    {
        parent::__construct(\Environment::getEntityManager(), new ClassMetadata(User::class));
    }
}
