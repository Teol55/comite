<?php

namespace App\Controller;

use App\Entity\Article;

use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleAdminController extends AbstractController
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
//            $article->setSlug(str_replace(' ','-',$article->getTitle()));

            $em->persist($article);
            $em->flush();

            $this->addFlash('success','le document a bien été enregistré');
            return $this->redirectToRoute('admin_article_list');

        }

        return $this->render('article_admin/new.html.twig', [
            'adminForm' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/article", name="admin_article_list")
     * IsGranted("ROLE_ADMIN_ARTICLE")
     */
    public function list(ArticleRepository $articleRepo)
    {
        $articles = $articleRepo->findAll();

        return $this->render('article_admin/list.html.twig', [
            'articles' => $articles,
        ]);
    }


    /**
     * @Route("/admin/article/{id}/edit", name="admin_article_edit")
     * IsGranted("ROLE_ADMIN_ARTICLE")
     */
    public function edit(Article $article, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(ArticleFormType::class, $article, [

        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {



            $em->persist($article);
            $em->flush();

            $this->addFlash('success', 'Article Updated! Inaccuracies squashed!');

            return $this->redirectToRoute('admin_article_edit', [
                'id' => $article->getId(),
            ]);
        }

        return $this->render('article_admin/edit.html.twig', [
            'articleForm' => $form->createView(),
            'article' => $article,
        ]);
    }
}

