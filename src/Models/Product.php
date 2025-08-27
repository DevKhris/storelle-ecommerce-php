<?php

namespace App\Models;

use App\Models\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InverseJoinColumn;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity]
#[ORM\Table('products')]
class Product extends Entity
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue('AUTO')]
    protected int $id;

    #[ORM\Column(type: 'string')]
    protected string $name;

    // #[@Gedmo\Slug(fields: 'name')]
    // #[ORM\Column(type: 'string')]
    protected string $slug;

    #[ORM\Column(type: 'float')]
    protected float $price;

    #[ORM\Column(type: 'string')]
    protected string $image_url;

    #[ORM\Column(type: 'datetime')]
    private $created_at;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updated_at;
    
    #[ORM\Column(type: 'datetime', nullable: true)]
    private $deleted_at;

    /**
     * Many products have many reviews.
     * @var Collection<int, Review>
     */
    #[JoinTable(name: 'products_reviews')]
    #[JoinColumn(name: 'product_id', referencedColumnName: 'id')]
    #[InverseJoinColumn(name: 'review_id', referencedColumnName: 'id')]
    #[ManyToMany(targetEntity: 'Review')]
    protected Collection $reviews;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * Get the value of slug
     */ 
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * Set the value of slug
     *
     * @return  self
     */ 
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getImageUrl(): string
    {
        return $this->image_url;
    }

    /**
     * Get the value of reviews
     */ 
    public function getReviews()
    {
        return $this->reviews;
    }
}