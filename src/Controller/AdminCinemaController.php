<?php

namespace App\Controller;

use App\Entity\Cinema;
use App\Form\CinemaType;
use App\Repository\CinemaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/cinema')]
class AdminCinemaController extends AbstractController
{
    #[Route('/', name: 'app_admin_cinema_index', methods: ['GET'])]
    public function index(CinemaRepository $cinemaRepository): Response
    {
        return $this->render('admin_cinema/index.html.twig', [
            'cinemas' => $cinemaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_cinema_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cinema = new Cinema();
        $form = $this->createForm(CinemaType::class, $cinema);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cinema);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_cinema_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_cinema/new.html.twig', [
            'cinema' => $cinema,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_cinema_show', methods: ['GET'])]
    public function show(Cinema $cinema): Response
    {
        return $this->render('admin_cinema/show.html.twig', [
            'cinema' => $cinema,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_cinema_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cinema $cinema, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CinemaType::class, $cinema);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_cinema_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_cinema/edit.html.twig', [
            'cinema' => $cinema,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_cinema_delete', methods: ['POST'])]
    public function delete(Request $request, Cinema $cinema, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cinema->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($cinema);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_cinema_index', [], Response::HTTP_SEE_OTHER);
    }
}
