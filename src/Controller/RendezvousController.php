<?php

namespace App\Controller;

use App\Entity\Rendezvous;
use App\Form\RendezvousType;
use App\Repository\RendezvousRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
*@Route("/rendezvous", name="rendezvous")
*/


class RendezvousController extends AbstractController
{
    /**
     * @Route("/", name=":index", methods={"GET"})
     */
    public function index(RendezvousRepository $rendezvousRepository): Response
    {
        return $this->render('rendezvous/index.html.twig', [
            'rendezvous' => $rendezvousRepository->findAll(),
        ]);
    }
    //create
    /**
     * @Route("/new", name=":new", methods={"GET","POST"})
     */

    public function new(Request $request): Response
    {
        $rendezvous = new Rendezvous();
        $form = $this->createForm(RendezvousType::class, $rendezvous);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rendezvous);
            $em->flush();
            $this->addFlash('success', "Votre demande a bien été prise en compte");
        }

        return $this->render('rendezvous/index.html.twig', [
            'rendezvous' => $rendezvous,
            'form' => $form->createView()
        ]);
    }
    public function show(Rendezvous $rendezvous): Response
    {
        return $this->render('rendezvous/index.html.twig', [
            'rendezvous' => $rendezvous,
        ]);
    }
    
    


}

/** */
