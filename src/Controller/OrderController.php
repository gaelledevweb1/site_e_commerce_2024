<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\OrderRepository;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/order')]
class OrderController extends AbstractController
{
    #[Route('/', name: 'app_order_index', methods: ['GET'])]
    public function index(OrderRepository $orderRepository): Response
    {
        return $this->render('order/index.html.twig', [
            'orders' => $orderRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_order_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SessionInterface $session,ProductsRepository $productsRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $cart = $session->get('cart', []);
        // dd($cart);
        if (empty($cart)) {
            $this->addFlash('erreur', 'Votre panier est vide !');
            return $this->redirectToRoute('app_products_index');
        }
        //  Le panier n'est pas vide, on peut créer la commande
        $datetime = new \DateTime( 'now');

        $order = new Order();
        $reference = $datetime ->format(format: 'dmY') . '-' . uniqid();

        // on parcourt le panier pour créer les détails de la commande
        
        foreach ($cart as $id => $quantity) {
            $product = $productsRepository->find($id);
            // $order->addProduct($product, $quantity);
        }

        // $form = $this->createForm(OrderType::class, $order);
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $entityManager->persist($order);
        //     $entityManager->flush();

        //     return $this->redirectToRoute('app_order_index', [], Response::HTTP_SEE_OTHER);
        // }

        return $this->render('order/new.html.twig', [
            'order' => $order,
            // 'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_order_show', methods: ['GET'])]
    public function show(Order $order): Response
    {
        return $this->render('order/show.html.twig', [
            'order' => $order,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_order_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Order $order, EntityManagerInterface $entityManager): Response
    {
        // $form = $this->createForm(OrderType::class, $order);
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $entityManager->flush();

        //     return $this->redirectToRoute('app_order_index', [], Response::HTTP_SEE_OTHER);
        // }

        return $this->render('order/edit.html.twig', [
            'order' => $order,
            // 'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_order_delete', methods: ['POST'])]
    public function delete(Request $request, Order $order, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$order->getId(), $request->request->get('_token'))) {
            $entityManager->remove($order);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_order_index', [], Response::HTTP_SEE_OTHER);
    }
}
