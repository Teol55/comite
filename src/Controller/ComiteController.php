<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ComiteController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function index()
    {
        return $this->render('comite/index.html.twig', [
            'controller_name' => 'ComiteController',
        ]);
    }
}
