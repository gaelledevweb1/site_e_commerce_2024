<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Form\Inscription1Type;
use App\Repository\InscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/inscription/cours/gymnastique/senior')]
class InscriptionCoursGymnastiqueSeniorController extends AbstractController
{
    #[Route('/', name: 'app_inscription_cours_gymnastique_senior_index', methods: ['GET'])]
    public function index(InscriptionRepository $inscriptionRepository): Response
    {
        return $this->render('inscription_cours_gymnastique_senior/index.html.twig', [
            'inscriptions' => $inscriptionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_inscription_cours_gymnastique_senior_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $inscription = new Inscription();
        $form = $this->createForm(Inscription1Type::class, $inscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($inscription);
            $entityManager->flush();

            return $this->redirectToRoute('app_inscription_cours_gymnastique_senior_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('inscription_cours_gymnastique_senior/new.html.twig', [
            'inscription' => $inscription,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_inscription_cours_gymnastique_senior_show', methods: ['GET'])]
    public function show(Inscription $inscription): Response
    {
        return $this->render('inscription_cours_gymnastique_senior/show.html.twig', [
            'inscription' => $inscription,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_inscription_cours_gymnastique_senior_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Inscription $inscription, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Inscription1Type::class, $inscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_inscription_cours_gymnastique_senior_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('inscription_cours_gymnastique_senior/edit.html.twig', [
            'inscription' => $inscription,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_inscription_cours_gymnastique_senior_delete', methods: ['POST'])]
    public function delete(Request $request, Inscription $inscription, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inscription->getId(), $request->request->get('_token'))) {
            $entityManager->remove($inscription);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_inscription_cours_gymnastique_senior_index', [], Response::HTTP_SEE_OTHER);
    }
}
