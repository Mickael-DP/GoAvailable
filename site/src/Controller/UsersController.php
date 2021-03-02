<?php

namespace App\Controller;

use App\Entity\Club;
use App\Form\ClubFormType;
use App\Form\EditProfileType;
use App\Form\DeleteUserFormType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="users")
     */
    public function monprofil()
    {
        return $this->render('users/monprofil.html.twig');
    }

    public function editprofil(Request $request): Response
    {   
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'Profil mis à jour');
            return $this->redirectToRoute('monprofil');
        }

        return $this->render('users/editprofil.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    public function deleterUser(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(DeleteUserFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $session = $this->get('session');
            $session = new Session();
            $session->invalidate();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('accueil');
        }

        return $this->render('delete/deleteuser.html.twig', [
            'DeleteForm' => $form->createView(),
        ]);
    }

}
