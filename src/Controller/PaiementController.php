<?php

namespace App\Controller;

use App\Entity\Paiement;
use App\Form\PaiementType;
use App\Repository\OrderRepository;
use App\Repository\PaiementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[Route('/paiement')]
class PaiementController extends AbstractController
{
    #[Route('/', name: 'app_paiement_index', methods: ['GET'])]
    public function index(OrderRepository $orderRepository,UrlGeneratorInterface $generator): Response
    {
        $user = $this->getUser();
        $order =   $orderRepository->findOneBy(['user' => $user], ['id' => 'DESC']);
        // dd($order);
        $articleInfo = [];
        foreach ($order->getRecapDetails()->toArray()  as $item) {
            // dump( $item  );die;
            $articleInfo[] = [

                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $item->getPrice() * 100,

                    'product_data' => [
                        'name' => $item->getProduct(),

                    ],
                ],
                'quantity' => $item->getQuantity(),
            ];
        }

        $stripe = $_ENV['STRIPE_SECRETE_KEY'];
        
        Stripe::setApiKey($stripe);
        header('Content-Type: application/json');

        $checkout_session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                $articleInfo
            ],
            'mode' => 'payment',
            'success_url' =>  $generator->generate('payment_success', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' =>  $generator->generate('payment_cancel', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'automatic_tax' => [
                'enabled' => true,
            ],
        ]);

        return new  RedirectResponse($checkout_session->url);
    }

    #[Route('/success', name: 'payment_success')]
    public function paymentSuccess(): Response
    {
        return $this->render('paiement/success.html.twig');
    }

    #[Route('/cancel', name: 'payment_cancel')]
    public function paymentCancel(): Response
    {
        return $this->render('paiement/cancel.html.twig');
    }



    #[Route('/new', name: 'app_paiement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $paiement = new Paiement();
        // $form = $this->createForm(PaiementType::class, $paiement);
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $entityManager->persist($paiement);
        //     $entityManager->flush();

        //     return $this->redirectToRoute('app_paiement_index', [], Response::HTTP_SEE_OTHER);
        // }

        return $this->render('paiement/new.html.twig', [
            'paiement' => $paiement,
            // 'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_paiement_show', methods: ['GET'])]
    public function show(Paiement $paiement): Response
    {
        return $this->render('paiement/show.html.twig', [
            'paiement' => $paiement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_paiement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Paiement $paiement, EntityManagerInterface $entityManager): Response
    {
        // $form = $this->createForm(PaiementType::class, $paiement);
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $entityManager->flush();

        //     return $this->redirectToRoute('app_paiement_index', [], Response::HTTP_SEE_OTHER);
        // }

        return $this->render('paiement/edit.html.twig', [
            'paiement' => $paiement,
            // 'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_paiement_delete', methods: ['POST'])]
    public function delete(Request $request, Paiement $paiement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $paiement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($paiement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_paiement_index', [], Response::HTTP_SEE_OTHER);
    }
}
