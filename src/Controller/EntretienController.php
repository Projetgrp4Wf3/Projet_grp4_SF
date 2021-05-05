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
     * @Route("/", name=":index", methods={"HEAD","GET"})
     */
    public function index(EntretienRepository $entretienRepository): Response
    {
        $entretiens = $entretienRepository->findAll();
        return $this->render('entretien/index.html.twig', [
            'entretiens' => $entretiens
        ]);
    }

    /**
     * path('entretien:new')
     * @Route("/new", name=":new", methods={"HEAD","GET","POST"})
     */
    public function new(Request $request): Response
    {
        $entretiens = new Entretien();
        $form = $this->createForm(EntretienType::class, $entretiens);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entretiens);
            $entityManager->flush();

            $this->addFlash('success', "L'entretien ".$entretiens->getTitle()." a été créé !");

            return $this->redirectToRoute('entretien:index', [
                'id' => $entretiens->getId()
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
    public function show(Entretien $entretiens): Response
    {
        return $this->render('entretien/show.html.twig', [
            'entretien' => $entretiens,
        ]);
    }

        
    /**
     * @Route("/{id}/edit", name=":update", methods={"HEAD","GET","POST"})
     */
    public function update(Entretien $entretiens, Request $request): Response
    {
        // Creation du formulaire
        $form = $this->createForm(EntretienType::class, $entretiens);

        // On capte la methode de requête HTTP
        $form->handleRequest( $request );

        // Traitement du formulaire
        if ($form->isSubmitted() && $form->isValid())
        {
            // Recupération du Manager d'Entité (Entity Manager)
            $em = $this->getDoctrine()->getManager();
            // Preparation de la requete sur l'objet $product modifié par le formulaire
            $em->persist( $entretiens );

            // Execute la requete
            $em->flush();

            // Redirige l'utilisateur vers la page du produit
            // Creation du message de validation de la requete
            $this->addFlash('success', "L'entretien ".$entretiens->getTitle()." a été modifié !");

            // Redirection
            return $this->redirectToRoute('entretien:show', [
                'id' => $entretiens->getId()
            ]);
        }
        
        // Réponse HTTP
        // --

        // Creation de la vue du formulaire
        $form = $form->createView();

        return $this->render('entretien/update.html.twig', [
            'entretiens' => $entretiens,
            'form' => $form,
        ]);
    }




    /**
     * @Route("/{id}/delete", name=":delete", methods={"HEAD","GET","DELETE"})
     */
    public function delete(Entretien $entretien, Request $request): Response
    {
        // Test de la méthode HTTP / Soumission du formulaire
        // --

        // Test de la méthode HTTP: doit être en "DELETE"
        if($request->getMethod() == 'DELETE'){

            // Récupération du Manager d'Entité (Entity Manager)
            $em = $this->getDoctrine()->getManager();

            // Préparation de la requête de suppression sur l'objet $entretien
            // /!\ et on utilise "remove" et non "persist"
            $em->remove( $entretien );

            // Exécute la requête
            $em->flush();

            // Redirection de l'utilisateur vers la liste des produits
            // --

            // Message flash de confirmation de la suppression
            $this->addFlash('success', "Le produit ".$entretien->getTitle()." à été supprimé.");

            // Redirection
            return $this->redirectToRoute('entretien:index');
        }

        return $this->render('entretien/delete.html.twig', [
            'entretien' => $entretien
        ]);
    }
}
