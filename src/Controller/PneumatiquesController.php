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
     * @Route("/", name=":index", methods={"HEAD","GET"})
     */
    public function index(PneumatiquesRepository $pneumatiquesRepository): Response
    {
        $pneumatique = $pneumatiquesRepository->findAll();
        return $this->render('pneumatiques/index.html.twig', [
            'pneumatique' => $pneumatique,
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
            
            $this->addFlash('success',"le pneumatique ".$pneumatique->getTitle()." a été créé !");
            return $this->redirectToRoute('pneumatiques:index', [
                //'pneumatique' => $pneumatique,
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
            'pneumatique' => $pneumatique,
        ]);
    }

    
            
    /**
     * @Route("/{id}/edit", name=":update", methods={"HEAD","GET","POST"})
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
            return $this->redirectToRoute('pneumatiques:show', [
                'id' => $pneumatique->getId()
            ]);
        }


        // Réponse HTTP
        // --

        // Creation de la vue du formulaire
        $form = $form->createView();

        return $this->render('pneumatiques/update.html.twig', [
            'pneumatique' => $pneumatique,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/delete", name=":delete", methods={"HEAD","GET","DELETE"})
     */
    public function delete(Request $request, Pneumatiques $pneumatique): Response
    {
        // Test de la méthode HTTP / Soumission du formulaire
        // --

        // Test de la méthode HTTP: doit être en "DELETE"
        if($request->getMethod() == 'DELETE'){

            // Récupération du Manager d'Entité (Entity Manager)
            $em = $this->getDoctrine()->getManager();

            // Préparation de la requête de suppression sur l'objet $pneumatique
            // /!\ et on utilise "remove" et non "persist"
            $em->remove( $pneumatique );

            // Exécute la requête
            $em->flush();

            // Redirection de l'utilisateur vers la liste des pneus
            // --

            // Message flash de confirmation de la suppression
            $this->addFlash('success', "Le produit ".$pneumatique->getTitle()." à été supprimé.");

            // Redirection
            return $this->redirectToRoute('pneumatiques:index');
        }

        return $this->render('pneumatiques/delete.html.twig', [
            'pneumatique' => $pneumatique
        ]);
    }
}
