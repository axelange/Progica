<?php

namespace App\Controller;

use App\Entity\Gite;
use App\Form\GiteType;
use App\Repository\GiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gite")
 */
class GiteController extends AbstractController
{
    /*
    * @Route("/les-gites", name="gites_index")
    */
    public function index(GiteRepository $giteRepository): Response
    {
        $gites = $giteRepository->findAll();

        return $this->render('gite/index.html.twig', [
            'gites' => $gites,
        ]);
    }

    /**
     * @Route("/{id}", name="gite_show", methods={"GET"})
     */
    public function show(Gite $gite): Response
    {
        return $this->render('gite/show.html.twig', [
            'gite' => $gite,
        ]);
    }
}
