<?php

use App\Models\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('shopping_carts')]
class ShoppingCart extends Entity
{
    private int $id;

    private int $userId;

    private int $productId;

    private int $quantity;

    #[ORM\Column(type: 'datetime')]
    private $created_at;

    #[ORM\Column(type: 'datetime')]
    private $updated_at;
}
