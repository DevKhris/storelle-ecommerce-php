<?php

namespace App\Models;

use App\Models\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('products')]
class Product extends Entity
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    protected $id;

    #[ORM\Column(type: 'string')]
    protected $name;

    #[ORM\Column(type: 'float')]
    protected $price;

    #[ORM\Column(type: 'string')]
    protected $image_url;

    #[ORM\Column(type: 'datetime')]
    private $created_at;

    #[ORM\Column(type: 'datetime')]
    private $updated_at;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
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