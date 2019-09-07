<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\UserFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserAdminController extends AbstractController
{
    /**
     * @Route("/user/new", name="admin_user_new")
     * @IsGranted("ROLE_ADMIN_ARTICLE")
     */
    public function new(EntityManagerInterface $em,Request $request)
    {
        $form=$this->createForm(UserFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var User $user */
            $user=$form->getData();
            $em->persist($user);
            $em->flush($user);
            $this->addFlash('success','L\'utilisateur a bien été ajouté.');
        return $this->redirectToRoute('admin_user_list');
        }

        return $this->render('user_admin/new.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/list",name="admin_user_list")
     * @IsGranted("ROLE_ADMIN_ARTICLE")
     */
    public function list(UserRepository $userRepo){
        $users=$userRepo->findAll();
        return $this->render('user_admin/list.html.twig',[
            'users'=> $users
        ]);



}
}
