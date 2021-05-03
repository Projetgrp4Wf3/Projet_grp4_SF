<?php

namespace App\Controller;

use App\Entity\Entretien;
use App\Form\EntretienType;
use App\Repository\EntretienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/entretien", name="entretien")
 */
class EntretienController extends AbstractController
{
    /**
     * path('entretien:index')
     * @Route("/", name=":index", methods={"GET"})
     */
    public function index(EntretienRepository $entretienRepository): Response
    {
        $entretiens = $entretienRepository->findAll();
        return $this->render('entretien:index.html.twig', [
            'entretiens' => $entretiens
        ]);
    }

    /**
     * path('entretien:new')
     * @Route("/new", name=":new", methods={"HEAD","GET","POST"})
     */
    public function new(Request $request): Response
    {
        $entretien = new Entretien();
        $form = $this->createForm(EntretienType::class, $entretien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entretien);
            $entityManager->flush();

            $this->addFlash('success', "L'entretien ".$entretien->getTitle()." a été créé !");

            return $this->redirectToRoute('entretien:index', [
                'id' => $entretien->getId()
            ]);
        }

        $form = $form->createView();
        return $this->render('entretien/new.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name=":show", methods={"HEAD","GET"})
     */
    public function show(Entretien $entretien): Response
    {
        return $this->render('entretien/show.html.twig', [
            'entretien' => $entretien,
        ]);
    }

    
    /**
     * @Route("/{id}/edit", name=":edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Entretien $entretien): Response
    {
        $form = $this->createForm(EntretienType::class, $entretien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('entretien/index.html.twig');
        }

        return $this->render('entretien/edit.html.twig', [
            'entretien' => $entretien,
            'form' => $form->createView(),
        ]);
    }

        
    /**
     * @Route("/{id}", name=":update", methods={"GET","POST"})
     */
    public function update(Entretien $entretien, Request $request): Response
    {
        // Creation du formulaire
        $form = $this->createForm(EntretienType::class, $entretien);

        // On capte la methode de requête HTTP
        $form->handleRequest( $request );

        // Traitement du formulaire
        if ($form->isSubmitted() && $form->isValid())
        {
            // Recupération du Manager d'Entité (Entity Manager)
            $em = $this->getDoctrine()->getManager();
// Preparation de la requete sur l'objet $product modifié par le formulaire
            $em->persist( $entretien );

            // Execute la requete
            $em->flush();

            // Redirige l'utilisateur vers la page du produit
            // Creation du message de validation de la requete
            $this->addFlash('success', "L'entretien ".$entretien->getTitle()." a été modifié !");

            // Redirection
            return $this->redirectToRoute('entretien:read', [
                'id' => $entretien->getId()
            ]);
        }
        
        // Reposne HTTP
        // --

        // Creation de la vue du formulaire
        $form = $form->createView();

        return $this->render('entretien/update.html.twig', [
            'product' => $entretien,
            'form' => $form,
        ]);
    }




    /**
     * @Route("/{id}", name=":delete", methods={"POST"})
     */
    public function delete(Request $request, Entretien $entretien): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entretien->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($entretien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('entretien/index.html.twig');
    }
}
