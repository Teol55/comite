<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Pvce;
use App\Repository\ArticleRepository;
use App\Repository\PartnerRepository;
use App\Repository\PvceRepository;
use App\Repository\TicketRepository;
use App\Repository\ToolRepository;
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
    public function index(ArticleRepository $articleRepos,PvceRepository $pvceRepository)
    {
        $pvce=$pvceRepository->findOneBy([], ['id' => 'desc']);
        $articles=$articleRepos->findAll();
        return $this->render('comite/index.html.twig', [
            'articles' => $articles,
            'pvce' => $pvce
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
    public function show(Article $article)
    {
        return $this->render('comite/show.html.twig', [
                'article' => $article,]);
    }
    /**
     * @Route("/billetterie",name="app_billetterie")
     */
    public function Ticket(TicketRepository $repository)
    {
        $tickets= $repository->findAll();
        return $this->render('comite/ticket.html.twig', [
            'title' => 'Billetterie Battants',
            'tickets'=> $tickets ,]);
    }

    /**
     * @Route("/PvCSE/{id}",name="app_PvCSE")
     */
    public function PvCE(Pvce $pvce,PvceRepository $pvceRepository)
    {

        $pvces=$pvceRepository->findAll();
        return $this->render('comite/PvCSE.html.twig', [
            'pvce'=> $pvce,
            'pvces'=>$pvces,
        ]);
    }
    /**
     * @Route("/partenaires",name="app_partenaire")
     */
    public function partenaire (PartnerRepository $repository)

    {
        $partners=$repository->findAll();
        return $this->render('comite/partner.html.twig', [
            'title' => 'Nos Partenaires',
            'partners'=> $partners,
        ]);
    }
    /**
     * @Route("/outillage",name="app_tool")
     */
    public function tool (ToolRepository $repository)
    {
        $tools=$repository->findAll();
        return $this->render('comite/tool.html.twig', [
            'title'=> 'Location de Materiel',
            'tools' => $tools
        ]);
    }

}


