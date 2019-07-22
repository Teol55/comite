<?php

namespace App\Controller;

use App\Entity\Article;

use App\Form\ArticleFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ComiteAdminController extends AbstractController
{
    /**
     * @Route("/article/new", name="admin_article_new")
     * IsGranted("ROLE_ADMIN_ARTICLE")
     */
    public function new(EntityManagerInterface $em,Request $request)
    {

        $form = $this->createForm(ArticleFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Article $article */
            $article=$form->getData();

            $em->persist($article);
            $em->flush();

            $this->addFlash('success','le document a bien été enregistré');
            return $this->redirectToRoute('app_homepage');

        }

        return $this->render('article_admin/new.html.twig', [
            'adminForm' => $form->createView()
        ]);
    }

}

