<?php

namespace App\Entity;

use App\Entity\Like;
use App\Entity\User;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity]
#[Table('posts')]
class Post 
{
    public const TEXT_LENGTH = 200;

    #[Id]
    #[Column, GeneratedValue]
    private int $id;

    #[ManyToOne(targetEntity: User::class, inversedBy: 'posts')]
    private User $user;

    #[Column(type: 'string', length: self::TEXT_LENGTH, nullable: false)]
    private string $text;
    
    #[Column(type: 'datetime_immutable', length: 30, nullable: false)]
    private \DateTimeImmutable $date;

    #[ManyToOne(targetEntity: Post::class, inversedBy: 'comments')]
    private ?Post $post;

    #[OneToMany(targetEntity: Post::class, mappedBy: 'post', cascade: ['persist', 'remove'])]
    private Collection $comments;

    #[OneToMany(targetEntity: Like::class, mappedBy: 'post', cascade: ['persist', 'remove'])]
    private Collection $likes;

    public function __construct()
    {
        $this->likes = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

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

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {   
        if (strlen($text) <= self::TEXT_LENGTH)
            $this->text = $text;
        return $this;
    }

    public function setDate(\DateTimeImmutable $date): self
    {   
        $this->date = $date;
        return $this;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;
        return $this;
    }

    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Post $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $comment->setPost($this);
            $this->comments->add($comment);
        }

        return $this;
    }

    public function removeComment(Post $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $comment->setPost(null);
            $this->comments->removeElement($comment);
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
            $like->setPost($this);
            $this->likes->add($like);
        }

        return $this;
    }

    public function removeLike(Like $like): self
    {
        if (!$this->likes->contains($like)) {
            $like->setPost(null);
            $this->comments->removeElement($like);
        }
        
        return $this;
    }
}