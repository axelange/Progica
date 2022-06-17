<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'controller_name' => 'HomeController',
            "title" => "Bienvenue sur Gîtehub",
            "description" => "Gîtehub est un site de location de gîtes pour les vacances de famille et d'amis.",
            "keywords" => "gîte, location, vacances, famille, amis, gîtehub, location de gîtes, location de gîtes pour vacances, location de gîtes pour vacances de famille, location de gîtes pour vacances de amis",
            "menu" => "home",
        ]);
    }
}
