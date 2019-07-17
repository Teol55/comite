<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Request;
use App\Form\ArticleFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ComiteAdminController extends AbstractController
{
    /**
     * @Route("/article/new", name="admin_article_new")
     * IsGranted("ROLE_ADMIN_ARTICLE")
     */
    public function new(EntityManagerInterface $em)
    {

        $form = $this->createForm(ArticleFormType::class);

        return $this->render('article_admin/admin.html.twig', [
            'adminForm' => $form->createView()
        ]);
    }

}

