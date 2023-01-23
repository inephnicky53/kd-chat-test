<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiLoginController extends AbstractController
{
    #[Route('/api/login', name: 'api_login')]
    public function index(UserRepository $userRepository): Response
    {
        /**
         * @var $user User
         */
        $user = $this->getUser();
        $user->setApiToken(sha1(uniqid()));
        $userRepository->save($user, true);

        return $this->json([
            'apiToken' => $user->getApiToken(),
            'id' => $user->getId(),
            'fullName' => $user->getFullName(),
            "email" => $user->getEmail()
        ]);
    }
}
