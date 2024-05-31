<?php

namespace App\Controller;


use App\Entity\Order;
use App\Entity\RecapDetails;
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



    #[Route('/create', name: 'app_order_index', methods: ['GET'])]
    public function index(OrderRepository $orderRepository, SessionInterface $session, ProductsRepository $productsRepository): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $orders =  $orderRepository->findAll();
        // dump($orders);
        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()
        ]);
        $cart = $session->get('cart', []);
        $total = 0;
        $data = [];
        $products = [];

        foreach ($cart as $id => $quantity) {
            $product = $productsRepository->find($id);
            if (!$product) {
                continue;
            }
            $total += $product->getSellPriceHT() * $quantity;
            $data[] = [
                'product' => $product,
                'quantity' => $quantity
            ];
            $products[] = $product;
        }

        // dd($total);

        return $this->render('order/index.html.twig', [
            'orders' => $orders,
            'form' => $form->createView(),
            'recapCart' => [
                'products' => $products,
                'data' => $data,
                'total' => $total
            ]
        ]);
    }

    #[Route('/verify', name: 'app_order_new', methods: ['GET', 'POST'])]
    public function prepareOrder(Request $request, EntityManagerInterface $entityManager, ProductsRepository $productsRepository, SessionInterface $session): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()
        ]);
        
        $cart = $session->get('cart', []);
        //   dd($cart);
        if (empty($cart)) {
            $this->addFlash('erreur', 'Votre panier est vide !');
            return $this->redirectToRoute('app_products_index');
        }
        //  Le panier n'est pas vide, on peut créer la commande
        
        $datetime = new \DateTime('now');

        $order = new Order();
        $order->setUser($this->getUser());
        $order->setOrderDate($datetime);
        $order->setPaid(false);
        $order->setStatus('En attente de paiement');
        $order->setDelivered(false);
        $order->setDeliveryDate($datetime);
        $order->setDeliveryInfo('En attente de livraison');

        $order->setReference($datetime->format(format: 'dmY') . '-' . uniqid());

        // on parcourt le panier pour créer les détails de la commande

        foreach ($cart as $id => $quantity) {
            $product = $productsRepository->find($id);
            //    dd($product);
        }

        // on verifie si le produit existe en bdd ( stock)
        if (!$product) {
            $this->addFlash('erreur', 'Produit non disponible actuellement !');
            return $this->redirectToRoute('app_products_index');
        } else {
            //  on continue la création de la commande
            //   je recupere, le produit son prix et sa quantité

            // Récupérer les données de la session ( quantité et id du produit) 
            $cart = $session->get('cart', []);

            //  dd($cart);


            // recuperer les données du produits
            foreach ($cart as $id => $quantity) {
                $product = $productsRepository->find($id);
                //  dd($product);
                if ($product) {
                    $recapDetails = new RecapDetails();
                    $recapDetails->setorderProduct($order);

                    $recapDetails->setQuantity($quantity);
                    $recapDetails->setPrice($product->getSellPriceHT());
                    $recapDetails->setProduct($product->getArticleName());
                    $recapDetails->setTotalRecap($product->getSellPriceHT() * $quantity);
                }
                    // dd($recapDetails);
                $entityManager->persist($recapDetails);
            }
            $entityManager->flush();


            // Utiliser les données de la session...



            return $this->redirectToRoute('app_order_index', [
                'order' => $order,

            ]);
        }
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

        return $this->render('order/index.html.twig', [
            'order' => $order,

        ]);
    }

    #[Route('/{id}', name: 'app_order_delete', methods: ['POST'])]
    public function delete(Request $request, Order $order, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $order->getId(), $request->request->get('_token'))) {
            $entityManager->remove($order);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_order_index', [], Response::HTTP_SEE_OTHER);
    }
}
