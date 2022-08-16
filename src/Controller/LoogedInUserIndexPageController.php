<?php

namespace App\Controller;

use App\Entity\Users;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class LoogedInUserIndexPageController extends AbstractController
{
    #[Route('/looged/in/user', name: 'app_looged_in_user_index_page')]
    public function index(UserInterface $user, Request $request, ManagerRegistry $doctrine): Response
    {
        $userRepo = $doctrine->getRepository(Users::class);
        $loogedInUser = $userRepo->findOneBy(['id' => $user->getId()]);
        $email = $loogedInUser->getFirstName();
        $checkActiveAccount = $loogedInUser->getTokens()->isActiveAccount();
        if ($checkActiveAccount != true)
        {
//            $this->addFlash('danger', 'Twoje konto nie jest jeszcze aktywne, kliknij poniżej aby potwierdzić swój E-mail');
            return $this->render('index_user_page/index.html.twig', [
                'checkAcctiveAccount' => 1,

            ]);
        }
//dd($email);

        return $this->render('index_user_page/index.html.twig', [

        ]);
    }
}