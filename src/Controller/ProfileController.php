<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile", methods={"HEAD","GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        //dd($users);
        foreach($users as $user){
            //dd($user);
            $profile = [
                'lastname' => $user->getLastname(),
                'firstname' => $user->getFirstname(),
                'birthday' => $user->getBirthday()->format('d/m/Y'),
                'email' => $user->getEmail(),
            ];
            //dd($profile);
            return $this->render('profile/index.html.twig', [
                'profile' => $profile,
            ]);
        }
        //dd($profile);
        
    }
}
