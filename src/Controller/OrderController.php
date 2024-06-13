<?php

namespace App\Controller;

use App\Service\VerificationCommandeService;
use App\Entity\Order;
use App\Entity\RecapDetails;
use App\Form\OrderType;
use App\Repository\AdressRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/order')]
class OrderController extends AbstractController
{

    private $entityManager;
    private $verificationCommandeService;

    public function __construct(EntityManagerInterface $entityManager, VerificationCommandeService $verificationCommandeService)
    {

        $this->verificationCommandeService = $verificationCommandeService;
        $this->entityManager = $entityManager;
    }




    #[Route('/create', name: 'app_order_index', methods: ['GET', 'POST'])]
    public function index(OrderRepository $orderRepository, SessionInterface $session, ProductsRepository $productsRepository, Request $request, AdressRepository $adressRepo): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $orders =  $orderRepository->findAll();
        //  dump($orders);
        // $form = $this->createForm(OrderType::class, null, [
        //     'user' => $this->getUser()
        // ]);

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

        // $form->handleRequest($request);

        // $adress = $form->get('adress')->getData();
        // $adressDelivery = $form->get('adressDelivery')->getData();

        $user = $this->getUser();
        $adressDelivery = $adressRepo->findOneBy(['user' => $user], ['id' => 'DESC']);
        // $transporter = $form->get('transporter')->getData();    
        // dd($transporter);
        $session = $request->getSession();
        // $session->set('adress', $adress);
        $session->set('adressDelivery', $adressDelivery);
        // $session->set('transporter', $transporter);
        //    dd($cart, $session);

        //    dd($total);



        return $this->render('order/index.html.twig', [
            'orders' => $orders,
            // 'form' => $form->createView(),
            // 'adress' => $adress,
            'adressDelivery' => $adressDelivery,
            // 'transporter' => $transporter,
            'recapCart' => [
                'products' => $products,
                'data' => $data,
                'total' => $total
            ]
        ]);
    }




    #[Route('/verify', name: 'app_order_new', methods: ['GET', 'POST'])]
    public function prepareOrder(Request $request,  ProductsRepository $productsRepository, SessionInterface $session, RequestStack $requestStack): Response
    {

        // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        // $form = $this->createForm(OrderType::class, null, [
        //     'user' => $this->getUser()
        // ]);


        // $form->handleRequest($request);
        //    dump($request->request->all(),$form->getData());

        //    if ($form->isSubmitted() && $form->isValid()) {

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

        // dump($cart);

        //    dd($cart);
        if (empty($cart)) {
            $this->addFlash('erreur', 'Votre panier est vide !');
            return $this->redirectToRoute('app_products_index');
        }
        //  Le panier n'est pas vide, on peut créer la commande

        $datetime = new \DateTime('now');

        $session = $request->getSession();

        $adressDelivery = $session->get('adressDelivery');

        // $transporter = $session->get('transporter');

        $user = $this->getUser();

        // dump($user);

        // $adressDelivery->getLastName();
        // $adressDelivery->getPhone();
        //  $adressDelivery->getNumber();
        //  $adressDelivery->getStreet();
        //  $adressDelivery->getZip();
        //  $adressDelivery->getCity();
        //  $adressDelivery->getCountry();

        $adressdelivery = $this->verificationCommandeService->prepareOrder($user, $adressDelivery);



        $order = $this->verificationCommandeService->createOrder($this->getUser(), $adressdelivery, $datetime);

        // Use the createRecapDetails function from the service
        $this->verificationCommandeService->createRecapDetails($order);


        // $order = new Order();
        // $order->setUser($this->getUser());
        // $order->setOrderDate($datetime);
        // $order->setPaid(false);
        // $order->setStatus('En attente de paiement');
        // $order->setDelivered(false);
        // $order->setDeliveryDate($datetime);
        // $order->setDeliveryInfo('En attente de livraison');
        // $order->setReference($datetime->format(format: 'dmY') . '-' . uniqid());

        // // dump($order);

        // $order->setTransporterName($transporter->getTitle());
        // $order->setTransporterPrice($transporter->getPrice());
        // $order->setTransporterContent($transporter->getContent());
        // // $order->setAdress($deliveryForOrder);
        // // $order->setAdress($adress);
        // $order->setAdress($adressDelivery);
        // // $order->setDelivery($deliveryForOrder);
        // $order->setMethod(" stripe");

        // $this->entityManager->persist($order);
        // // dd($order);
        // //  dump ($order);

        // $this->entityManager->flush();
        // on parcourt le panier pour créer les détails de la commande

        // foreach ($cart as $id => $quantity) {
        //     $product = $productsRepository->find($id);
        //     //    dd($product);
        // }

        // // on verifie si le produit existe en bdd ( stock)
        // if (!$product) {
        //     $this->addFlash('erreur', 'Produit non disponible actuellement !');
        //     return $this->redirectToRoute('app_products_index');
        // } else {
        //     //  on continue la création de la commande
        //     //   je recupere, le produit son prix et sa quantité

        //     // Récupérer les données de la session ( quantité et id du produit) 
        //     $cart = $session->get('cart', []);

        //     //  dd($cart);

        //     // recuperer les données du produits
        //     foreach ($cart as $id => $quantity) {
        //         $product = $productsRepository->find($id);
        //         //  dd($product);
        //         if ($product) {

        //             // Créer une nouvelle instance de RecapDetails


        //             $recapDetails = new RecapDetails();
        //             $recapDetails->setorderProduct($order);

        //             $recapDetails->setQuantity($quantity);

        //             $recapDetails->setPrice($product->getSellPriceHT());
        //             $recapDetails->setProduct($product->getArticleName());
        //             $recapDetails->setTotalRecap($product->getSellPriceHT() * $quantity);

        //             // Ajouter RecapDetails à la collection recapDetails de Order
        //             $order->addRecapDetail($recapDetails);

        //             // Persister RecapDetails et Order

        //             $this->entityManager->persist($recapDetails);

        //             $this->entityManager->persist($order);
        //         }
        //         //  dd($recapDetails);
        //         //  dump($recapDetails);

        //     }
        //     $this->entityManager->flush();
        //  dd($form);
        // Utiliser les données de la session...
        return $this->render('order/recap.html.twig', [
            'order' => $order,
            // 'form' => $form->createView(),
            'method' => $order->getMethod(),

            // 'transporter' => $transporter,

            // 'adressDelivery' => $adress,
            // 'adressDelivery' => $adressDelivery,

            'reference' => $order->getReference(),

            'recapCart' => [
                'products' => $products,
                'data' => $data,
                'total' => $total
            ]


        ]);

        //   } else {

        // Le formulaire n'a pas été soumis ou n'est pas valide

        // $this->addFlash('erreur', 'Une erreur est survenue lors de la validation de votre commande !');

        //      return $this->redirectToRoute('app_cart_index');
        //   }
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

    // #[Route('/{id}', name: 'app_order_delete', methods: ['POST'])]
    // public function delete(Request $request, Order $order, EntityManagerInterface $entityManager): Response
    // {
    //     if ($this->isCsrfTokenValid('delete' . $order->getId(), $request->request->get('_token'))) {
    //         $entityManager->remove($order);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('app_order_index', [], Response::HTTP_SEE_OTHER);
    // }
}
