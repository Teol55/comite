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
        $article= New Article();
        $article->setTitle('EUROPA PARK')->setSlug('europa-park')->setContent('Le comité vous propose une vente unique de billetterie,Les commandes se feront auprès des membres du comité jusqu au

     5 AVRIL 2019  accompagnées du règlement.');
      $em->persist($article);
       $em->flush();

        return new Response(sprintf(
            'Hiya! New Article id: #%d slug: %s',
            $article->getId(),
            $article->getSlug()
        ));
    }
}
