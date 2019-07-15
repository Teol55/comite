<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/article/admin", name="article_admin")
     * IsGranted("ROLE_ADMIN_ARTICLE")
     */
    public function index()
    {
        return $this->render('article_admin/index.html.twig', [
            'controller_name' => 'ArticleAdminController',
        ]);
    }
}
