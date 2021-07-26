<?php

namespace App\Controller;

use App\Entity\Engines;
use App\Form\EnginesType;
use App\Repository\EnginesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/engines")
 */
class EnginesController extends AbstractController
{
    /**
     * @Route("/", name="engines_index", methods={"GET"})
     */
    public function index(EnginesRepository $enginesRepository): Response
    {
        return $this->render('engines/index.html.twig', [
            'engines' => $enginesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="engines_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $engine = new Engines();
        $form = $this->createForm(EnginesType::class, $engine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($engine);
            $entityManager->flush();

            return $this->redirectToRoute('engines_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('engines/new.html.twig', [
            'engine' => $engine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="engines_show", methods={"GET"})
     */
    public function show(Engines $engine): Response
    {
        return $this->render('engines/show.html.twig', [
            'engine' => $engine,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="engines_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Engines $engine): Response
    {
        $form = $this->createForm(EnginesType::class, $engine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('engines_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('engines/edit.html.twig', [
            'engine' => $engine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="engines_delete", methods={"POST"})
     */
    public function delete(Request $request, Engines $engine): Response
    {
        if ($this->isCsrfTokenValid('delete'.$engine->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($engine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('engines_index', [], Response::HTTP_SEE_OTHER);
    }
}
