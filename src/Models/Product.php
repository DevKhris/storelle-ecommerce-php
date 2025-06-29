<?php

namespace App\Models;

use App\Models\Entity;
use Doctrine\ORM\Mapping as ORM;
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

    // #[ORM\Column(type: 'datetime')]
    // private $created_at;

    // #[ORM\Column(type: 'datetime')]
    // private $updated_at;

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

    // /**
    //  * [get's product from database by id]
    //  *
    //  * @param int $productId product id to get
    //  *
    //  * @return json
    //  */
    // public function get($productId, $json = true)
    // {
    //     // fetch products from db
    //     $product = $this->db->select('products', "id=$productId");

    //     // get average rating from product
    //     $average = $this->db->average('rating', 't_rating', 'reviews', 't_reviews', "productId = $productId");

    //     // round value from array and convert to int
    //     $rating = floor($average[0]['t_rating']);
    //     // go towards every row from result

    //     // put values to array
    //     $product = array_replace($product[0], array('rating' => $rating));

    //     if ($json) {
    //         // encode product array to json
    //         $json = json_encode($product);
    //         // Returns the product json
    //         return $json;
    //     }

    //     $result = $product;
    //     return $result;
    // }
}