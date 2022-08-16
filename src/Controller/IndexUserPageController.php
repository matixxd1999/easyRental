<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexUserPageController extends AbstractController
{
    #[Route('/', name: 'app_index_user_page')]
    public function index(): Response
    {
        return $this->render('index_user_page/index.html.twig', [

        ]);
    }
}
