<?php

namespace App\Controller;

use App\Entity\Qualite;
use App\Form\QualiteType;
use App\Repository\QualiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/qualite')]
class AdminQualiteController extends AbstractController
{
    #[Route('/', name: 'app_admin_qualite_index', methods: ['GET'])]
    public function index(QualiteRepository $qualiteRepository): Response
    {
        return $this->render('admin_qualite/index.html.twig', [
            'qualites' => $qualiteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_qualite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $qualite = new Qualite();
        $form = $this->createForm(QualiteType::class, $qualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($qualite);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_qualite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_qualite/new.html.twig', [
            'qualite' => $qualite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_qualite_show', methods: ['GET'])]
    public function show(Qualite $qualite): Response
    {
        return $this->render('admin_qualite/show.html.twig', [
            'qualite' => $qualite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_qualite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Qualite $qualite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(QualiteType::class, $qualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_qualite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_qualite/edit.html.twig', [
            'qualite' => $qualite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_qualite_delete', methods: ['POST'])]
    public function delete(Request $request, Qualite $qualite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$qualite->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($qualite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_qualite_index', [], Response::HTTP_SEE_OTHER);
    }
}
