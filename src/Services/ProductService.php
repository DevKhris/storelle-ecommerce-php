<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Review;
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

    public function getAverageRating(Product $product): float
    {
        return (float) $this->entityManager->createQueryBuilder()
            ->select('AVG(r.rating)')
            ->from(Product::class, 'p')
            ->join('p.reviews', 'r') // relación ManyToMany
            ->where('p = :product')
            ->setParameter('product', $product)
            ->getQuery()
            ->getSingleScalarResult();
    }

}
