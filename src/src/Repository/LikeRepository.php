<?php

namespace App\Repository;

use App\Entity\Like;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\EntityRepository;

/**
 * @method Like|null findOneBy(array $criteria, array $orderBy = null)
 * @method Like[] findAll()
 * @method Like[] findBy(array $criteria, array $orderBy = null, $limit =null, $offset = null)
 */
class LikeRepository extends EntityRepository
{
    public function __construct()
    {
        parent::__construct(\Environment::getEntityManager(), new ClassMetadata(Like::class));
    }
}
