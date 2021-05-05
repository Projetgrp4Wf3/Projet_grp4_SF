<?php

namespace App\Controller;

use App\Entity\Devi;
use App\Form\DeviType;
use App\Repository\DeviRepository;
use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/devi")
 */
class DeviController extends AbstractController
{
    /**
     * @Route("/", name="devi_index", methods={"GET"})
     */
    public function index(DeviRepository $deviRepository): Response
    {
        return $this->render('devi/index.html.twig', [
            'devis' => $deviRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="devi_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $devi = new Devi();
        $form = $this->createForm(DeviType::class, $devi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($devi);
            // $entityManager->flush();

            // return $this->redirectToRoute('devi_index');

            $dompdf = new Dompdf();
            $form = $form->createView();

            $html = $this->renderView('devi/mypdf.html.twig', [
                'form' => $form
            ]);

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');

            $dompdf->render();

            return $dompdf->stream("devis.pdf", [
            "Attachment" => false
                
            ]);
        }

        return $this->render('devi/new.html.twig', [
            'devi' => $devi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="devi_show", methods={"GET"})
     */
    public function show(Devi $devi): Response
    {
        return $this->render('devi/show.html.twig', [
            'devi' => $devi,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="devi_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Devi $devi): Response
    {
        $form = $this->createForm(DeviType::class, $devi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('devi_index');
        }

        return $this->render('devi/edit.html.twig', [
            'devi' => $devi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="devi_delete", methods={"POST"})
     */
    public function delete(Request $request, Devi $devi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$devi->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($devi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('devi_index');
    }
}
