<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\EntityRepository;

/**
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[] findAll()
 * @method Post[] findBy(array $criteria, array $orderBy = null, $limit =null, $offset = null)
 */
class PostRepository extends EntityRepository
{
    public function __construct()
    {
        parent::__construct(\Environment::getEntityManager(), new ClassMetadata(Post::class));
    }
}
