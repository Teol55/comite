<?php

namespace App\Controller;

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
     * @Route("/PvCSE",name="app_PvCSE")
     */
    public function PvCE()
    {
        return $this->render('comite/PvCSE.html.twig', [
            'title' => 'PV CSE'
        ]);
    }
    /**
     * @Route("/partenaires",name="app_partenaire")
     */
    public function partenaire ()
    {
        return $this->render('comite/partner.html.twig', [
            'title' => 'Nos Partenaires'
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


