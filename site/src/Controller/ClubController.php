<?php

namespace App\Controller;

use App\Entity\Club;
use App\Form\ClubFormType;
use App\Repository\ClubRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ClubController extends AbstractController
{
    public function createclub(Request $request): Response
    {   

        $club = new Club;
        $clubform = $this->createForm(ClubFormType::class, $club);

        $clubform->handleRequest($request);

        if($clubform->isSubmitted() && $clubform->isValid()){
            $club->setManager($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($club);
            $em->flush(); 

            return $this->render('users/monclub.html.twig', [
                'monclub' => $club,
            ]);
        }

        return $this->render('users/createclub.html.twig', [
            'clubform' => $clubform->createView(),
        ]);
    }

    public function monclub(ClubRepository $clubRepo)
    {   $user = $this->getUser();
        $club = $clubRepo->findClubByManager($user->getId());
        return $this->render('users/monclub.html.twig', [
            'monclub' => $club,
        ]);
    }


}
