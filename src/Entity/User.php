<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Like;
use App\Entity\Post;

#[Entity]
#[Table('users')]
class User 
{   
    #[Id]
    #[Column, GeneratedValue]
    private int $id;

    #[Column(type: 'string', length: 30, unique: true, nullable: false)]
    private string $username;

    #[Column(type: 'string', length: 300, nullable: false)]
    private string $password;

    #[Column(type: 'string', length: 30, unique: true, nullable: false)]
    private string $email;

    #[Column(type: 'simple_array', nullable: false)]
    private array $roles;

    #[OneToMany(mappedBy: 'user', targetEntity: Like::class, cascade: ['persist', 'remove'])]
    private Collection $likes;

    #[OneToMany(mappedBy: 'user', targetEntity: Post::class, cascade: ['persist', 'remove'])]
    private Collection $posts;

    public function __construct()
    {
        $this->likes = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->roles = ["ROLE_USER"];
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }
    
    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function addRole(string $role): self
    {
        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;    
        }
        
        return $this;
    }

    public function removeRole(string $role): self
    {
        if (in_array($role, $this->roles, true)) {
            $this->roles = array_diff($this->roles, [$role]);
        }
        
        return $this;
    }

    public function isAdmin(): bool
    {
        return in_array('ROLE_ADMIN', $this->roles, true);
    }

    public function isBan(): bool
    {
        return in_array('ROLE_BLACKLIST', $this->roles, true);
    }

    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $post->setUser($this);
            $this->posts->add($post);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $post->setUser(null);
            $this->posts->removeElement($post);
        }
        
        return $this;
    }

    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Like $like): self
    {
        if (!$this->likes->contains($like)) {
            $like->setUser($this);
            $this->likes->add($like);
        }

        return $this;
    }

    public function removeLike(Like $like): self
    {
        if (!$this->likes->contains($like)) {
            $like->setUser(null);
            $this->likes->removeElement($like);
        }
        
        return $this;
    }

    public function __toString(): string
    {
        return $this->getUsername();        
    }
};