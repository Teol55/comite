<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class ComiteController
 * @package App\Controller
 * @IsGranted("ROLE_USER")
 */
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
    /**
     * @Route("/contact", name="app_contact")
     */
    public function contact()
    {
        return $this->render('comite/contact.html.twig', [
            'controller_name' => 'ComiteController',
        ]);
    }
    /**
     * @Route("/articles/{slug}",name="app_articles")
     */
    public function show($slug)
    {
        return $this->render('comite/show.html.twig', [
                'title' => (str_replace('-', ' ', $slug)),]);
    }
}
