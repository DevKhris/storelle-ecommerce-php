<?php

namespace App\Models;

use App\Models\Entity;
use Doctrine\ORM\Mapping as ORM;

// #[ORM\Entity]
// #[ORM\Table('reviews')]
class Review extends Entity
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    private $product_id;

    private $user_id;

    #[ORM\Column(type: 'string')]
    private string $content;

    #[ORM\Column(type: 'float')]
    private float $rating;

    #[ORM\Column(type: 'datetime')]
    private $created_at;

    #[ORM\Column(type: 'datetime')]
    private $updated_at;
}
