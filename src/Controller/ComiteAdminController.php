<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ComiteAdminController extends AbstractController
{
    /**
     * @Route("/admin/article", name="admin_article_new")
     */
    public function new(EntityManagerInterface $em)

    {
        return $this->render('comite_admin/admin.html.twig', [
            'controller_name' => 'ComiteController',
        ]);
    }

}

