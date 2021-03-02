<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{
    /**
     * @Route("/site", name="site")
     */
    public function index()
    {
        return $this->render('site/index.html.twig');
    }

    public function connexion()
    {
        return $this->render('security/login.html.twig');
    }

    public function inscription()
    {
        return $this->render('registration/register.html.twig');
    }
}
