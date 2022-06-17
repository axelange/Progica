<?php

namespace App\Controller\Admin;

use App\Entity\Gite;
use App\Form\GiteType;
use App\Repository\GiteRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_index")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $gites = $doctrine->getRepository(Gite::class)->findAll();
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'title' => "Panel d'administration Gîtehub",
            'description' => "Gîtehub est un site de location de gîtes pour les vacances de famille et d'amis.",
            'keywords' => "gîte, location, vacances, famille, amis, gîtehub, location de gîtes, location de gîtes pour vacances, location de gîtes pour vacances de famille, location de gîtes pour vacances de amis",
            'menu' => "admin",
            'gites' => $gites,
            
        ]);
    }

    /**
     * @Route("/admin/gites", name="admin_gites")
     */
    public function overview(ManagerRegistry $doctrine): Response
    {
        $gites = $doctrine->getRepository(Gite::class)->findAll();

        return $this->render('admin/gites.html.twig', [
            'controller_name' => 'AdminController',
            'title' => "Modifier les gîtes",
            'description' => "Gîtehub est un site de location de gîtes pour les vacances de famille et d'amis.",
            'keywords' => "gîte, location, vacances, famille, amis, gîtehub, location de gîtes, location de gîtes pour vacances, location de gîtes pour vacances de famille, location de gîtes pour vacances de amis",
            'menu' => "modifier_gites",
            'gites' => $gites,
        ]);
    }


    /**
     * @Route("/admin/gites/new", name="admin_gites_new")
     */
    public function new(Request $request, GiteRepository $giteRepository, ManagerRegistry $doctrine): Response
    {
        $gite = new Gite();
        $form = $this->createForm(GiteType::class, $gite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $giteRepository->add($gite, true);

            $em = $doctrine->getManager();
            $em->persist($gite);
            $em->flush();
            $this->addFlash('success', 'Le gîte a bien été ajouté.');
            return $this->redirectToRoute('admin_gites', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/gites/new.html.twig', [
            'gite' => $gite,
            'formGite' => $form->createview(),
        ]);
    }

    /**
     * @Route("gites/{id}", name="admin_gites_show", methods={"GET"})
     */
    public function show(Gite $gite): Response
    {
         $gite = $doctrine->getRepository(Gite::class)->find($id);
        return $this->render('admin/gites/show.html.twig', [
            'gite' => $gite,
        ]);
    }

    /**
     * @Route("admin/gites/{id}/edit", name="admin_gites_edit")
     */
    public function edit(Request $request, Gite $gite, GiteRepository $giteRepository): Response
    {
        $form = $this->createForm(GiteType::class, $gite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $giteRepository->add($gite, true);
            $this->addFlash('success', 'Le gîte a bien été modifié');
            return $this->redirectToRoute('admin_gites', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/gites/edit.html.twig', [
            'gite' => $gite,
            'formGite' => $form->createView(),
        ]);
    }

    /**
     * @Route("admin/gites/{id}", name="admin_gites_delete")
     */
    public function delete(Request $request, Gite $gite, GiteRepository $giteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gite->getId(), $request->request->get('token'))) {
            $giteRepository->remove($gite, true);

            $em = $doctrine->getManager();
            $em->remove($gite);
            $em->flush();
            $this->addFlash('success', 'Le gîte a bien été supprimé.');
        } else {
            $this->addFlash('error', 'Token non valide.');
        }

        return $this->redirectToRoute('admin_gites', [], Response::HTTP_SEE_OTHER);
    }
}
