<?php
namespace App\Entity;

use App\Entity\User;
use App\Entity\Post;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('likes')]
class Like
{
    #[Id]
    #[Column, GeneratedValue]
    private int $id;

    #[ManyToOne(targetEntity: User::class, inversedBy: 'likes')]
    private User $user;
    
    #[ManyToOne(targetEntity: Post::class, inversedBy: 'likes')]
    private Post $post;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getPost(): Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;
        return $this;
    }
};