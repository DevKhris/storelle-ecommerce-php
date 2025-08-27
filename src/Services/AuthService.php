<?php

namespace App\Services;

use App\Enums\AuthEnum;
use App\Models\User;
use Aura\Session\Session;
use Aura\Session\SessionFactory;
use Doctrine\ORM\EntityManager;
use  Carbon\Carbon;
use Doctrine\ORM\EntityRepository;

class AuthService
{
    private EntityRepository $userRepository;
    private Session $sessionManager;

    public function __construct(EntityManager $entityManager, Session $sessionManager) {
        $this->userRepository = $entityManager->getRepository('App\Models\User');
        $this->sessionManager = $sessionManager;
    }

    public function validate(array $data): bool
    {
        try {
                if (empty($data['email']) || empty($data['password'])) 
                {
                    echo 'Warning: Please fill both fields';
                }

                $segment = $this->sessionManager->getSegment('auth');
                $user = $this->userRepository->findOneBy(['email' => $data['email']]);

                if (! empty($user)) {
                    if (password_verify($data['password'], $user->getPassword())) {
                        $segment->set('isValid', (bool) AuthEnum::VALID);
                        $segment->set('username', $user->getUsername());

                        return true;
                    }
                } else {
                    return false;
                }

                return false;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function register(array $data): bool
    {
        try {
            if (! empty($data['email']) && ! empty($data['password'])) {
                $sanitizedEmail = $this->sanitizeInput($data['email']);
                $passwordHash = password_hash($this->sanitizeInput($data['password']), PASSWORD_BCRYPT);

                $user = new User;
                $user->setUsername($this->sanitizeInput($data['username']));
                $user->setEmail($sanitizedEmail);
                $user->setPassword($passwordHash);
                $user->setCreatedAt(Carbon::now());
                $this->userRepository->getEntityManager()->persist($user);
                $this->userRepository->getEntityManager()->flush();

                return true;
            }
            return false;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function logout(): void
    {
        $segment = $this->sessionManager->getSegment('auth');
        $segment->clear();
        $this->sessionManager->destroy();
    }


    public function sanitizeInput(string $value): string
    {
        return strip_tags(htmlentities($value));
    }
}