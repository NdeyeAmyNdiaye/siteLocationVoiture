<?php

namespace App\Controller;

use App\Entity\Seats;
use App\Form\SeatsType;
use App\Repository\SeatsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/seats")
 */
class SeatsController extends AbstractController
{
    /**
     * @Route("/", name="seats_index", methods={"GET"})
     */
    public function index(SeatsRepository $seatsRepository): Response
    {
        return $this->render('seats/index.html.twig', [
            'seats' => $seatsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="seats_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $seat = new Seats();
        $form = $this->createForm(SeatsType::class, $seat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($seat);
            $entityManager->flush();

            return $this->redirectToRoute('seats_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('seats/new.html.twig', [
            'seat' => $seat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="seats_show", methods={"GET"})
     */
    public function show(Seats $seat): Response
    {
        return $this->render('seats/show.html.twig', [
            'seat' => $seat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="seats_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Seats $seat): Response
    {
        $form = $this->createForm(SeatsType::class, $seat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seats_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('seats/edit.html.twig', [
            'seat' => $seat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="seats_delete", methods={"POST"})
     */
    public function delete(Request $request, Seats $seat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($seat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('seats_index', [], Response::HTTP_SEE_OTHER);
    }
}
