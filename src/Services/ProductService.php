<?php

namespace App\Services;

use Doctrine\ORM\EntityManager;

class ProductService
{
    protected $entityManager;

    public $productRepository;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->productRepository = $entityManager->getRepository('App\Models\Product');
    }

    public function getAll(): array
    {
        $products = $this->productRepository->findAll();

        return $products;
    }

    public function findByid(int $id): mixed
    {
        $product = $this->productRepository->findOneById($id);

        return $product;
    }

}
