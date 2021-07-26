<?php

namespace App\Controller;

use App\Entity\Gears;
use App\Form\GearsType;
use App\Repository\GearsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gears")
 */
class GearsController extends AbstractController
{
    /**
     * @Route("/", name="gears_index", methods={"GET"})
     */
    public function index(GearsRepository $gearsRepository): Response
    {
        return $this->render('gears/index.html.twig', [
            'gears' => $gearsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="gears_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $gear = new Gears();
        $form = $this->createForm(GearsType::class, $gear);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gear);
            $entityManager->flush();

            return $this->redirectToRoute('gears_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gears/new.html.twig', [
            'gear' => $gear,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gears_show", methods={"GET"})
     */
    public function show(Gears $gear): Response
    {
        return $this->render('gears/show.html.twig', [
            'gear' => $gear,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="gears_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Gears $gear): Response
    {
        $form = $this->createForm(GearsType::class, $gear);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gears_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gears/edit.html.twig', [
            'gear' => $gear,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gears_delete", methods={"POST"})
     */
    public function delete(Request $request, Gears $gear): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gear->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gear);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gears_index', [], Response::HTTP_SEE_OTHER);
    }
}
