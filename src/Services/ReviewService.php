<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Doctrine\ORM\EntityManager;
class ReviewService
{
    protected $entityManager;

    public $reviewRepository;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->reviewRepository = $entityManager->getRepository('App\Models\Review');
    }

    public function findByid(int $id): mixed
    {
        $review = $this->reviewRepository->findOneById($id);

        return $review;
    }

    public function store(array $data): Review
    {
        // $user = $this->entityManager->getRepository(className: User::class)->find($userId);
        $product = $this->entityManager->getRepository(Product::class)->find($data['productId']);

        // if (!$user || !$product) {
        //     throw new \Exception("Usuario o producto no encontrado");
        // }

        $review = new Review();
        // $review->setAuthor($user);
        $review->setProduct($product);
        $review->setContent($data['content']);
        $review->setRating($data['rating']);
        $review->setCreatedAt(Carbon::now());

        $this->entityManager->persist($review);
        $this->entityManager->flush();

        return $review;
    }
}
