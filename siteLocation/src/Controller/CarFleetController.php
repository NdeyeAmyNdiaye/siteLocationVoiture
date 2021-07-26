<?php

namespace App\Controller;

use App\Entity\CarFleet;
use App\Form\CarFleetType;
use App\Repository\CarFleetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/car/fleet")
 */
class CarFleetController extends AbstractController
{
    /**
     * @Route("/", name="car_fleet_index", methods={"GET"})
     */
    public function index(CarFleetRepository $carFleetRepository): Response
    {
        return $this->render('car_fleet/index.html.twig', [
            'car_fleets' => $carFleetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="car_fleet_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $carFleet = new CarFleet();
        $form = $this->createForm(CarFleetType::class, $carFleet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($carFleet);
            $entityManager->flush();

            return $this->redirectToRoute('car_fleet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('car_fleet/new.html.twig', [
            'car_fleet' => $carFleet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="car_fleet_show", methods={"GET"})
     */
    public function show(CarFleet $carFleet): Response
    {
        return $this->render('car_fleet/show.html.twig', [
            'car_fleet' => $carFleet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="car_fleet_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CarFleet $carFleet): Response
    {
        $form = $this->createForm(CarFleetType::class, $carFleet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('car_fleet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('car_fleet/edit.html.twig', [
            'car_fleet' => $carFleet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="car_fleet_delete", methods={"POST"})
     */
    public function delete(Request $request, CarFleet $carFleet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carFleet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($carFleet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('car_fleet_index', [], Response::HTTP_SEE_OTHER);
    }
}
