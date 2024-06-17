<?php

namespace App\Controller;

use App\Entity\Adress;
use App\Form\AdressType;
use App\Repository\AdressRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Controller for managing addresses.
 */
#[Route('/adress')]
class AdressController extends AbstractController
{
    /**
     * Displays a list of all addresses.
     *
     * @param AdressRepository $adressRepository The address repository.
     * @return Response The response object.
     */
    #[Route('/', name: 'app_adress_index', methods: ['GET'])]
    public function index(AdressRepository $adressRepository): Response
    {
        return $this->render('adress/index.html.twig', [
            'adresses' => $adressRepository->findAll(),
        ]);
    }

    /**
     * Creates a new address.
     *
     * @param Request $request The request object.
     * @param EntityManagerInterface $entityManager The entity manager.
     * @return Response The response object.
     */
    #[Route('/new', name: 'app_adress_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $adress = new Adress();
        $form = $this->createForm(AdressType::class, $adress);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adress->setUser($this->getUser()); // Set the user before persisting the address
            $entityManager->persist($adress);
            $entityManager->flush();

            return $this->redirectToRoute('app_adress_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adress/new.html.twig', [
            'adress' => $adress,
            'form' => $form,
        ]);
    }

    /**
     * Displays the details of an address.
     *
     * @param Adress $adress The address object.
     * @param Adress $adressDelivery The delivery address object.
     * @param Security $security The security service.
     * @return Response The response object.
     */
    #[Route('/{id}', name: 'app_adress_show', methods: ['GET'])]
    public function show(Adress $adress, Adress $adressDelivery, Security $security): Response
    {
        $user = $security->getUser(); // Get the currently logged-in user

        if ($adress->getUser() !== $user) {
            // If the user associated with the address is not the currently logged-in user,
            // throw a 403 Forbidden error
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à accéder à cette adresse.');
        }

        if ($adressDelivery->getUser() !== $user) {
            // If the user associated with the delivery address is not the currently logged-in user,
            // throw a 403 Forbidden error
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à accéder à cette adresse de livraison.');
        }

        return $this->render('adress/show.html.twig', [
            'adress' => $adress,
            'adressDelivery' => $adressDelivery,
        ]);
    }

    /**
     * Edits an existing address.
     *
     * @param Request $request The request object.
     * @param Adress $adress The address object.
     * @param EntityManagerInterface $entityManager The entity manager.
     * @return Response The response object.
     */
    /**
     * Edit an address.
     *
     * @param Request                $request        The request object.
     * @param Adress                 $adress         The address to edit.
     * @param EntityManagerInterface $entityManager The entity manager.
     *
     * @return Response The response object.
     *
     * @Route('/{id}/edit', name: 'app_adress_edit', methods: ['GET', 'POST'])
     */
    public function edit(Request $request, Adress $adress, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdressType::class, $adress);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_adress_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adress/edit.html.twig', [
            'adress' => $adress,
            'form' => $form,
        ]);
    }

    /**
     * Delete an address.
     *
     * @param Request                $request        The request object.
     * @param Adress                 $adress         The address to delete.
     * @param EntityManagerInterface $entityManager The entity manager.
     *
     * @return Response The response object.
     *
     * @Route('/{id}', name: 'app_adress_delete', methods: ['POST'])
     */
    public function delete(Request $request, Adress $adress, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adress->getId(), $request->request->get('_token'))) {
            $entityManager->remove($adress);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_adress_index', [], Response::HTTP_SEE_OTHER);
    }
}
