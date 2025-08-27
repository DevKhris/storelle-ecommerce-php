<?php

namespace App\Models;

use App\Models\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity]
#[ORM\Table('reviews')]
class Review extends Entity
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue('AUTO')]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $content;

    #[ORM\Column(type: 'float')]
    private float $rating;

    #[ORM\Column(type: 'datetime')]
    private $created_at;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updated_at;
    
    #[ORM\Column(type: 'datetime', nullable: true)]
    private $deleted_at;
    
    #[ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private ?User $author = null;

    #[ManyToOne(targetEntity: Product::class)]
    #[ORM\JoinColumn(name: 'product_id', referencedColumnName: 'id')]
    private ?Product $product = null;

    /**
     * Get the value of content
     */ 
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * Get the value of rating
     */ 
    public function getRating(): float
    {
        return $this->rating;
    }

    /**
     * Set the value of rating
     *
     * @return  self
     */ 
    public function setRating($rating): void
    {
        $this->rating = $rating;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreatedAt(): mixed
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreatedAt($createdAt): void
    {
        $this->created_at = $createdAt;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): void
    {
        $this->author = $author;
    }

    /**
     * Get the value of product
     */ 
    public function setProduct(?Product $product): void
    {
        $this->product = $product;
    }
}
