<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller for managing user-related actions.
 */
#[Route('/user')]
class UserController extends AbstractController
{
    /**
     * Displays a list of users.
     *
     * @param UserRepository $userRepository The user repository.
     * @return Response The response object.
     */
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            // $user_id = 11,
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * Creates a new user.
     *
     * @param Request $request The request object.
     * @param EntityManagerInterface $entityManager The entity manager.
     * @return Response The response object.
     */
    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {

        // Récupérez l'adresse de livraison associée à l'utilisateur
    // $adressDelivery = $user->getOrder()->getAdressDelivery();

    // // Générez l'URL pour le formulaire de l'adresse de livraison
    // $adressDeliveryFormUrl = $this->generateUrl('app_adress_delivery_edit', ['id' => $adressDelivery->getId()]);
        
        foreach ( $user->getAdress()as $adress) {
            ($adress->getCountry());
           }
           
           $adressFields = ['number','street', 'City', 'Zip', 'Country'];
          return $this->render('user/show.html.twig', [
              'user' => $user,
               'userAdress' => $user->getAdress(),
               'adressFields' =>$adressFields,
               
            //    'adressDeliveryFormUrl' => $adressDeliveryFormUrl,
            
                

               
          ]);
        
    }

    /**
     * Edit a user.
     *
     * @param Request                $request         The request object.
     * @param User                   $user            The user object to edit.
     * @param EntityManagerInterface $entityManager  The entity manager.
     *
     * @return Response The response object.
     *
     * @Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])
     */
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * Delete a user.
     *
     * @param Request                $request         The request object.
     * @param User                   $user            The user object to delete.
     * @param EntityManagerInterface $entityManager  The entity manager.
     *
     * @return Response The response object.
     *
     * @Route('/{id}', name: 'app_user_delete', methods: ['POST'])
     */
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
