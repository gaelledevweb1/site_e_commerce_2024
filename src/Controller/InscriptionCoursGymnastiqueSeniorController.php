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

/**
 * Controller for handling the inscription to gymnastics senior courses.
 */
#[Route('/inscription/cours/gymnastique/senior')]
class InscriptionCoursGymnastiqueSeniorController extends AbstractController
{
    /**
     * Displays the index page for the gymnastics senior course inscriptions.
     *
     * @param InscriptionRepository $inscriptionRepository The repository for retrieving inscriptions.
     * @return Response The response containing the rendered index page.
     */
    #[Route('/', name: 'app_inscription_cours_gymnastique_senior_index', methods: ['GET'])]
    public function index(InscriptionRepository $inscriptionRepository): Response
    {
        return $this->render('inscription_cours_gymnastique_senior/index.html.twig', [
            'inscriptions' => $inscriptionRepository->findAll(),
        ]);
    }

    /**
     * Handles the creation of a new inscription for the gymnastics senior course.
     *
     * @param Request $request The request object.
     * @param EntityManagerInterface $entityManager The entity manager for persisting the inscription.
     * @return Response The response containing the rendered new inscription page or a redirect.
     */
    #[Route('/new', name: 'app_inscription_cours_gymnastique_senior_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        $inscription = new Inscription();
        $form = $this->createForm(Inscription1Type::class, $inscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inscription->setUser($user);
            $inscription->setCreatedAT(new \DateTime());
            $inscription->setUpdateAt(new \DateTime());

            $entityManager->persist($inscription);
            $entityManager->flush();
            dd($form->getData(),$user, $inscription);

            return $this->redirectToRoute('app_inscription_cours_gymnastique_senior_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('inscription_cours_gymnastique_senior/new.html.twig', [
            'inscription' => $inscription,
            'form' => $form,
        ]);
    }

    /**
     * Displays the details of a specific inscription for the gymnastics senior course.
     *
     * @param Inscription $inscription The inscription object.
     * @return Response The response containing the rendered show page.
     */
    #[Route('/{id}', name: 'app_inscription_cours_gymnastique_senior_show', methods: ['GET'])]
    public function show(Inscription $inscription): Response
    {
        return $this->render('inscription_cours_gymnastique_senior/show.html.twig', [
            'inscription' => $inscription,
        ]);
    }

    /**
     * Handles the editing of a specific inscription for the gymnastics senior course.
     *
     * @param Request $request The request object.
     * @param Inscription $inscription The inscription object.
     * @param EntityManagerInterface $entityManager The entity manager for persisting the changes.
     * @return Response The response containing the rendered edit page or a redirect.
     */
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

    /**
     * Handles the deletion of a specific inscription for the gymnastics senior course.
     *
     * @param Request $request The request object.
     * @param Inscription $inscription The inscription object.
     * @param EntityManagerInterface $entityManager The entity manager for removing the inscription.
     * @return Response The response containing a redirect.
     */
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
