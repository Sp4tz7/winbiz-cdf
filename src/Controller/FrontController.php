<?php

namespace App\Controller;

use App\Service\WinbizManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(WinbizManager $winbizManager): Response
    {  
        return $this->render('front/index.html.twig', [
            'action' => $winbizManager->getAction(),
        ]);
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function admin(WinbizManager $winbizManager): Response
    {

        return $this->render('front/index.html.twig', [
            'action' => $winbizManager->getAction(),
        ]);
    }
}
