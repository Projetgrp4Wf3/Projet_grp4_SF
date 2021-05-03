<?php

namespace App\Controller;

use App\Entity\Pneumatiques;
use App\Form\PneumatiquesType;
use App\Repository\PneumatiquesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pneumatiques", name="pneumatiques")
 */
class PneumatiquesController extends AbstractController
{
    /**
     * path('pneumatiques:index')
     * @Route("/", name=":index", methods={"HEAD","GET","POST"})
     */
    public function index(PneumatiquesRepository $pneumatiquesRepository): Response
    {
        return $this->render('pneumatiques/index.html.twig', [
            'pneumatiques' => $pneumatiquesRepository->findAll(),
        ]);

    }

    /**
     * path('pneumatiques:new')
     * @Route("/new", name=":new", methods={"HEAD","GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pneumatique = new Pneumatiques();
        $form = $this->createForm(PneumatiquesType::class, $pneumatique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pneumatique);
            $entityManager->flush();
            
            $this->addFlash('succes',"le pneumatique".$pneumatique->getTitle()."a été créé !");
            return $this->redirectToRoute('pneumatiques:index', [
                'id' => $pneumatique->getId()
            ]);
        }

        $form = $form->createView();
        return $this->render('pneumatiques/new.html.twig', [
            'form' => $form,
            
        ]);
    }

    /**
     * @Route("/{id}", name=":show", methods={"HEAD","GET"})
     */
    public function show(Pneumatiques $pneumatique): Response
    {
        return $this->render('pneumatiques/show.html.twig', [
            'pneumatiques' => $pneumatique,
        ]);
    }

    /**
     * @Route("/{id}/edit", name=":edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pneumatiques $pneumatique): Response
    {
        $form = $this->createForm(PneumatiquesType::class, $pneumatique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pneumatiques/index.html.twig');
        }

        return $this->render('pneumatiques/edit.html.twig', [
            'pneumatiques' => $pneumatique,
            'form' => $form->createView(),
        ]);
    }
            
    /**
     * @Route("/update/{id}", name=":update", methods={"GET","POST"})
     */
    public function update(Pneumatiques $pneumatique, Request $request): Response
    {

        // Creation du formulaire
        $form = $this->createForm(PneumatiquesType::class, $pneumatique);

        // On capte la methode de requête HTTP
        $form->handleRequest( $request );

        // Traitement du formulaire
        // --

        if ($form->isSubmitted() && $form->isValid())
        {
            // Recupération du Manager d'Entité (Entity Manager)
            $em = $this->getDoctrine()->getManager();

            // Preparation de la requete sur l'objet $product modifié par le formulaire
            $em->persist( $pneumatique );

            // Execute la requete
            $em->flush();

            // Redirige l'utilisateur vers la page du produit
            // --

            // Creation du message de validation de la requete
            $this->addFlash('success', "Le pneumatique ".$pneumatique->getTitle()." a été modifié !");


            // Redirection
            return $this->redirectToRoute('pneumatiqu:read', [
                'id' => $pneumatique->getId()
            ]);
        }


        // Reposne HTTP
        // --

        // Creation de la vue du formulaire
        $form = $form->createView();

        return $this->render('pneumatiques/update.html.twig', [
            'product' => $pneumatique,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name=":delete", methods={"POST"})
     */
    public function delete(Request $request, Pneumatiques $pneumatique): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pneumatique->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pneumatique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pneumatiques/index.html');
    }
}
