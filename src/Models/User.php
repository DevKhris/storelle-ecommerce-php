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

#[ORM\Entity]
#[ORM\Table('users')]
class User extends Entity
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $username;

    #[ORM\Column(type: 'string')]
    private string $email;

    #[ORM\Column(type: 'string')]
    private string $password;

    #[ORM\Column(type: 'datetime')]
    private $created_at;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updated_at;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $deleted_at;

    /**
     * Many users have many reviews.
     * @var Collection<int, Review>
     */
    #[ManyToMany(targetEntity: 'Review', inversedBy: 'users')]
    #[JoinTable(name: 'users_reviews')]
    #[JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    #[InverseJoinColumn(name: 'review_id', referencedColumnName: 'id')]

    protected Collection $reviews;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }

    /**
     * Get the value of username
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * Get the value of password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * Get the value of created_at.
     */ 
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at.
     */ 
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * Get the value of reviews
     */ 
    public function getReviews(): Collection
    {
        return $this->reviews;
    }
}
